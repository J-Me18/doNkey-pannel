<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnquiryComment\StoreEnquiryCommentRequest;
use App\Models\EnquiryComment;
use Illuminate\Http\Request;

class EnquiryCommentController extends Controller
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
    public function store(StoreEnquiryCommentRequest $request)
    {
        // dd($request->validated());
        EnquiryComment::create($request->validated());
        return back()->with('sucess',"Comment Added Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EnquiryComment  $enquiryComment
     * @return \Illuminate\Http\Response
     */
    public function show(EnquiryComment $enquiryComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EnquiryComment  $enquiryComment
     * @return \Illuminate\Http\Response
     */
    public function edit(EnquiryComment $enquiryComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EnquiryComment  $enquiryComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EnquiryComment $enquiryComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EnquiryComment  $enquiryComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(EnquiryComment $enquiryComment)
    {
        //
    }
}
