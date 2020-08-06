<?php


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(CategoriesTableSeeder::class);

        $this->call(RegionSeeder::class);
        $this->call(CountrySeeder::class);

        $this->call(SliderSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(ShopSeeder::class);

        $this->call(ProductSeeder::class);
    }
}
