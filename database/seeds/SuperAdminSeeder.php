<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'super_admin', 'display_name' => 'Super Admin']);
        $user = User::create(['name' => 'Imrul Hasan', 'role_id' => $role->id, 'email' => 'imrulhasan273@gmail.com', 'password' => Hash::make('imrulhasan')]);
        DB::table('role_user')->insert(['user_id' => $user->id, 'role_id' => $role->id]);
    }
}
