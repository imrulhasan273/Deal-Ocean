<?php

use App\Role;
use App\User;
use Illuminate\Support\Str;
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
        #Super Admin Seeder
        $role = Role::where('name', 'super_admin')->first();
        $user = User::create([
            'name' => 'Md. Imrul Hasan',
            'email' => 'imrulhasan273@gmail.com',
            'password' => Hash::make('imrulhasan'),
            'remember_token' => Str::random(60),
        ]);
        $user->role()->attach($role->id);
    }
}
