<?php

namespace App\Http\Controllers;

use App\Shop;
use App\User;
use App\Location;
use Illuminate\Http\Request;
use App\Mail\ShopActivationRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class ShopController extends Controller
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
        $locations = Location::all();
        return view('shops.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        $request->validate([
            'name' => 'required'
        ]);

        //Save to db
        $shop = auth()->user()->shop()->create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'location_id' => $request->input('location')
        ]);

        //send mail to admin
        $admins = User::whereHas('role', function ($q) {
            $q->where('name', 'admin');
        })->get();

        Mail::to($admins)->send(new ShopActivationRequest($shop));

        return redirect()->route('home')->with('message', 'Create shop request sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        $locations = Location::all();

        return view('dashboard.shops.edit', compact(['shop', 'locations']));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        Shop::where('id', $request->shop_id)
            ->update([
                'is_active' => $request->is_active,
                'description' => $request->description,
                'location_id' => $request->location
            ]);

        return Redirect::route('dashboard.shops');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
