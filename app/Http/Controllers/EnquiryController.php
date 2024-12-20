<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Pincode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enquiry = Enquiry::latest()->get();
        $pincode = Pincode::all();
        return view('admin.enquiry.index', compact('enquiry', 'pincode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pincode = Pincode::all();
        return view('admin.enquiry.create', compact('pincode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $validatedData = $this->validate($request, [
            'name' => 'required|alpha',
            'mailId' => 'required',
            'mobile' => 'required|numeric',
            'area' => 'required',
            'category' => 'required',
            'description' => 'required',
            'pincode' => 'required',
            'ficon' => 'required',
        ]);
        $employee = Auth::user();

        $validatedData['emp_id'] = $employee->emp_id;
        // dd($validatedData);
        $show = Enquiry::create($validatedData);
        return redirect()->route('enquiry.index')
            ->with('success', 'Enquiry created successfully.');
        //return redirect('enquiry')->with('success', 'Enquiry is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Enquiry $enquiry)
    {
        // dd($enquiry->load('enquiryComment'));
        $pincode = Pincode::all();
        return view('admin.enquiry.show', ['enquiry' => $enquiry->load('enquiryComment'), 'pincode' => $pincode]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquiry $enquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enquiry $enquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enquiry $enquiry)
    {
        //
    }
}
