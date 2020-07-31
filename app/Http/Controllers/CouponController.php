<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CouponController extends Controller
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

    public function add()
    {
        // dd('add');
        return view('dashboard.coupons.add');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'coupon_name' => 'required',
            'coupon_code' => 'required',
            'coupon_type' => 'required',
            'coupon_discount' => 'required',
            'coupon_description' => 'required',
        ]);

        $addProduct = Coupon::create([
            'name' => $request->input('coupon_name'),
            'code' => $request->input('coupon_code'),
            'type' => $request->input('coupon_type'),
            'discount' => $request->input('coupon_discount'),
            'description' => $request->input('coupon_description'),
        ]);

        return Redirect::route('dashboard.coupons');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        // dd('edit');
        return view('dashboard.coupons.edit', compact(['coupon']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $updatingCoupon = Coupon::where('id', $request->coupon_id)->first();
        if ($updatingCoupon) {
            $updatingCoupon->update([
                'name' => $request->coupon_name,
                'code' => $request->coupon_code,
                'type' => $request->coupon_type,
                'discount' => $request->coupon_discount,
                'description' => $request->coupon_description
            ]);
        }

        return Redirect::route('dashboard.coupons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        DB::table('coupons')->where('id', $coupon->id)->delete();
        return Redirect::route('dashboard.coupons');
    }
}
