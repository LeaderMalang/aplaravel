<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    protected $fillable = ['name','status','slug','url','fetch_url','has_fee','fee'];
    /*
     * Get Currency Pairs
     *  */
    public  function currency_pair(){
        return $this->hasMany('App\CePair','eid','id');
    }
}
