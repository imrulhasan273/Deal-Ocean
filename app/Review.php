<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id', 'product_id', 'rating', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
