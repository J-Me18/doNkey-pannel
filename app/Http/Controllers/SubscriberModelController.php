<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\site;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\statusnotify;

use Validator;


class SubscriberModelController extends Controller
{

    public function index()
    {
      $maintainance = site::where('id',1)->first()->maintainance;
      if($maintainance == 1){
      return view('auth.maintainance');
      }
        return view('subscriber.login');
    }

    //     public function subscriberlogin(Request $request)
    //     {

    //       $this->validate($request, [
    //           'email' =>'required',
    //           'password' => 'required',

    //           ]);
    //           $email=$request->email;
    //           $password=$request->password;

    //           $subscriber=Subscriber::where(['email'=>$email,'password'=>$password])->get();
    //           $sub=$subscriber;
    //           $count=count($subscriber);
    //           foreach($subscriber as $subscriber){
    //               $subscriberstatus=$subscriber->activestatus;
    //               // $subscriberblockedstatus=$subscriber->blockedstatus;
    //           }
    //         //   if($count == 1){
    //         //     if($subscriberstatus == 1){
    //         //         Session::put('subscribers', $subscriber);


    //         //    return redirect('subscribers/dashboard');
    //         // }
    //         // elseif($subscriberstatus == 0){
    //         //     return back()->with('error','Your not activated.Please Contact admin!');

    //         //     }
    //         //    else{
    //         //     return back()->with('error','You have been  blocked.Please Contact admin!');

    //         //     }

    //         //   }else{
    //         //     return back()->with('error','Wrong Credentials');

    //         //   }
    //         // dd($subscriber);
    //         if($count == 1){
    //           if($subscriberstatus == 1){

    // $date1=date_create($sub[0]->expiryDate);
    // $date2=date_create(date('d-m-Y'));
    // $diff=date_diff($date2,$date1);
    // $rr=$diff->format("%R");
    // // return $rr;
    //             if($rr=="-"){
    //               Subscriber::where(['email'=>$email,'password'=>$password])->update(['status'=>0]);

    //               return back()->with('error','Your not activated (Your Account Expiried ).Please Contact admin!');
    //             }else{
    //               Session::put('subscribers', $subscriber);


    //          return redirect('subscribers/dashboard');
    //             }
    //       }
    //       elseif($subscriberstatus == 0){
    //           return back()->with('error','Your not activated.Please Contact admin!');

    //           }
    //          else{
    //           return back()->with('error','You have been  blocked.Please Contact admin!');

    //           }

    //         }else{
    //           return back()->with('error','Wrong Credentials');

    //         }

    //   }



    public function subscriberlogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',

        ]);
        $email = $request->email;
        $password = $request->password;

        $subscriber = Subscriber::where(['email' => $email, 'password' => $password])?->get();

        // dd($newvariable);
        $employee = Employee::where(['email' => $email, 'password' => $password])->first();
        // $employeeuser= Auth::guard('employee')->attempt(['email' => $email, 'password' => $password]);
        // dd($subscriberuser);
        //dd($password);
        $subscriberCount = $subscriber->count();
        if ($subscriberCount > 0) {
            $sub = $subscriber;
            $count = count($subscriber);
            if ($count > 0) {
                foreach ($subscriber as $subscriber) {
                    $subscriberstatus = $subscriber->activestatus;
                    $subscriberblockedstatus = $subscriber->blockedstatus;
                }

                if ($count == 1) {
                    if ($subscriberblockedstatus == 1) {
                        if ($subscriberstatus == 1) {
                            $date1 = date_create($sub[0]->expiryDate);
                            $date2 = date_create(date('d-m-Y'));
                            $diff = date_diff($date2, $date1);
                            //dd($diff);
                            $rr = $diff->format("%R");
                            //dd($rr);
                            // return $rr;
                            if ($rr == "-") {
                                $idd = Subscriber::where(['email' => $email, 'password' => $password])->get();
                                Subscriber::where(['email' => $email, 'password' => $password])->update(['status' => 0]);
                                // return $idd;
                                $block = new statusnotify();
                                $block->datas = "Payment due";
                                $block->modifiedId = $idd[0]->id;
                                $block->modifiedBy = 'Payment Due';
                                $block->message = 'Payment due';
                                $block->save();

                                return back()->with('error', 'Your not activated (Your Account Expiried ).Please Contact admin!');
                            } else {
                                Session::put('subscribers', $subscriber);
                                $subscriber = Subscriber::where('email', $email)->first();

                                if ($subscriber && $subscriber->password == $password) {
                                    // Authenticate the subscriber without hashing the password
                                    Auth::guard('subscriber')->login($subscriber);

                                    // Redirect to the dashboard route
                                    return redirect()->route('subscribers.dashboard');
                                }
                            }
                        } else {
                            $date1 = date_create($sub[0]->expiryDate);
                            $date2 = date_create(date('d-m-Y'));
                            $diff = date_diff($date2, $date1);
                            $rr = $diff->format("%R");
                            // return $rr;
                            if ($rr == "-") {
                                $idd = Subscriber::where(['email' => $email, 'password' => $password])->get();
                                Subscriber::where(['email' => $email, 'password' => $password])->update(['status' => 0]);
                                // return $idd;
                                $block = new statusnotify();
                                $block->datas = "Payment due";
                                $block->modifiedId = $idd[0]->id;
                                $block->modifiedBy = 'Payment Due';
                                $block->message = 'Payment due';
                                $block->save();

                                return back()->with('error', 'Your not activated (Your Account Expiried ).Please Contact admin!');
                            } else {
                                Session::put('subscribers', $subscriber);
                                $subscriber = Subscriber::where('email', $email)->first();

                                if ($subscriber && $subscriber->password == $password) {
                                    // Authenticate the subscriber without hashing the password
                                    Auth::guard('subscriber')->login($subscriber);

                                    // Redirect to the dashboard route
                                    return redirect()->route('subscribers.dashboard');
                                }
                            }
                        }
                    } else {
                        return back()->with('error', 'You have been  blocked.Please Contact admin!');
                    }
                } else {
                    return back()->with('error', 'Wrong Credentials');
                }
            } else {
                return back()->with('error', 'Wrong Credentials');
            }
        } elseif (isset($employee)) {
            $employee = Employee::where(['email' => $email, 'password' => $password])->first();
            //dd($employee);
            $subscriber = Subscriber::where('id', $employee->subscriber_id)->get();
            $sub = $subscriber;
            $count = count($subscriber);
            foreach ($subscriber as $subscriber) {
                $subscriberstatus = $subscriber->activestatus;
                $subscriberblockedstatus = $subscriber->blockedstatus;
            }

            if ($count == 1) {
                if ($subscriberblockedstatus == 1) {
                    if ($subscriberstatus == 1) {

                        $date1 = date_create($sub[0]->expiryDate);
                        $date2 = date_create(date('d-m-Y'));
                        $diff = date_diff($date2, $date1);
                        //dd($diff);
                        $rr = $diff->format("%R");
                        //dd($rr);
                        // return $rr;
                        if ($rr == "-") {
                            $idd = Subscriber::where(['email' => $email, 'password' => $password])->get();
                            Subscriber::where(['email' => $email, 'password' => $password])->update(['status' => 0]);
                            // return $idd;
                            $block = new statusnotify();
                            $block->datas = "Payment due";
                            $block->modifiedId = $idd[0]->id;
                            $block->modifiedBy = 'Payment Due';
                            $block->message = 'Payment due';
                            $block->save();

                            return back()->with('error', 'Your not activated (Your Account Expiried ).Please Contact admin!');
                        } else {
                            Session::put('subscribers', $employee);
                            $subscriber = Employee::where('email', $email)->first();


                                if ($subscriber && $subscriber->password == $password) {
                                    // Authenticate the subscriber without hashing the password
                                    Auth::guard('employee')->login($subscriber);

                                    // Redirect to the dashboard route
                                    return redirect()->route('subscribers.dashboard');
                                }

                           
                                
                        }
                    } else {
                        $date1 = date_create($sub[0]->expiryDate);
                        $date2 = date_create(date('d-m-Y'));
                        $diff = date_diff($date2, $date1);
                        $rr = $diff->format("%R");
                        // return $rr;
                        if ($rr == "-") {
                            $idd = Subscriber::where(['email' => $email, 'password' => $password])->get();
                            Subscriber::where(['email' => $email, 'password' => $password])->update(['status' => 0]);
                            // return $idd;
                            $block = new statusnotify();
                            $block->datas = "Payment due";
                            $block->modifiedId = $idd[0]->id;
                            $block->modifiedBy = 'Payment Due';
                            $block->message = 'Payment due';
                            $block->save();

                            return back()->with('error', 'Your not activated (Your Account Expiried ).Please Contact admin!');
                        } else {
                            return back()->with('error', 'Your Subscriber Admin not activated.Please Contact your admin!');
                        }
                    }
                } else {
                    return back()->with('error', 'You have been  blocked.Please Contact admin!');
                }
            } else {
                return back()->with('error', 'Wrong Credentials');
            }
        } else {
            return back()->with('error', 'Wrong Credentials');
        }
    }
}

