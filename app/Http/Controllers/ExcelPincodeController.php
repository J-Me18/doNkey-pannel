<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExcelPincode\StoreExcelPincodeRequest;
use App\Http\Requests\ExcelPincode\UpdateExcelPincodeRequest;
use App\Models\ExcelPincode;
use Illuminate\Http\Request;

class ExcelPincodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('hi');
        $excelPincodes = ExcelPincode::when(request('search'), function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('circlename', 'LIKE', "$search%")
                ->orWhere('regionname','LIKE',"$search%")
                ->orWhere('district','LIKE',"$search%")
                ->orWhere('pincode','LIKE',"%$search%")
                ->orWhere('statename','LIKE',"$search%")
                ->orWhere('tier','LIKE',"$search%");
            });
        })->latest()->paginate(25);       
       
        // dd($excelPincodes);
        return view('admin.excelpincode.index', ['excelPincodes' => $excelPincodes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.excelpincode.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExcelPincodeRequest $request)
    {
        // dd($request);
        $validator = $request->validated();
        ExcelPincode::create($validator);
        return redirect()->route('excelpincode.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExcelPincode  $excelPincode
     * @return \Illuminate\Http\Response
     */
    public function show(ExcelPincode $excelPincode)
    {
        return view('admin.excelpincode.view', ['excelPincode' => $excelPincode]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExcelPincode  $excelPincode
     * @return \Illuminate\Http\Response
     */
    public function edit(ExcelPincode $excelPincode)
    {
        return view('admin.excelpincode.edit', ['excelPincode' => $excelPincode]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExcelPincode  $excelPincode
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExcelPincodeRequest $request, ExcelPincode $excelPincode)
    {
        $validator = $request->validated();
        $excelPincode->update($validator);
        return redirect()->route('excelpincode.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExcelPincode  $excelPincode
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $excelPincode = ExcelPincode::where('id',$id)->first();
        $excelPincode->delete();
        return redirect()->route('excelpincode.index');
    }
}
