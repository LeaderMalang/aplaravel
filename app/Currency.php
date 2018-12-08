<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = ['name','slug','currency_type', 'symbol','logo','circulating_supply','max_supply','total_supply','exchange_rate','mineable','ranking','status'];
    /*
    Get Currency Details
    */
    public function currency_details(){
        return $this->hasMany('App\CurrencyDetail','cid','id');

    }
    /*
    Get baseAsset Currency Pairs Details
    */
    public function baseAsset(){
        return $this->hasMany('App\CePair','c1','id');
    }
    /*
     * Get quoteAsset Currency Pair Details
      */
    public  function quoteAsset(){
        return $this->hasMany('App\CePair','c2','id');
    }
    /*
     Get Currency Code
      */
    public function currency_code(){
        return $this->hasMany('App\CurrencyCode','cid','id');
    }
    /* Get Images */
    public function images(){
        return $this->hasMany('App\Image','item_id','id');
    }

}
