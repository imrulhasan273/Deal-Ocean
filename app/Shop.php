<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = ['name', 'description', 'location_id'];

    public function product()
    {
        return $this->hasMany(Product::class, 'shop_id');
    }

    // public function seller()    //user --> seller
    public function owner()    //user --> seller
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function location()    //user --> seller
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
