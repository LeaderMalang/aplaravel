<?php

use Illuminate\Database\Seeder;

class CePairsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ce_pairs')->delete();
        
        \DB::table('ce_pairs')->insert(array (
            0 => 
            array (
                'id' => 2,
                'c1' => 1,
                'c2' => 2085,
                'eid' => 1,
                'cc1' => 1,
                'cc2' => 2,
                'status' => 1,
            ),
        ));
        
        
    }
}