<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subscriber\Complaint\UpdateComplaintRequest;
use App\Models\Complaints;
use App\Models\Employee;
use App\Models\Enquiry;
use App\Models\Pincode;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubscriberActionController extends Controller
{

    public function complaints()
    {
        $user = Session::get('subscribers');
       // dd($user);
        if (isset($user->subscriberId)) {
            if ($user->hasPermissionTo('complaint-list')) {
                $complaints = Complaints::where('subscriberId', session('subscribers')['id'])->get();
                $pincode = Pincode::all();

                return view('subscriber.complaints.index', compact('complaints', 'pincode'));
            }

            return view('subscriber.403');
        } else {
            if ($user->hasPermissionTo('complaint-list')) {
                $subscriber = Subscriber::where('id', $user->subscriber_id)->first();
                $complaints = Complaints::where('subscriberId', $subscriber->id)->get();
                $pincode = Pincode::all();

                return view('subscriber.complaints.index', compact('complaints', 'pincode'));
            }

            return view('subscriber.403');
        }
    }

    public function complaintsform()
    {
        $user = Session::get('subscribers');
        if (isset($user->subscriberId)) {
            $pincode = json_decode($user->pincode);
            // dd($pincode);
        } else {
            $subscriber = Subscriber::where('id', $user->subscriber_id)->first();
            $pincode = json_decode($subscriber->pincode);
        }
        $pincode = Pincode::whereIn('id', $pincode)->get();
        // dd($pincode);
        return view('subscriber.complaints.create', compact('pincode'));
    }

    public function generateUniqueCode()
    {
        do {
            $complaint_code = random_int(100000, 999999);
        } while (Complaints::where("complaintID", "=", $complaint_code)->first());

        return $complaint_code;
    }

    public function complaintsstore(Request $request)
    {
        // dd($request);
        $user = Session::get('subscribers');
        // dd($user);
        if (isset($user->subscriberId)) {
            $roleName = $user->roles;

            $validatedData = $this->validate($request, [
                'name' => 'required|alpha',
                'mailId' => 'required',
                'mobile' => 'required|numeric',
                'area' => 'required',
                'category' => 'required',
                'description' => 'required',
                'pincode' => 'required',
                'ficon' => 'required',
                'complaint' => 'required',
            ]);

            $complaintID = 'COM-' . $this->generateUniqueCode();
            $validatedData['complaintID'] = $complaintID;
            $validatedData['subscriberId'] = $user->id; // Use correct key here
            $validatedData['complained_by'] = $roleName[0]->name;
            $validatedData['complained_id'] = $user->id;
            // dd($validatedData);
            $show = Complaints::create($validatedData);

            return redirect('subscribers/complaints')
                ->with('success', 'Complaints registered successfully.');
        } else {
            //    dd($user);
            $roleName = $user->roles;
            // dd($roleName);
            $subscriber = Subscriber::where('id', $user->subscriber_id)->first();

            $validatedData = $this->validate($request, [
                'name' => 'required|alpha',
                'mailId' => 'required',
                'mobile' => 'required|numeric',
                'area' => 'required',
                'category' => 'required',
                'description' => 'required',
                'pincode' => 'required',
                'ficon' => 'required',
                'complaint' => 'required',
            ]);

            $complaintID = 'COM-' . $this->generateUniqueCode();
            $validatedData['complaintID'] = $complaintID;
            $validatedData['subscriberId'] = $subscriber->id;
            $validatedData['complained_by'] = $roleName[0]->name;
            $validatedData['complained_id'] = $user->id;

            $show = Complaints::create($validatedData);
            // dd($show);
            return redirect('subscribers/complaints')
                ->with('success', 'Complaints registered successfully.');
        }
    }


    public function complaintsshow($id)
    {

        $complaints = Complaints::Find($id);
        $pincode = Pincode::all();
        return view('subscriber.complaints.show', compact('complaints', 'pincode'));
    }


    public function enquiry()
    {
        $user = Session::get('subscribers');
        // dd($user);
        if (isset($user->subscriberId)) {
            if ($user->hasPermissionTo('enquiry-list')) {

                $userId = session('subscribers')['id'];
                $userPincode = $user->pincode;

                $enquiry = Enquiry::where(function ($query) use ($userId, $userPincode) {
                    $query->where('subscriberId', $userId)
                        ->orWhere(function ($query) use ($userPincode) {
                            $query->where('subscriberId', 0)
                                ->where('pincode', $userPincode);
                        });
                })
                    ->latest()
                    ->get();

                return view('subscriber.enquiry.index', compact('enquiry'));
            }


            return view('subscriber.403');
        } else {

            if ($user->hasPermissionTo('enquiry-list')) {
                $subscriber = Subscriber::where('id', $user->subscriber_id)->first();
                $subscriberId = $subscriber->id;
                $subscriberPin = $subscriber->pincode;
                $enquiry = Enquiry::where(function ($query) use ( $subscriberId, $subscriberPin) {
                    $query->where('subscriberId', $subscriberId)
                        ->orWhere(function ($query) use ($subscriberPin) {
                            $query->where('subscriberId', 0)
                                ->where('pincode', $subscriberPin);
                        });
                })
                    ->latest()
                    ->get();

                return view('subscriber.enquiry.index', compact('enquiry'));
            }

            return view('subscriber.403');
        }
    }

    public function enquiryform()
    {
        $user = Session::get('subscribers');
        if (isset($user->subscriberId)) {
            $pincode = json_decode($user->pincode);
        } else {
            $subscriber = Subscriber::where('id', $user->subscriber_id)->first();
            // dd($subscriber);
            $pincode = json_decode($subscriber->pincode);
        }
        $pincode = Pincode::whereIn('id', $pincode)->get();
        // dd($pincode);
        return view('subscriber.enquiry.create', compact('pincode'));
    }


    public function enquirystore(Request $request)
    {
        $user = Session::get('subscribers');
        if (isset($user->subscriberId)) {
            $validatedData = $this->validate($request, [
                'name' => 'required|string',
                'mailId' => 'required',
                'mobile' => 'required|numeric',
                'area' => 'required',
                'category' => 'required',
                'description' => 'required',
                'pincode' => 'required',
                'ficon' => 'required',

            ]);
            $employee = Employee::where('email', $user->email)->first();
            $validatedData['emp_id'] = $employee->emp_id;
            $validatedData['subscriberId'] = session('subscribers')['id'];
            // dd($validatedData);
        } else {
            $subscriber = Subscriber::where('id', $user->subscriber_id)->first();
            // dd($subscriber);
            $validatedData = $this->validate($request, [
                'name' => 'required|string',
                'mailId' => 'required',
                'mobile' => 'required|numeric',
                'area' => 'required',
                'category' => 'required',
                'description' => 'required',
                'pincode' => 'required',
                'ficon' => 'required',

            ]);
            $validatedData['emp_id'] = $user->emp_id;
            $validatedData['subscriberId'] = $subscriber->id;
            // dd($validatedData);
        }

        $show = Enquiry::create($validatedData);
        return redirect('subscribers/enquiry')
            ->with('success', 'enquiry registered successfully.');
    }


    public function enquiryshow($id)
    {
        $enquiry = Enquiry::Find($id);
        $user = Session::get('subscribers');
        if (isset($user->subscriberId)) {
            // dd($user->subscriberId);
            $employee = Employee::where('email', $user->email)->first();
            // dd($employee);
            $employeid = $employee->emp_id;
        } else {
            $employeid = $user->emp_id;
        }
        $employeeId = $employeid;
        $pincode = Pincode::all();
        return view('subscriber.enquiry.show', ['enquiry' => $enquiry->load('enquiryComment'), 'pincode' => $pincode, 'employeeId' => $employeeId]);
    }

    public function edit(Complaints $complaints, $id)
    {
        // dd($id);
        // dd($complaints);
        $complaints = Complaints::Find($id);
        $pincode = Pincode::all();
        return view('subscriber.complaints.edit', ['complaints' => $complaints, 'pincode' => $pincode]);
    }

    public function update(UpdateComplaintRequest $request, Complaints $id)
    {
        // dd($request);
        $user = Session::get('subscribers');
        if (isset($user->subscriberId)) {
            $roleName = $user->roles;
            $validator = $request->validated();
            $validator['solved_by'] = $roleName[0]->name;
            $validator['solved_id'] = $user->id;
            // dd();
            $id->update($validator);
        } else {
            $roleName = $user->roles;
            $validator = $request->validated();
            $validator['solved_by'] = $roleName[0]->name;
            $validator['solved_id'] = $user->id;
            // dd();
            $id->update($validator);
        }


        return redirect()->route('subscribers.complaints')
            ->with('success', 'Complaints Updated successfully.');
    }

    public function actionedBy(Employee $Complaint)
    {
        // dd($Complaint);
        return view('subscriber.complaints.actioned_by', ['Complaint' => $Complaint]);
    }
}
