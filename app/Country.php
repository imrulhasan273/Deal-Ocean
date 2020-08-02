<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'region_id'];
    public function region()    //user --> seller
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
}
