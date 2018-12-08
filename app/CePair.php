<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CePair extends Model
{
    protected $fillable = ['c1','c2','eid','cc1','cc2','status'];
    public $timestamps = false;
    /*
    Get baseAsset C1 Currency Details
    */
    public function baseAsset(){
        return $this->belongsTo('App\Currency','c1','id');
    }
    /*
    Get quoteAsset C2 Currency Details
    */
    public function quoteAsset(){
        return $this->belongsTo('App\Currency','c2','id');
    }
    /*
    Get Exchange Details

    */
    public function market(){

        return $this->belongsTo('App\Exchange','eid','id');
    }


}
