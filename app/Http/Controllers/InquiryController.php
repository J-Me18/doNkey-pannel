<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Pincode;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //dd($request);
         
         
        $validator = $this->validate($request, [
            'name' => 'required|alpha',
            'mailId' => 'required',
            'mobile' => 'required|numeric',
            'area' => 'required',
            'category' => 'required',
            'description' => 'required',
            'pincode' => 'required',
            'ficon' => 'required',
        ]);
        // $pincode=[];
        $findPincode = Pincode::where('pincode', $request?->pincode)?->first()?->id;
        // dd($findPincode);
        if ($findPincode == null) {
            $pincode = $request?->pincode;
        } else {
            $pincode[] = json_encode($findPincode);
        }

        // dd($pincode);
        $validator['pincode'] = $pincode;
        $validator['emp_id'] = "web";

        // dd($validator);
        Enquiry::create($validator);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Enquiry $enquiry)
    {
        //
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

