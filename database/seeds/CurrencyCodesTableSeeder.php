<?php

use Illuminate\Database\Seeder;

class CurrencyCodesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('currency_codes')->delete();
        
        \DB::table('currency_codes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cid' => 1,
                'eid' => 1,
                'code' => 'BTC',
            ),
            1 => 
            array (
                'id' => 2,
                'cid' => 2085,
                'eid' => 1,
                'code' => 'USD',
            ),
            2 => 
            array (
                'id' => 3,
                'cid' => 1,
                'eid' => 3,
                'code' => 'BTCA',
            ),
            3 => 
            array (
                'id' => 4,
                'cid' => 2085,
                'eid' => 3,
                'code' => 'USD',
            ),
        ));
        
        
    }
}