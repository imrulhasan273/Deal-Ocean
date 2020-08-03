<?php

namespace App\Http\Controllers;

use App\Country;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class LocationController extends Controller
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
        $countries = Country::all();

        return view('dashboard.locations.add', compact('countries'));
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
            'address' => 'required',
            'postal_code' => 'required',
            'country_id' => 'required'
        ]);

        //Save to db
        $location = Location::create([
            'address' => $request->input('address'),
            'postal_code' => $request->input('postal_code'),
            'country_id' => $request->input('country_id'),
        ]);

        return Redirect::route('dashboard.locations');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        $countries = Country::all();

        return view('dashboard.locations.edit', compact(['location', 'countries']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        $updatingLocation = Location::where('id', $request->location_id)->first();
        if ($updatingLocation) {
            $updatingLocation->update([
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'country_id' => $request->country_id,
            ]);
        }

        return Redirect::route('dashboard.locations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $deleteLocation = DB::table('locations')->where('id', $location->id)->delete();

        return Redirect::route('dashboard.locations');
    }
}
