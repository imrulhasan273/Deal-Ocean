<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function add()
    {
        $roles = Role::all();

        return view('dashboard.users.add', compact('roles'));
    }
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'passwordConfirm' => 'required'
        ]);


        //Save to db
        if ($request->password == $request->passwordConfirm) {

            $user = User::create([
                'name' =>  $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'),),
                'remember_token' => Str::random(60),
            ]);

            $user->role()->attach($request->role_id);
        }


        return Redirect::route('dashboard.users');
    }
    public function edit(User $user)
    {
        $roles = Role::all();

        $thisRole = $user->role[0];

        return view('dashboard.users.edit', compact('user', 'roles', 'thisRole'));
    }
    public function update(Request $request, User $user)
    {
        $updatingUser = User::where('id', $request->id)->first();
        if ($updatingUser) {
            $updatingUser->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        if ($request->thisRole != $request->role_id) {

            $det = $updatingUser->role()->detach($request->thisRole);
            if ($det) {
                $updatingUser->role()->attach($request->role_id);
            }
        }

        return Redirect::route('dashboard.users');
    }
    public function destroy(User $user)
    {
        $deleteUser = DB::table('users')->where('id', $user->id)->delete();

        return Redirect::route('dashboard.users');
    }
}
