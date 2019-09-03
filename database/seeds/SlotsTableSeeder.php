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
    	for ($i=0; $i < 100; $i++) { 
    		$begins_at = rand(10,18);
    		DB::table('slots')->insert([
    			'client_id' => rand(10,14),
    			'employee_id' => rand(4,9),
	            'service_id' => rand(1,6),
	            'date' => Carbon::create('2019', '09', rand(1,15)),
	            'begins_at' => $begins_at . ':00:00',
	            'ends_at' => ($begins_at + 1) . ':00:00',
	        ]);
    	}
    }
}
