<?php

namespace App\Policies;

use App\Shop;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        $authRole = Auth::check() ? Auth::user()->role->pluck('name')->toArray() : [];
        if (($authRole[0] == 'admin') || ($authRole[0] == 'super_admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Shop  $shop
     * @return mixed
     */
    public function view(User $user, Shop $shop)
    {
        return $user->id == $shop->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Shop  $shop
     * @return mixed
     */
    public function edit(User $user, Shop $shop)
    {
        return $user->id == $shop->user_id;
    }

    public function update(User $user, Shop $shop)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Shop  $shop
     * @return mixed
     */
    public function delete(User $user, Shop $shop)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Shop  $shop
     * @return mixed
     */
    public function restore(User $user, Shop $shop)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Shop  $shop
     * @return mixed
     */
    public function forceDelete(User $user, Shop $shop)
    {
        //
    }
}
