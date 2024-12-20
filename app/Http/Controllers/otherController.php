<?php

namespace App\Http\Controllers;

// use Illuminate\Contracts\Validation\Validator;

use App\Mail\InvoiceMail;
use App\Models\Admin;
use Razorpay\Api as api1;
use App\Models\statusnotify;
use App\Models\Subscriber;
use App\Models\PaymentDetails;
use App\Models\voucher as Voucher;
use App\Models\banner;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Validator;
// use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role;


use Razorpay\Api\Api;
// use Illuminate\Support\Facades\Session;
use Session;

use Spatie\Permission\Models\Permission;

class otherController extends Controller
{
    public function subscriberstatuschange(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'message' => "required",
        ]);
        //dd($request);
        if ($validate->fails()) {
            return redirect()->back()->with('error', $validate->errors());
        }
        $statusnotify = new statusnotify;
        if ($request->get('message') != "Other") {
            $statusnotify->datas = $request->get('message');
            $statusnotify->message = $request->get('message');
        } else {
            $validate = Validator::make($request->all(), [
                'message1' => "required",
            ]);

            if ($validate->fails()) {
                return redirect()->back()->with('error', "Please Fill The Reason For Status Change");
            }
            $statusnotify->datas = $request->get('message1');
            $statusnotify->message = $request->get('message1');
        }

        $statusnotify->modifiedBy = Auth::id();
        $statusnotify->modifiedId = $request->get('id');

        $statusnotify->save();

        $user = Subscriber::where('id', $request->get('id'))->first();
        //dd($user);        
        $user->activestatus = $request->get('status');
        //dd($user);
        $user->save();
        return redirect()->back()->with('success', "Status Updated Successfully");
    }

    // public function makesubscribtionpayment(Request $d)
    // {
    //     // $api_key = "rzp_test_7f2cx3IfnStcyi";
    //     // $api_secret = "II1V0c4hw5WJR2CFCJruXuwB";
    //     $amount = (int)$d->get('amount');
    //     // return $amount;
    //     $api = new Api("rzp_test_7f2cx3IfnStcyi", "II1V0c4hw5WJR2CFCJruXuwB");
    //     $orderData = [
    //         'receipt'         => "Payment_id" . rand(10000000, 1000000000),
    //         'amount'          => $amount * 100, // 39900 rupees in paise
    //         'currency'        => 'INR'
    //     ];

    //     $razorpayOrder = $api->order->create($orderData);
    //     // dump($razorpayOrder);
    //     // Session::put();
    //     $d->session()->put("order", $razorpayOrder->id);
    //     if ($razorpayOrder->status == "created") {
    //         $date = date_create(date("d-m-Y"));
    //         date_add($date, date_interval_create_from_date_string("30 days"));
    //         $expiry_date = date_format($date, "d-m-Y");
    //         Subscriber::where('subscriberId', $d->get('user_id'))->update(['subscriptionDate' => date("d-m-Y"), 'expiryDate' => $expiry_date, 'status' => 1]);
    //         return redirect('subscribers\login')->with('success', "Status Paid Successfully .Please Login");
    //     } else {
    //         return redirect('subscribers\login')->with('error', "Payment Is Not Successfull");
    //     }
    // }
    public function makesubscribtionpayment(Request $d)
    {

        $subscriber = Subscriber::where('subscriberId', $d->get('user_id'))->get();
        $amount = (int)$d->get('amount');
        //$amount = 1;
        return view('subscriber.makepayment', compact('subscriber', 'amount'));
    }

    public function validId(Request $request)
    {
        $subscriber = Subscriber::where('subscriberId', $request?->subscriberId)?->first();
        $today = now()->startOfDay(); // Normalize to the start of the day
        $expiryDate = Carbon::parse($subscriber->expiryDate)->startOfDay();
        $diffinDays = $expiryDate->diffInDays($today, false);
        $price = $subscriber->subscription_price;
        // dd($price);
        $gstPrice = $price * 18 / 100;
        $subscription_price = $price + $gstPrice;
        // dd($subscription_price);
        if ($diffinDays > 2) {
            $addDays = $expiryDate->addDays(2)->startOfDay();
            // dd($addDays);
            $penalityDays = $addDays->diffInDays($today, false);
            // dd("penality", $penalityDays);
            $penalityAmount = $penalityDays * 50;
            $gstForPenality = $penalityAmount * 18 / 100;
            $subscription_price = $price + $gstPrice + $penalityAmount + $gstForPenality;
        }
        //$subscription_price = 1; 
        // dd($subscription_price);
        return response()->json($subscription_price);
    }
    public function successfullypayment($id, Request $d)
    {
        // dd($id);
        $subscriber = Subscriber::where('subscriberId', $id)->first();
        $exipredDate = Carbon::parse($subscriber->expiryDate)->startOfDay();
        $today = now()->startOfDay();
        $diffDays = $exipredDate->diffInDays($today, false);
        // dd($diffDays);
        $date = date_create(date("Y-m-d"));
        date_add($date, date_interval_create_from_date_string("28 days"));
        $expiry_date = date_format($date, "Y-m-d");
        // dd($expiry_date);
        if (isset($subscriber) && $diffDays < 2) {
            $date = date_create(date("Y-m-d"));
            date_add($date, date_interval_create_from_date_string("30 days"));
            $expiry_date = date_format($date, "Y-m-d");
            // dd($expiry_date);
        }
        // dd($expiry_date);
        Subscriber::where('subscriberId', $id)->update(['subscriptionDate' => date("Y-m-d"), 'expiryDate' => $expiry_date, 'status' => 1, 'activestatus' => 1, 'notify' => 0, 'need_to_pay' => 1]);
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
        // dd($input);
        $subscriber = Subscriber::where('subscriberId', $id)->first();
        $amount = $input['amount'] / 100;
        $gst = $amount * 18 / 100;
        $subscriptionAmount = $amount - $gst;
        $latestRecord = PaymentDetails::latest()->first()?->invoice_no;

        if ($subscriptionAmount != $subscriber->subscription_price && ($subscriptionAmount > 0)) {
            $latestRecord = PaymentDetails::latest()->first()?->invoice_no;
            if ($latestRecord == null) {
                $input['invoice_no'] = 'PBPSP-50';
            } else {
                $count = explode('-', $latestRecord);
                // Calculate the new invoice number
                $newNumber = $count[1] > 50 ? $count[1] : 50;
                $input['invoice_no'] = 'PBPSP-' . $newNumber + 1;
            }
            $input['type'] = 2;
        }

        if ($subscriptionAmount == $subscriber->subscription_price && ($subscriptionAmount > 0)) {
            $latestRecord = PaymentDetails::latest()->first()?->invoice_no;
            if ($latestRecord == null) {
                $input['invoice_no'] = 'PBPS-50';
            } else {
                $count = explode('-', $latestRecord);
                // Calculate the new invoice number
                $newNumber = $count[1] > 50 ? $count[1] : 50;
                $input['invoice_no'] = 'PBPS-' . $newNumber + 1;
            }
            $input['type'] = 1;
        }

        $payemntDetails = PaymentDetails::create($input);
        // dd($payemntDetails);
        // dd($subscriber);
        $data = [];
        $data['payemntDetails'] = $payemntDetails;
        $data['subscriber'] = $subscriber;
        if (isset($payemntDetails) && isset($subscriber)) {
            $result = $this->sendWhatsappNotification($subscriber, $payemntDetails);
            // dd($result);
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
                ->cc(['krishnainfotechtally@gmail.com', 'payments.donkeydeliveries@gmail.com'])
                ->send(new InvoiceMail($data));
            Log::info('Invoice email sent successfully to ' . $subscriber->email);
        } catch (\Exception $e) {
            Log::error('Failed to send invoice email to ' . $subscriber->email . ': ' . $e->getMessage());
        }
        return 1;
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

    public function successpay(Request $d)
    {
        return redirect('subscribers\login')->with('success', "Status Paid Successfully .Please Login");
    }

    // public function chatwithadmin(Request $d)
    // {
    //     $first = Subscriber::first(['name', 'subscriberId']);
    //     Session::put("messagesubscriber", $first->subscriberId);
    //     $subscriber = Subscriber::get(['name', 'subscriberId']);
    //     return view('admin.chat.chat', compact('subscriber'));
    // }

    // public function subscriberchatwithadmin(Request $d)
    // {

    //     Session::put("messagesubscriber", Session::get('subscribers')['subscriberId']);


    //     return view('subscriber.chat.chat');
    // }
    // public function chat(Request $d)
    // {

    //     Session::put("messagesubscriber", $d->id);
    //     $subscriber = Subscriber::get(['name', 'subscriberId']);
    //     return view('admin.chat.chat', compact('subscriber'));
    // }

    public function chatwithadmin(Request $d)
    {
        // $first = Subscriber::first(['name', 'subscriberId']);
        $user = Admin::find(Auth::id());
        // dd($user);
        $role = $user->getRoleNames()->first();

        $role = Role::findByName($role);
        $permissionName = 'Chat';

        if ($role->hasPermissionTo($permissionName)) {

            $roleuser = Role::with('users')->get()[0]->users;
            //dd($roleuser);
            // foreach ($roleuser as $ro) {
            //     if ($ro->id === Auth::id()) {
            //         $role_id = $ro->pivot->role_id;
            //         dd($role_id);
            //         $role_name = Role::where('id', $role_id)->get(['name'])[0]->name;
            //     }
            // }
            $role_name = Auth::user()->roles;
            Session::put("messagebyid", Auth::id());
            Session::put("rolename", $role_name);
            Session::put("messagebyname", Admin::where('id', Auth::id())->get(['name'])[0]->name);

            return view('admin.chat.chat');
        } else {
            return "You don't have permission to access this page";
        }
    }

    // public function subscriberchatwithadmin(Request $d)
    // {

    //     Session::put("messagesubscriber", Session::get('subscribers')['subscriberId']);


    //     return view('subscriber.chat.chat');
    // }
    // public function chat(Request $d)
    // {

    //     Session::put("messagesubscriber", $d->id);
    //     $subscriber = Subscriber::get(['name', 'subscriberId']);
    //     return view('admin.chat.chat', compact('subscriber'));
    // }
    public function rl(Request $d)
    {
        Permission::create(['name' => 'Subsciber Status on']);
        Permission::create(['name' => 'Subsciber Status off']);
        Permission::create(['name' => 'Rider Status off']);
    }




    public function chatsupport(Request $d)
    {
        $user = Admin::find(Auth::id());
        // dd($user->emp_id);
        $role = $user->getRoleNames()->first();

        $role = Role::findByName($role);
        $permissionName = 'Chat';

        if ($role->hasPermissionTo($permissionName)) {

            $first = Subscriber::first(['name', 'subscriberId']);
            // dd($first);
            Session::put("messagesubscriber", $first->subscriberId);
            Session::put("messagesadminid", $user->emp_id);
            $subscriber = Subscriber::when(request('search'), function ($query, $search) {
                //  dd(request('search'));
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%$search%");
                    $query->orWhere('subscriberId', 'LIKE', "%$search%");
                });
            })
                ->get(['name', 'subscriberId']);

            return view('admin.chat.chatwithsubadmin', compact('subscriber'));
        } else {
            return "You don't have permission to access this page";
        }
    }

    public function subscriberchatwithadmin(Request $d)
    {
        $user = Session::get('subscribers');

        // if ($user->hasPermissionTo('employee-create')) {
        Session::put("messagesubscriber", Session::get('subscribers')['subscriberId']);


        return view('subscriber.chat.chatwithsubadmin');
        // }

        // return view('subscriber.403');
    }
    public function chat(Request $d)
    {
        Session::put("messagesubscriber", $d->id);
        $subscriber = Subscriber::get(['name', 'subscriberId']);
        // dd($subscriber);
        // $subscriberName = $subscriber->name;
        // $subscriberId = $subscriber->subscriberId;
        return view('admin.chat.chatwithsubadmin', compact('subscriber'));
    }
    public function Voucher(Request $d)
    {
        $user = Admin::find(Auth::id());
        $role = $user->getRoleNames()->first();

        $role = Role::findByName($role);
        $permissionName = 'Banner and voucher';

        if ($role->hasPermissionTo($permissionName)) {

            $voucher = Voucher::get();
            return view('admin.voucher_and_banner.voucher', compact('voucher'));
        } else {
            return "You don't have permission to access this page";
        }
    }
    public function vouchersubmit(Request $d)
    {
        $this->validate($d, [

            'voucher' => 'required|mimes:png,jpeg,gif,png,jpg',

        ]);
        $vouchers = new Voucher();
        $voucher = time() . '.' . $d->voucher->extension();
        $d->voucher->move(public_path('admin/voucher'), $voucher);
        $vouchers->images = $voucher;
        $vouchers->save();
        return redirect('Voucher')->with("success", 'Uploaded Successfully');
    }
    public function voucherdelete(Request $d)
    {
        $id = $d->id;
        Voucher::where("id", $id)->delete();
        return redirect('Voucher')->with("success", 'Deleted Successfully');
    }

    public function vouchereditsubmit(Request $d)
    {
        $this->validate($d, [

            'image' => 'required|mimes:png,jpeg,gif,png,jpg',

        ]);
        $id = $d->input('id');
        // Voucher::where("id",$id)->delete();
        $vouchers = Voucher::find($id);
        // $vouchers->find($id);
        $image = time() . '.' . $d->image->extension();
        $d->image->move(public_path('admin/voucher'), $image);
        $vouchers->images = $image;
        $vouchers->save();
        return redirect('Voucher')->with("success", 'Updated Successfully');
    }



    public function Banner(Request $d)
    {
        $user = Admin::find(Auth::id());
        $role = $user->getRoleNames()->first();

        $role = Role::findByName($role);
        $permissionName = 'Banner and voucher';

        if ($role->hasPermissionTo($permissionName)) {
            $banner = banner::get();
            return view('admin.voucher_and_banner.banner', compact('banner'));
        } else {
            return "You don't have permission to access this page";
        }
    }
    public function bannersubmit(Request $d)
    {
        $this->validate($d, [

            'banner' => 'required|mimes:png,jpeg,gif,png,jpg',

        ]);
        $banners = new banner();
        $banner = time() . '.' . $d->banner->extension();
        $d->banner->move(public_path('admin/banner'), $banner);
        $banners->images = $banner;
        $banners->save();
        return redirect('Banner')->with("success", 'Uploaded Successfully');
    }
    public function bannerdelete(Request $d)
    {
        $id = $d->id;
        banner::where("id", $id)->delete();
        return redirect('Banner')->with("success", 'Deleted Successfully');
    }

    public function bannereditsubmit(Request $d)
    {
        $this->validate($d, [

            'image' => 'required|mimes:png,jpeg,gif,png,jpg',

        ]);
        $id = $d->input('id');
        // Voucher::where("id",$id)->delete();
        $vouchers = banner::find($id);
        // $vouchers->find($id);
        $image = time() . '.' . $d->image->extension();
        $d->image->move(public_path('admin/banner'), $image);
        $vouchers->images = $image;
        $vouchers->save();
        return redirect('Banner')->with("success", 'Updated Successfully');
    }
}
