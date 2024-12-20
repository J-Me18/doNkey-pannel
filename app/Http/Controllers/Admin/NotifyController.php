<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Pincode;
use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotifyController extends Controller
{
    public function subscriberWhatsappNotify()
    {
        $subscribers = Subscriber::get();
        foreach ($subscribers as $subscriber) {
            $today = now()->startOfDay(); // Normalize to the start of the day
            $expiryDate = Carbon::parse($subscriber->expiryDate)->startOfDay(); // Normalize to the start of the day
            $daysDifference = $today->diffInDays($expiryDate, false); // Calculate the difference in days
            // Debugging output
            // dd($daysDifference);
            if ($daysDifference == 5 && $subscriber->notify == 0) {
                // dd(5, $subscriber);  
                $name = "remainder5day";
                $before23Days = $subscriber->expiryDate->subDays(23);
                $result = $this->sendNotofication($subscriber, $before23Days, $name);
                $subscriber->update(['notify' => 5]);
                // return $result;
            } elseif ($daysDifference == 2 && $subscriber->notify == 5) {
                // dd(2, $subscriber);
                $name = "remainder2day";
                $before26Days = $subscriber->expiryDate->subDays(26);
                $result = $this->sendNotofication($subscriber, $before26Days, $name);
                $subscriber->update(['notify' => 2]);
                // return $result;
            } elseif ($daysDifference == -1 && $subscriber->notify == -1) {
                // dd(-1, $subscriber);
                $name = "finalpayremainder";
                $before28Days = $subscriber->expiryDate->subDays(28);
                $result = $this->sendNotofication($subscriber, $before28Days, $name);
                $subscriber->update(['notify' => 1]);
                // return $result;
            } elseif (($daysDifference == 0) && $subscriber->notify == 2) {
                // dd($subscriber);
                // $expiryDate = Carbon::parse($expiryDate)->format('Y-m-d'); // Ensure you are using Carbon
                $before28DaysExipryDate = $expiryDate->subDays(28)->startOfDay();
                $currentDate = now()->format('Y-m-d'); // Get current date in the correct format
                $decodePincodes = json_decode($subscriber->pincode);
                $pincodes = [];
                foreach ($decodePincodes as $pincodeId) {
                    $pincode = Pincode::where('id', $pincodeId)->first()?->pincode; // Fetch the pincode
                    if ($pincode) {
                        $pincodes[] = $pincode; // Add the pincode to the array if it exists
                    }
                }
                // dd($pincodes);
                $completedBookings = Booking::with('bookingPayment')
                    ->whereIn('pincode', $pincodes)
                    ->where('status', 2)
                    ->whereBetween('created_at', [$before28DaysExipryDate, $subscriber->expiryDate])
                    ->get();
                // dd($completedBookings);
                $totalPayment = $completedBookings->sum(function ($booking) {
                    return $booking->bookingPayment->sum('total'); // Replace 'amount' with the actual field name
                });
                // dd($totalPayment);
                $platFormFee = 0;
                if ($totalPayment > 0) {
                    $platFormFee = $totalPayment * 23 / 100;
                    // dd($platFormFee);
                }
                // dd($platFormFee);
                $subscriber->update(['platform_fee' => $platFormFee]);
                // dd($expiryDate);
                $expiredDate = Carbon::parse($subscriber->expiryDate);
                // dd($expiredDate);
                $Date2 = $subscriber->expiryDate->startOfDay()->addDays(1);
                // dd($Date2);
                // $Date3 = $Dated2->startOfDay()->addDays(1);
                // dd($Date3);
                $mobile = $subscriber->mobile;
                $name = $subscriber->name;
                $Price1 = $subscriber->subscription_price; //supscrition price                
                $Date1 = Carbon::parse($expiredDate)->startOfDay()->format('d-m-Y');
                // dd($Dated1);
                $Price2 = $platFormFee; // 23% of completetd bookings
                $PBPID = $subscriber->subscriberId;
                $Date2 = Carbon::parse($Date2)->format('d-m-Y');
                // dd($Date2);
                $Date3 = Carbon::parse($Date2)->addDays(1)->format('d-m-Y');
                // dd($Date3);
                $result = $this->dueNotofication($mobile, $name, $Price1, $Price2, $PBPID, $Date1, $Date2, $Date3);
                $subscriber->update(['notify' => -1, 'activestatus' => 0]);
            } elseif ($daysDifference == -3 && $subscriber->notify == 1) {
                // dd(-3, $subscriber);
                $result = $this->accounTerminateNotification($subscriber);
                $subscriber->update(['notify' => -3]);
            }
        }
        // dd($subscribers);
        return response()->json('success');
    }

    public function sendNotofication($subscriber, $beforeDays, $name)
    {
        $title = $name;
        // dd($title);
        // dd($beforeDays->format('d-m-Y'));
        $beforeDays = Carbon::parse($beforeDays)->format('Y-m-d'); // Ensure you are using Carbon
        $currentDate = now()->format('Y-m-d'); // Get current date in the correct format
        $token = "226b3bc6338f9de4107cc93016924fb2868113776165b8d4b9a76914930e2fa2e47ff2906d87e0281121e425dccf62d856496f752b5c8cb518c3bd50f72dc8e63bd17167076160d0b7785d2ba49d0a6ee302316d26170b942b2bd903ec284621ddf64661122a1161b34d6908a3eff8d050e55bbc757c325d1139366d685e5a52ac1a34b8981f809ae7189e3791c43f9376299621f6a379b16b6883aaca42251753bd2c7ce3a4e7b09d29bb9acfd72145c615614ce039f6e30ef5b8923ae6e6fa00e43523a7b287c4f1cbac18e7ef96667d5df3c431dcef8a048996a1158f702b";
        $url = 'http://backend.wacto.ai/v1/message/send-message?token=' . $token; // Replace <sample-token> with your actual token
        $decodePincodes = json_decode($subscriber->pincode);
        $pincodes = [];
        foreach ($decodePincodes as $pincodeId) {
            $pincode = Pincode::where('id', $pincodeId)->first()?->pincode; // Fetch the pincode
            if ($pincode) {
                $pincodes[] = $pincode; // Add the pincode to the array if it exists
            }
        }
        // dd($pincodes);
        $completedBookings = Booking::with('bookingPayment')
            ->whereIn('pincode', $pincodes)
            ->where('status', 2)
            ->whereBetween('created_at', [$beforeDays, $currentDate])
            ->get();
        // dd($completedBookings);
        $totalPayment = $completedBookings->sum(function ($booking) {
            return $booking->bookingPayment->sum('total'); // Replace 'amount' with the actual field name
        });
        // dd($totalPayment);
        $platFormFee = 0;
        if ($totalPayment > 0) {
            $platFormFee = $totalPayment * 23 / 100;
            // dd($platFormFee);
        }

        $subscriber->update(['platform_fee' => $platFormFee]);
        // dd($totalPayment);
        // Prepare the parameters
        $name = $subscriber?->name; // Subscriber's name
        $price1 = $subscriber?->subscription_price; // Amount due
        $date1 = Carbon::parse($subscriber?->expiryDate?->addDays(1))?->format('d-m-Y'); // Due date
        $date2 = Carbon::parse($subscriber?->expiryDate?->addDays(2))?->format('d-m-Y'); // Due date
        // dd($date2);
        $price2 = $platFormFee; // Platform fee
        if ($title == "finalpayremainder") {
            // Notification for 1 days before
            $data = [
                'campaignId' => "101",
                'to' => $subscriber->mobile, // Subscriber's mobile number
                'type' => 'template',
                'template' => [
                    'language' => [
                        'policy' => 'deterministic',
                        'code' => 'en'
                    ],
                    'name' => $title, // Ensure this matches your template name
                    'components' => [
                        [
                            'type' => 'body',
                            'parameters' => [
                                ['type' => 'text', 'text' => $name],
                                ['type' => 'text', 'text' => $date1],
                                ['type' => 'text', 'text' => $date2],
                            ]
                        ]
                    ]
                ]
            ];
        } else {
            // Notification for 5 and 2 days before
            $data = [
                'campaignId' => "101",
                'to' => $subscriber->mobile, // Subscriber's mobile number
                'type' => 'template',
                'template' => [
                    'language' => [
                        'policy' => 'deterministic',
                        'code' => 'en'
                    ],
                    'name' => $title, // Ensure this matches your template name
                    'components' => [
                        [
                            'type' => 'body',
                            'parameters' => [
                                ['type' => 'text', 'text' => $name],
                                ['type' => 'text', 'text' => $price1],
                                ['type' => 'text', 'text' => $date1],
                                ['type' => 'text', 'text' => $price2],
                            ]
                        ]
                    ]
                ]
            ];
        }

        // Use cURL to send the request
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // Execute the request and capture the response
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        // Check if the message was sent successfully
        if ($httpCode == 200) {
            return "Message sent successfully!";
        } else {
            return "Failed to send message: HTTP Code: $httpCode, Response: $response, Error: $error";
        }
    }

    public function dueNotofication($mobile, $name, $Price1, $Price2, $PBPID, $Date1, $Date2, $Date3)
    {
        // dd($mobile, $name, $Price1, $Price2, $PBPID, $Date1, $Date2, $Date3);
        $token = "226b3bc6338f9de4107cc93016924fb2868113776165b8d4b9a76914930e2fa2e47ff2906d87e0281121e425dccf62d856496f752b5c8cb518c3bd50f72dc8e63bd17167076160d0b7785d2ba49d0a6ee302316d26170b942b2bd903ec284621ddf64661122a1161b34d6908a3eff8d050e55bbc757c325d1139366d685e5a52ac1a34b8981f809ae7189e3791c43f9376299621f6a379b16b6883aaca42251753bd2c7ce3a4e7b09d29bb9acfd72145c615614ce039f6e30ef5b8923ae6e6fa00e43523a7b287c4f1cbac18e7ef96667d5df3c431dcef8a048996a1158f702b";
        $url = 'http://backend.wacto.ai/v1/message/send-message?token=' . $token; // Replace <sample-token> with your actual token

        // Notification for 1 days before
        $data = [
            'campaignId' => "101",
            'to' => $mobile, // Subscriber's mobile number
            'type' => 'template',
            'template' => [
                'language' => [
                    'policy' => 'deterministic',
                    'code' => 'en'
                ],
                'name' => "todayduepayment_detail", // Ensure this matches your template name
                'components' => [
                    [
                        'type' => 'body',
                        'parameters' => [
                            ['type' => 'text', 'text' => $name],
                            ['type' => 'text', 'text' => $Price1],
                            ['type' => 'text', 'text' => $Date1],
                            ['type' => 'text', 'text' => $Price2],
                            ['type' => 'text', 'text' => $PBPID],
                            ['type' => 'text', 'text' => $Date2],
                            ['type' => 'text', 'text' => $Date3],
                        ]
                    ]
                ]
            ]
        ];

        // Use cURL to send the request
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // Execute the request and capture the response
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        // Check if the message was sent successfully
        if ($httpCode == 200) {
            return "Message sent successfully!";
        } else {
            return "Failed to send message: HTTP Code: $httpCode, Response: $response, Error: $error";
        }
    }

    public function accounTerminateNotification($subscriber)
    {
        // dd($subscriber);
        $name = $subscriber->name;
        $Date1 = Carbon::parse($subscriber->expiryDate->addDays(10))->format('d-m-Y');
        // dd($name,$Date1);
        // dd($mobile, $name, $Price1, $Price2, $PBPID, $Date1, $Date2, $Date3);
        $token = "226b3bc6338f9de4107cc93016924fb2868113776165b8d4b9a76914930e2fa2e47ff2906d87e0281121e425dccf62d856496f752b5c8cb518c3bd50f72dc8e63bd17167076160d0b7785d2ba49d0a6ee302316d26170b942b2bd903ec284621ddf64661122a1161b34d6908a3eff8d050e55bbc757c325d1139366d685e5a52ac1a34b8981f809ae7189e3791c43f9376299621f6a379b16b6883aaca42251753bd2c7ce3a4e7b09d29bb9acfd72145c615614ce039f6e30ef5b8923ae6e6fa00e43523a7b287c4f1cbac18e7ef96667d5df3c431dcef8a048996a1158f702b";
        $url = 'http://backend.wacto.ai/v1/message/send-message?token=' . $token; // Replace <sample-token> with your actual token

        // Notification for 1 days before
        $data = [
            'campaignId' => "101",
            'to' => $subscriber->mobile, // Subscriber's mobile number
            'type' => 'template',
            'template' => [
                'language' => [
                    'policy' => 'deterministic',
                    'code' => 'en'
                ],
                'name' => "accountterminate", // Ensure this matches your template name
                'components' => [
                    [
                        'type' => 'body',
                        'parameters' => [
                            ['type' => 'text', 'text' => $name],
                            ['type' => 'text', 'text' => $Date1],
                        ]
                    ]
                ]
            ]
        ];

        // Use cURL to send the request
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // Execute the request and capture the response
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        // Check if the message was sent successfully
        if ($httpCode == 200) {
            return "Message sent successfully!";
        } else {
            return "Failed to send message: HTTP Code: $httpCode, Response: $response, Error: $error";
        }
    }
}
