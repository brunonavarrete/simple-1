<?php

use Illuminate\Database\Seeder;

class StationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=1; $i < 4; $i++) { 
    		DB::table('stations')->insert([
	            'name' => 'Silla ' . $i,
	            'store_id' => 1
	        ]);
    	}
    	for ($i=1; $i < 4; $i++) { 
    		DB::table('stations')->insert([
	            'name' => 'Silla ' . $i,
	            'store_id' => 2
	        ]);
    	}
    }
}
