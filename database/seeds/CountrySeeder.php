<?php

use App\Region;
use App\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $region = Region::where('name', 'Asia')->first();
        $country = Country::create([
            'name' => 'Bangladesh',
            'region_id' => $region->id,
        ]);
    }
}
