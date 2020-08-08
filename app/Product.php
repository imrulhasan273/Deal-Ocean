<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'category_id', 'price', 'description', 'shop_id', 'cover_img'];

    public function order()
    {
        return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    //for review table
    public function user()
    {
        return $this->belongsToMany(User::class, 'reviews', 'product_id', 'user_id');
    }
}
