<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckingRequest;
use App\Http\Requests\UpdateCheckingRequest;
use App\Models\Checking;
use Illuminate\Http\Request;

class CheckingController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckingRequest $request)
    {
        //  dd($request->validated());
        Checking::create($request->validated());
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checking  $checking
     * @return \Illuminate\Http\Response
     */
    public function show(Checking $checking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checking  $checking
     * @return \Illuminate\Http\Response
     */
    public function edit(Checking $checking)
    {
        // dd($checking);
        return view('admin.dashboard', ['checking' => $checking]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checking  $checking
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCheckingRequest $request, Checking $checking)
    {
        // dd($request->validated());
        // dd($checking);
        // dd($request);
        $checking->update($request->validated());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checking  $checking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checking $checking)
    {
        //
    }
}
