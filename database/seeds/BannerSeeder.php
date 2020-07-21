<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->insert([
            'banner_img' => 'banner-bg.jpg',
            'title' => '.',
            'location' => '.',
            'discount' => '.',
            'about' => '.'
        ]);
    }
}
