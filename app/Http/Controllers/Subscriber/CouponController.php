<?php

namespace App\Http\Controllers\Subscriber;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Pincode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Session::get('subscribers');
        if (isset($user->subscriberId)) {
            $pincodeIds = Pincode::where('usedBy', $user->id)->get()->pluck('id');
            // dd($pincodeIds);
            $coupons = Coupon::with('pincode')
                ->whereIn('pincode_id', $pincodeIds)
                ->latest()
                ->get();
        } else {
            $pincodeIds = Pincode::where('usedBy', $user->subscriber_id)->get()->pluck('id');
            $coupons = Coupon::with('pincode')
                ->whereIn('pincode_id', $pincodeIds)
                ->latest()
                ->get();
        }
        foreach ($coupons as $coupon) {
            if ($coupon->expiry_date->format('Y-m-d') < now()) {
                $coupon->update([
                    'status' => 0
                ]);
            }
        }
        return view('subscriber.coupon.index', ['coupons' => $coupons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Session::get('subscribers');
        if (isset($user->subscriberId)) {
            $pincodes = Pincode::where('usedBy', $user->id)->get();
        } else {
            $pincodes = Pincode::where('usedBy', $user->subscriber_id)->get();
        }
        return view('subscriber.coupon.create', ['pincodes' => $pincodes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Session::get('subscribers');
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
            'role' => 'nullable',
        ], [
            'pincode_id.required' => 'Select a valid pincode',
            'start_date.required' => 'Start date is required',
            'expiry_date.required' => 'End date is required',
            'discount_type.required' => 'Discount type is required',
            'is_multiple' => 'Usage type is required',
        ]);
        $created_by = isset($user->subscriberId) ? $user->id : $user->subscriber_id;
        $validated['created_by'] = $created_by;
        $validated['role'] = isset($user->subscriberId) ? "SUBSCRIBER" : "EMPLOYEE";
        if ($request->hasFile('image')) {
            $imageName = uniqid() . "." . $request->image->extension();
            $request->image->move(public_Path('coupon'), $imageName);
            $validated['image'] = $imageName;
        }
        // dd($validated);
        Coupon::create($validated);
        return redirect()->route('subscribers.coupon.index')->with('coupon created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $data = $request->all();
        $coupon->update($data);
        return redirect()->route('subscribers.coupon.index')->with('coupon created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        //
    }
}