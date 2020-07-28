<?php

namespace App\Observers;

use App\Role;
use App\Shop;
use App\Mail\ShopActivated;
use Illuminate\Support\Facades\Mail;

class ShopObserver
{
    /**
     * Handle the shop "created" event.
     *
     * @param  \App\Shop  $shop
     * @return void
     */
    public function created(Shop $shop)
    {
        //
    }

    /**
     * Handle the shop "updated" event.
     *
     * @param  \App\Shop  $shop
     * @return void
     */
    public function updated(Shop $shop)
    {
        if ($shop->getOriginal('is_active') == false && $shop->is_active == true) {

            #send mail to customer.
            Mail::to($shop->seller->email)->send(new ShopActivated($shop));

            #make change role from customer to seller
            $prevRole = Role::where('name', 'customer')->first();
            $nextRole = Role::where('name', 'seller')->first();

            $det = $shop->seller->role()->detach($prevRole);

            if ($det) {
                $shop->seller->role()->attach($nextRole);
            }
        } else {
            dd('shop change to inactive');
        }
    }

    /**
     * Handle the shop "deleted" event.
     *
     * @param  \App\Shop  $shop
     * @return void
     */
    public function deleted(Shop $shop)
    {
        //
    }

    /**
     * Handle the shop "restored" event.
     *
     * @param  \App\Shop  $shop
     * @return void
     */
    public function restored(Shop $shop)
    {
        //
    }

    /**
     * Handle the shop "force deleted" event.
     *
     * @param  \App\Shop  $shop
     * @return void
     */
    public function forceDeleted(Shop $shop)
    {
        //
    }
}
