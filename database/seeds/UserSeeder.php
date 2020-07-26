<?php

use App\Role;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #Admin Seeder
        $role = Role::where('name', 'admin')->first();
        $user = User::create([
            'name' => 'Imrul Hasan',
            'email' => '16101034@uap-bd.edu',
            'password' => Hash::make('imrulhasan'),
            'remember_token' => Str::random(60),
        ]);
        $user->role()->attach($role->id);

        #Seller Seeder
        $role = Role::where('name', 'seller')->first();
        $user = User::create([
            'name' => 'Brishty Hoque',
            'email' => 'brishtyhoque273@gmail.com',
            'password' => Hash::make('0000000000'),
            'remember_token' => Str::random(60),
        ]);
        $user->role()->attach($role->id);

        #Customer Seeder
        $role = Role::where('name', 'customer')->first();
        $user = User::create([
            'name' => 'Towhidul Islam',
            'email' => 'towhid@gmail.com',
            'password' => Hash::make('0000000000'),
            'remember_token' => Str::random(60),
        ]);
        $user->role()->attach($role->id);
    }
}
