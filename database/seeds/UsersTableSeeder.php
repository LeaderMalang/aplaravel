<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Hassan Ali',
                'username' => 'hassan',
                'email' => 'dev2.softrix@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$gutOBPLchhz9nfk6CadDSuXl.ByzGO9jBPNaWWci04vlYGygYLepG',
                'remember_token' => 'BMIlSeszgbeovWruIDLAqmvIGWC904FUAcPVzg5FaDKW0jiY34KcOSBJf3tf',
                'created_at' => '2018-10-24 06:27:36',
                'updated_at' => '2018-10-24 06:27:36',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Ashan Khan',
                'username' => 'ashan',
                'email' => 'dev3.softrix@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$56WI4QPBI8huBjz/43aZSu11V9sh4HEQYm8HNpzYqdl0dy4uRNsjy',
                'remember_token' => 'SmcJOjx6N8M87sy0VphGKRcoCfUb2EgmtnpBVAbPgR7DRi025WN7tnaEXLUI',
                'created_at' => '2018-10-24 06:45:09',
                'updated_at' => '2018-10-24 06:45:09',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Umair Khan',
                'username' => 'umairKhan',
                'email' => 'dev4.softrix@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$gY.3anJHQQnKVgQpif8ofu6aQ/b6a4AhprBM7ZW9uqiv2v0sg5aGO',
                'remember_token' => NULL,
                'created_at' => '2018-10-24 12:05:18',
                'updated_at' => '2018-10-24 12:13:12',
            ),
        ));
        
        
    }
}