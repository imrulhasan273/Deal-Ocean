<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'super_admin', 'display_name' => 'Super Admin']);
        Role::create(['name' => 'admin', 'display_name' => 'Admin']);
        Role::create(['name' => 'seller', 'display_name' => 'Seller']);
        Role::create(['name' => 'customer', 'display_name' => 'Customer']);
    }
}
