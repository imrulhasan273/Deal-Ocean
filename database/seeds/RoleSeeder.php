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
        //Admin Seeder
        $role = Role::create(['name' => 'admin', 'display_name' => 'Admin']);
        $user = User::create(['name' => 'Imrul Hasan', 'role_id' => $role->id, 'email' => '16101034@uap-bd.com', 'password' => Hash::make('imrulhasan')]);
        DB::table('role_user')->insert(['user_id' => $user->id, 'role_id' => $role->id]);

        //Seller Seeder
        $role1 = Role::create(['name' => 'seller', 'display_name' => 'Seller']);
        $user1 = User::create(['name' => 'Brishty Hoque', 'role_id' => $role1->id, 'email' => 'brishtyhoque273@gmail.com', 'password' => Hash::make('0000000000')]);
        DB::table('role_user')->insert(['user_id' => $user1->id, 'role_id' => $role1->id]);

        //Customer Seeder
        $role2 = Role::create(['name' => 'customer', 'display_name' => 'Customer']);
        $user2 = User::create(['name' => 'Towhidul Islam', 'role_id' => $role2->id, 'email' => 'towhid@gmail.com', 'password' => Hash::make('0000000000')]);
        DB::table('role_user')->insert(['user_id' => $user2->id, 'role_id' => $role2->id]);
    }
}
