<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = ['name', 'is_active', 'description', 'address', 'country_id'];

    public function product()
    {
        return $this->hasMany(Product::class, 'shop_id');
    }

    public function seller()    //user --> seller
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function location()    //user --> seller
    // {
    //     return $this->belongsTo(Location::class, 'location_id');
    // }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
