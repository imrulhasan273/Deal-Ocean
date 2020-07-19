<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function product()
    {
        return $this->hasMany(Product::class, 'shop_id');
    }

    public function seller()    //user --> seller
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
