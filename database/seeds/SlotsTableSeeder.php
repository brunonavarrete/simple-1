<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SlotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	/*
		 /
		 / Store 1
		 /
    	*/
    	for ($i=0; $i < 10; $i++) { 
    		$begins_at = rand(10,18);
    		DB::table('slots')->insert([
    			'client_id' => rand(7,11),
    			'employee_id' => rand(4,6),
	            'station_id' => rand(1,3),
	            'service_id' => rand(1,6),
	            'date' => Carbon::create('2019', '09', rand(1,30)),
	            'begins_at' => $begins_at . ':00:00',
	            'ends_at' => ($begins_at + 1) . ':00:00',
	        ]);
    	}

    	/*
		 /
		 / Store 1
		 /
    	*/
    	for ($i=0; $i < 10; $i++) { 
    		$begins_at = rand(10,18);
    		DB::table('slots')->insert([
    			'client_id' => rand(7,11),
    			'employee_id' => rand(4,6),
	            'station_id' => rand(4,6),
	            'service_id' => rand(1,6),
	            'date' => Carbon::create('2019', '09', rand(1,30)),
	            'begins_at' => $begins_at . ':00:00',
	            'ends_at' => ($begins_at + 1) . ':00:00',
	        ]);
    	}
    }
}
