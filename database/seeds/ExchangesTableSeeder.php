<?php

use Illuminate\Database\Seeder;

class ExchangesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('exchanges')->delete();
        
        \DB::table('exchanges')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Bittrix',
                'status' => 1,
                'slug' => 'bittrix',
                'url' => 'https://Bittrix.com',
                'fetch_url' => 'https://Bittrix.com/marketname={c1}-{c2}',
                'has_fee' => 1,
                'fee' => '0.1000',
                'created_at' => '2018-11-23 00:00:00',
                'updated_at' => '2018-11-23 00:00:00',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Bitfnix',
                'status' => 1,
                'slug' => 'bitfnix',
                'url' => 'https://Bitfnix.com',
                'fetch_url' => 'https://Bitfnix.com/marketname={c1}-{c2}',
                'has_fee' => 1,
                'fee' => '0.0200',
                'created_at' => '2018-11-23 12:25:29',
                'updated_at' => '2018-11-24 06:02:54',
            ),
        ));
        
        
    }
}