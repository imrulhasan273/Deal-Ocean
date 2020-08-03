<?php

namespace App\Http\Controllers;

use App\Role;
use App\Shop;
use App\User;
use App\Region;
use App\Country;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\ShopActivationRequest;
use Illuminate\Support\Facades\Auth;
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
        $regions = Region::all();
        $countries = Country::all();
        return view('shops.create', compact('regions', 'countries'));

        # findCountry is used in this function
    }

    # ----=================---------------------------
    public function findCountry(Request $request)
    {
        $data = Country::select('id', 'name')->where('region_id', $request->id)->take(100)->get();
        return response()->json($data);
    }
    # ----=================---------------------------

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
            'name' => 'required',
            'description' => 'required',
            'country' => 'required',
            'address' => 'required'
        ]);

        //Save to db
        $shop = auth()->user()->shop()->create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'country_id' => $request->input('country'),
            'address' => $request->input('address')
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
        $this->authorize('edit', $shop);
        # ---------------------------

        $countries = Country::all();

        return view('dashboard.shops.edit', compact(['shop', 'countries']));
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
        $updatingShop = Shop::where('id', $request->shop_id)->first();
        if ($updatingShop) {
            $updatingShop->update([
                'is_active' => $request->is_active,
                'description' => $request->description,
                'address' => $request->address,
                'country_id' => $request->country
            ]);
        }

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
        $prevRole = Role::where('name', 'seller')->first();
        $nextRole = Role::where('name', 'customer')->first();
        $det = $shop->seller->role()->detach($prevRole);
        if ($det) {
            $shop->seller->role()->attach($nextRole);
        }

        $deleteShop = DB::table('shops')->where('id', $shop->id)->delete();

        return Redirect::route('dashboard.shops');
    }
}
