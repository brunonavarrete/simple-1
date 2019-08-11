<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $servicios = ['Corte','Uñas','Tinte','Peinado','Maquillaje','Pestañas'];

        for ($i=0; $i < count($servicios); $i++) { 
        	DB::table('services')->insert([
    			'name' => $servicios[$i],
    			'cost' => rand(150,300),
	            'duration' => 60,
	            'owner_id' => 2,
	        ]);
        }
    }
}
