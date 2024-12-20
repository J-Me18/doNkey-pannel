<?php

namespace App\Http\Controllers;

use App\Models\voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.voucher.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\voucher $voucher
     * @return \Illuminate\Http\Response
     */
    public function show(voucher $voucher)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\voucher $voucher
     * @return \Illuminate\Http\Response
     */
    public function edit(voucher $voucher)
    {
        return view('admin.voucher.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, voucher $voucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voucher $enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(voucher $voucher)
    {
        //
    }
}