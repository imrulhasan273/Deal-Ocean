<?php

use App\Country;
use App\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = Country::where('name', 'Bangladesh')->first();
        $location = Location::create([
            'address' => 'Dhaka',
            'postal_code' => '1345',
            'country_id' => $country->id,
        ]);

        $country = Country::where('name', 'Bangladesh')->first();
        $location = Location::create([
            'address' => 'Sylhet',
            'postal_code' => '2400',
            'country_id' => $country->id,
        ]);
    }
}
