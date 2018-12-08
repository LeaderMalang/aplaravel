<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(CurrencyDetailsTableSeeder::class);
        $this->call(CePairsTableSeeder::class);
        $this->call(CurrencyCodesTableSeeder::class);
        $this->call(ExchangesTableSeeder::class);
    }
}
