<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pincodebasedcategory;
use Illuminate\Http\Request;

class PincodebasedcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pincodebasedcategories = Pincodebasedcategory::where('pincode_id', $request->pincodeId)
            ->with(['category', 'pincode'])
            ->get();
        return view('admin.category.pbc', ['pincodebasedcategories' => $pincodebasedcategories]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pincodebasedcategory  $pincodebasedcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Pincodebasedcategory $pincodebasedcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pincodebasedcategory  $pincodebasedcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Pincodebasedcategory $pincodebasedcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pincodebasedcategory  $pincodebasedcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pincodebasedcategory $pincodebasedcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pincodebasedcategory  $pincodebasedcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pincodebasedcategory $pincodebasedcategory)
    {
        //
    }

    public function pincodebasedcategorystatus(Request $request)
    {
    //dd($request);
        $pincodebasedcategory = Pincodebasedcategory::where('id', $request->id)->first();
        //dd($pincodebasedcategory);
        if (isset($pincodebasedcategory)) {
            $pincodebasedcategory->update([
                'status' => $request->status == 1 ? 1 : 0
            ]);
            return response()->json([
                'success' => true
            ]);
        }
        return response()->json([
            'success' => false
        ]);
    }
}

