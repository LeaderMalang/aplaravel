<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyDetail extends Model
{
    protected $fillable = ['cid','type','url','text'];
    //Disable created_at and updated_at
    public $timestamps = false;
    /*
    Get Currency
    */
    public function currency(){
        return $this->belongsTo('App\Currency','cid','id');
    }
}
