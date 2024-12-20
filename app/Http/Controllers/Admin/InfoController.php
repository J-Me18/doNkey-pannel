<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Info\StoreInfoRequest;
use App\Http\Requests\Admin\Info\UpdateInfoRequest;
use App\Models\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infos = Info::latest()
            ->get();
        return view('admin.info.index', ['infos' => $infos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.info.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInfoRequest $request)
    {
        Info::create($request->validated());
        return redirect()->route('admin.info.index')->with('success', "Info details stored!!!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function show(Info $info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function edit(Info $info)
    {
        return view('admin.info.edit', ['info' => $info]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInfoRequest $request, Info $info)
    {
        $info->update($request->validated());
        return redirect()->route('admin.info.index')->with('success', "Info details updated!!!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function destroy(Info $info)
    {
        $info->delete();
        return back()->with('success', "Info deatils deleted!!!");
    }

    public function changeStatus(Request $request)
    {
        $result = "";
        $info = Info::where('id', $request->infoId)
            ?->first();
        if (isset($info)) {
            $info->status = $request->status == 1 ? 1 : 0;
            $info->update();
            return response()->json([$result => true]);
        }
        return response()->json([$result => false]);
    }
}
