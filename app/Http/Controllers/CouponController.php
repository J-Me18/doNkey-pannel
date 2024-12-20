<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Subscriber;
use App\Models\Pincode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class CouponController extends Controller
{
  public function index()
  {
    $coupons = Coupon::with('pincode')
      ->latest()
      ->get();
    foreach ($coupons as $coupon) {
      if ($coupon->expiry_date->format('Y-m-d') < now()) {
        $coupon->update([
          'status' => 0
        ]);
      }
    }
    return view("admin.coupon.index", ['coupons' => $coupons]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $pincodes = Pincode::where('usedBy', '!=', 0)->get();
    $subscribers = Subscriber::all();
    return view("admin.coupon.create", ['subscribers' => $subscribers, 'pincodes' => $pincodes]);
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
    $validated = $request->validate([
      'title' => 'required',
      'image' => 'nullable',
      'type' => 'required',
      'pincode_id' => $request->type == 2 ? 'required' : '',
      'code' => ['required', Rule::unique(Coupon::class, 'code')],
      'limit' => 'required',
      'is_multiple' => 'required',
      'start_date' => 'required',
      'expiry_date' => 'required',
      'discount_type' => 'required',
      'amount' => 'nullable',
      'percentage' => 'nullable',
      'created_by' => 'nullable',
    ], [
      'pincode_id.required' => 'Select a valid pincode',
      'start_date.required' => 'Start date is required',
      'expiry_date.required' => 'End date is required',
      'discount_type.required' => 'Discount type is required',
      'is_multiple' => 'Usage type is required',
    ]);
    $created_by = Auth::id();
    $validated['created_by'] = $created_by;
    if ($request->hasFile('image')) {
      $imageName = uniqid() . "." . $request->image->extension();
      $request->image->move(public_Path('coupon'), $imageName);
      $validated['image'] = $imageName;
    }
    // dd($validated);
    Coupon::create($validated);
    return redirect()->route('coupon.index')->with('coupon created successfully');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Coupon $coupon
   * @return \Illuminate\Http\Response
   */
  public function show(Coupon $coupon)
  {
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Coupon $coupon
   * @return \Illuminate\Http\Response
   */
  public function edit(Coupon $coupon)
  {
    $subscribers = Subscriber::all();
    return view("admin.edit.index", ['subscribers' => $subscribers, 'coupon' => $coupon]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Coupon $coupon
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Coupon $coupon)
  {
    //dd($request);
    $validated = $request->validate([
      'title' => 'required',
      'limit' => 'required',
      'expiry_date' => 'required',
    ], [
      'expiry_date.required' => 'End date is required',
    ]);

    $coupon->update($validated);
    return redirect()->route('coupon.index')->with('coupon updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Coupon $coupon
   * @return \Illuminate\Http\Response
   */
  public function destroy(Coupon $coupon)
  {
    $coupon->delete();
    return back()->with('success', "Coupon deleted successfully");
  }

  public function couponstatus(Request $request)
  {
    //dd($request);
    $result = "";
    $coupon = Coupon::where('id', $request->couponId)
      ?->first();
    if (isset($coupon)) {
      $coupon->status = $request->status == 1 ? 1 : 0;
      $coupon->update();
      return response()->json([$result => true]);
    }
    return response()->json([$result => false]);
  }
}

