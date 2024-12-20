<?php

namespace App\Http\Controllers;

use App\Models\banner;
use Illuminate\Http\Request;

class bannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $banners = banner::latest()
            ->get();
        return view('admin.banner.index', ['banners' => $banners]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'image' => 'required',
            'link' => 'nullable'
        ]);

        if ($request->hasFile('image')) {
            $imageName = uniqid() . "." . $request->image->extension();
            $request->image->move(public_path('banner'), $imageName);
            $validated['image'] = $imageName;
        }

        banner::create($validated);
        return redirect()->route('admin.banner.index')->with('success', "Banner Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(banner $banner)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(banner $banner)
    {
        return view('admin.banner.edit', ['banner' => $banner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, banner $banner)
    {
        $validated = $request->validate([
            'title' => 'required',
            'image' => 'nullable',
            'link' => 'nullable'
        ]);

        if ($request->hasFile('image')) {
            $imageName = uniqid() . "." . $request->image->extension();
            $request->image->move(public_path('banner'), $imageName);
            $validated['image'] = $imageName;
        }

        $banner->update($validated);
        return redirect()->route('admin.banner.index')->with('success', "Banner Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(banner $banner)
    {
        $banner->delete();
        return back()->with('success', "Banner Deleted Successfully");
    }
}

