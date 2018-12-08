<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $timestamps = false;

    public function currency(){
        return $this->belongsTo('App\Currency','item_id','id');
    }
}
