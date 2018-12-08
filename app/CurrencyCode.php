<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyCode extends Model
{
    public $timestamps = false;
    protected $fillable = ['cid','eid','code'];
    /*
    Get Currency Detail
    */
    public  function currency(){
        return $this->belongsTo('App\Currency','cid','id');
    }
}
