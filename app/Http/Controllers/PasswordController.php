<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\Password\StorePasswordRequest;
use App\Http\Requests\Auth\Password\UpdatePasswordRequest;
use App\Http\Requests\StoreSubscriberPasswordRequest;
use App\Http\Requests\UpdateSubscriberPasswordRequest;
use App\Mail\ForgotPasswordMail;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    public function forgotPassword()
    {
        return view('admin.password.email');
    }

    public function subscriberForgotPassword()
    {
        // dd("hii");
        return view('admin.password.subscriberEmail');
    }

    public function sendForgotPasswordEmail(StorePasswordRequest $request)
    {
        $employee = Admin::where('email', $request->email)->first();
         $encid = encrypt($employee ->id);
        $resetLink = config('app.url') . '/passwordReset/'.$encid;
         //dd($employee);
        // Send email using Laravel's mailing system
        $data = [
            'employee' => $employee,
            'resetLink' => $resetLink,
        ];
         //dd($data);
        Mail::to($employee->email)->send(new ForgotPasswordMail($data));

        return back()->with('success', 'Check your mail for password reset instructions.')
            ->withInput();
    }

    public function subscriberEmailVerification(StoreSubscriberPasswordRequest $request)
    {
        // dd($request);
        $employee = Employee::where('email', $request->email)->first();
         $encid = encrypt($employee->id);
        $resetLink = config('app.url') . '/subscriberpasswordReset/'.$encid;
        // dd($resetLink);
        // Send email using Laravel's mailing system
        $data = [
            'employee' => $employee,
            'resetLink' => $resetLink,
        ];
        // dd(config('mail.username'));
        // dd($data);
        Mail::to($employee->email)->send(new ForgotPasswordMail($data));

        return back()->with('success', 'Check your mail for password reset instructions.')
            ->withInput();
    }

  public function passwordReset($id)
    {
        $userId = decrypt($id);
        return view('admin.password.confirm',['userId' => $userId]);
    }

    public function subscriberPasswordReset($id)
    {
    $userId = decrypt($id);
        return view('admin.password.subscriberConfirm',['userId' => $userId]);
    }

    public function newPassword(UpdatePasswordRequest $request)
    {
        if ($request->password == $request->confirmed_password) {
            $validator = $request->validated();
            // dd($validator['email']);
            $employee = Admin::where('id', $validator['user_id'])->first();
            // dd($employee);
            $validator['password'] = Hash::make($request->password);
            // dd($validator);
            $employee->update([
                'password' => $validator['password']
            ]);
            return redirect()->route('login')->with('success', "Password Changed Successfully");
        } else {
            return back()->withErrors(['confirmed_password' => 'Password does not match.'])->withInput();
        }
    }

    public function SubscriberNewPassword(UpdateSubscriberPasswordRequest $request)
    {
        // dd($request);
        if ($request->password == $request->confirmed_password) {
            $validator = $request->validated();           // dd($validator['email']);
            $employee = Employee::where('id', $validator['user_id'])?->first();
            $subscriber = Subscriber::where('email', $employee?->email)?->first();
            if (isset($subscriber)) {
                $subscriber->password = $validator['password'];
                $subscriber->update();
                $employee->password = $validator['password'];
                $employee->update();
            } else {
                $employee->password = $validator['password'];
                $employee->update();
            }

            // dd($employee);
            // $validator['password'] = Hash::make($request->password);
            // dd($validator);

            return redirect()->route('subscriberLogin')->with('success', "Password Changed Successfully");
        } else {
            return back()->withErrors(['confirmed_password' => 'Password does not match.'])->withInput();
        }
    }
}
