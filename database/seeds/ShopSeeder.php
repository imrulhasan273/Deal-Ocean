<?php

use App\Country;
use App\Shop;
use App\User;
use App\Location;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('id', 3)->first();
        $country = Country::where('id', 1)->first();
        $shops = Shop::create([
            'name' => 'Rimex',
            'user_id' => $user->id,
            'is_active' => 1,
            'description' => 'This is description',
            'rating' => 4.5,
            'address' => 'Savar, Dhaka',
            'country_id' => $country->id
        ]);

        $user = User::where('id', 3)->first();
        $country = Country::where('id', 1)->first();
        $shops = Shop::create([
            'name' => 'Larax',
            'user_id' => $user->id,
            'is_active' => 0,
            'description' => 'Description in text',
            'rating' => 4.0,
            'address' => 'Dhanmondi, Dhaka',
            'country_id' => $country->id
        ]);
    }
}
