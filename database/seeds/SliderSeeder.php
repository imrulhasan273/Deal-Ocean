<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sliders')->insert([
            'slider_img' => 'bg.jpg',
            'title' => 'New Arrivals',
            'name' => 'denim jackets',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis',
            'price' => 100
        ]);
        DB::table('sliders')->insert([
            'slider_img' => 'bg-1.jpg',
            'title' => 'New Arrivals',
            'name' => 'Sunglass',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis',
            'price' => 300
        ]);
        DB::table('sliders')->insert([
            'slider_img' => 'bg-2.jpg',
            'title' => 'New Arrivals',
            'name' => 'Gym',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis',
            'price' => 800
        ]);
    }
}
