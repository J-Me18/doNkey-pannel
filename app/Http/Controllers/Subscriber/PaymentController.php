<?php

namespace App\Http\Controllers\Subscriber;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Models\PaymentDetails;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function makePlatFormFee(Request $request)
    {
        // dd($request->all());
        $subscriber = Subscriber::where('id', $request?->Id)->first();
        if (isset($subscriber)) {
            // dd($subscriber);
            return view('subscriber.makeplateformfee', ['subscriber' => $subscriber]);
        }
    }

    public function successfulPlatFormFee($id, Request $d)
    {
        // dd($id,$d);
        Subscriber::where('subscriberId', $id)->update(['status' => 1, 'activestatus' => 1, 'notify' => 0, 'platform_fee' => 0, 'need_to_pay' => 0]);
        //  $input = $d->all();
        //dd($d->response);
        $input = [];
        $input['subscriberId'] = $id;
        $input['payment_id'] = $d->response['razorpay_payment_id'];
        $input['status_code'] = isset($d->response['status_code']) ? $d->response['status_code'] : 200;
        if (isset($d->response['razorpay_signature'])) {
            $input['signature'] = $d->response['razorpay_signature'];
        }
        $input['amount'] = (int)$d->amount;
        $latestRecord = PaymentDetails::latest()->first()?->invoice_no;
        if ($latestRecord == null) {
            $input['invoice_no'] = 'PBPOP-50';
        } else {
            $count = explode('-', $latestRecord);
            // Calculate the new invoice number
            $newNumber = $count[1] > 50 ? $count[1] : 50;
            $input['invoice_no'] = 'PBPOP-' . $newNumber + 1;
        }
        $input['type'] = 3;
        $payemntDetails = PaymentDetails::create($input);
        $subscriber = Subscriber::where('subscriberId', $id)->first();
        $data = [];
        $data['payemntDetails'] = $payemntDetails;
        $data['subscriber'] = $subscriber;
        // return "Done";
        if (isset($payemntDetails) && isset($subscriber)) {
            $result = $this->sendWhatsappNotification($subscriber, $payemntDetails);
        }
         try {
            // Set the new mail configuration
            config([
                'mail.mailers.smtp.host' => 'smtp.gmail.com',
                'mail.mailers.smtp.port' => 587,
                'mail.mailers.smtp.username' => 'finance@donkeydeliveries.in',
                'mail.mailers.smtp.password' => 'gbps gpkh okgy qqce',
                'mail.mailers.smtp.encryption' => 'tls',
                'mail.from.address' => 'finance@donkeydeliveries.in',
                'mail.from.name' => 'do N key',
            ]);

            // Send the email
            Mail::to($subscriber->email)
            ->cc(['krishnainfotechtally@gmail.com','payments.donkeydeliveries@gmail.com'])
            ->send(new InvoiceMail($data));
            Log::info('Invoice email sent successfully to ' . $subscriber->email);
        } catch (\Exception $e) {
            Log::error('Failed to send invoice email to ' . $subscriber->email . ': ' . $e->getMessage());
        }
        // return redirect()->route('subscribers.dashboard');
    }

    public function sendWhatsappNotification($subscriber, $payemntDetails)
    {
        $token = "226b3bc6338f9de4107cc93016924fb2868113776165b8d4b9a76914930e2fa2e47ff2906d87e0281121e425dccf62d856496f752b5c8cb518c3bd50f72dc8e63bd17167076160d0b7785d2ba49d0a6ee302316d26170b942b2bd903ec284621ddf64661122a1161b34d6908a3eff8d050e55bbc757c325d1139366d685e5a52ac1a34b8981f809ae7189e3791c43f9376299621f6a379b16b6883aaca42251753bd2c7ce3a4e7b09d29bb9acfd72145c615614ce039f6e30ef5b8923ae6e6fa00e43523a7b287c4f1cbac18e7ef96667d5df3c431dcef8a048996a1158f702b";
        $url = 'http://backend.wacto.ai/v1/message/send-message?token=' . $token;
        $name = $subscriber->name;
        $InvoiceNo = $payemntDetails->invoice_no;
        $Link = route('invoicedownloadPDF', $payemntDetails?->id);

        // Notification for Invoice
        $data = [
            'campaignId' => "101",
            'type' => 'template',
            'template' => [
                'language' => [
                    'policy' => 'deterministic',
                    'code' => 'en'
                ],
                'name' => "invoice_confirmation_copy", // Ensure this matches your template name
                'components' => [
                    [
                        'type' => 'body',
                        'parameters' => [
                            ['type' => 'text', 'text' => $name],
                            ['type' => 'text', 'text' => $InvoiceNo],
                            ['type' => 'text', 'text' => $Link], // You can adjust the text
                        ]
                    ]
                ]
            ]
        ];

        // Send message to a given number
        $this->sendMessage($subscriber->mobile, $data, $url);

        // Send message to the CC number
        $ccNumber = '9363455953'; // CC number
        $this->sendMessage($ccNumber, $data, $url);
    }

    // Function to send message
    private function sendMessage($number, $data, $url)
    {
        $data['to'] = $number; // Set the recipient number

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
            return "Message sent successfully to $number!";
        } else {
            return "Failed to send message to $number: HTTP Code: $httpCode, Response: $response, Error: $error";
        }
    }
}