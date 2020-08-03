<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['address', 'postal_code', 'country_id'];
    public function country()    //user --> seller
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
