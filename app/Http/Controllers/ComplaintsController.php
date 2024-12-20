<?php

namespace App\Http\Controllers;

use App\Http\Requests\Complaint\UpdateComplaitRequest;
use App\Models\Admin;
use App\Models\Complaints;
use App\Models\Pincode;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaints = Complaints::where('subscriberId',0)->latest()->get();
        //dd($complaints[0]->complained_id);
        $pincode = Pincode::all();

        return view('admin.complaints.index', compact('complaints', 'pincode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $role = Auth::user()->roles;
        // dd($role);
        $pincode = Pincode::all();
        return view('admin.complaints.create', compact('pincode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = auth()->user()->roles;
        $user_id = auth()->id();
        //dd($user);
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
            //'complaintID' => $this->generateUniqueCode(),
        ]);

        $complaintID = 'COM-' . $this->generateUniqueCode();
        $validatedData['complaintID'] = $complaintID;
        $validatedData['complained_by'] = $role[0]->name;
        $validatedData['complained_id'] = $user_id;
        // dd($complaintID);
        $show = Complaints::create($validatedData);
        return redirect()->route('complaints.index')
            ->with('success', 'Complaints registered successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Complaints  $complaints
     * @return \Illuminate\Http\Response
     */
    public function show(Complaints $complaints, $id)
    {

        $complaints = Complaints::Find($id);
        $pincode = Pincode::all();
        return view('admin.complaints.show', compact('complaints', 'pincode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Complaints  $complaints
     * @return \Illuminate\Http\Response
     */
    public function edit(Complaints $complaints, $id)
    {
        $complaints = Complaints::Find($id);
        $pincode = Pincode::all();
        return view('admin.complaints.edit', ['complaints' => $complaints, 'pincode' => $pincode]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Complaints  $complaints
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComplaitRequest $request, Complaints $complaint)
    {
        //dd($complaint);
        $role = Auth::user()->roles;
        $user_id = Auth::id();
        //dd($user_id);
        $validator = $request->validated();
        $validator['solved_by'] = $role[0]->name;
        $validator['solved_id'] = $user_id;
        // dd();
        $complaint->update($validator);
        return redirect()->route('complaints.index')
            ->with('success', 'Complaints Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complaints  $complaints
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complaints $complaints)
    {
        //
    }


    public function generateUniqueCode()
    {
        do {
            $complaint_code = random_int(100000, 999999);
        } while (Complaints::where("complaintID", "=", $complaint_code)->first());

        return $complaint_code;
    }

    public function actionedBy(Admin $Complaint)
    {
        // dd($Complaint);
        return view('admin.complaints.actionedBy', ['Complaint' => $Complaint]);
    }
}
