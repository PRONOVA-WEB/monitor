<?php

use Illuminate\Database\Seeder;

class MinciProducto1StdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('max_execution_time', '360');

        \Artisan::call('minci:covidcases');
    }
}
