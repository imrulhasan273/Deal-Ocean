<?php

namespace App\Http\Controllers;

use App\Region;
use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CountryController extends Controller
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
        $regions = Region::all();

        return view('dashboard.countries.add', compact('regions'));
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
            'country_name' => 'required',
            'region_id' => 'required'
        ]);

        //Save to db
        $country = Country::create([
            'name' => $request->input('country_name'),
            'region_id' => $request->input('region_id'),
        ]);


        return Redirect::route('dashboard.countries');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        $regions = Region::all();

        return view('dashboard.countries.edit', compact(['country', 'regions']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $updatingCountry = Country::where('id', $request->country_id)->first();
        if ($updatingCountry) {
            $updatingCountry->update([
                'name' => $request->country_name,
                'region_id' => $request->region_id,
            ]);
        }

        return Redirect::route('dashboard.countries');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $deleteCountry = DB::table('countries')->where('id', $country->id)->delete();

        return Redirect::route('dashboard.countries');
    }
}
