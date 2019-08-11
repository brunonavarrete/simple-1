<?php

use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stores')->insert([
            'name' => 'Miriam - Álamos',
            'owner_id' => 2,
            'opens_at' => '10:00:00',
            'closes_at' => '19:00:00',
        ]);

        DB::table('stores')->insert([
            'name' => 'Miriam - Lomas del Marqués',
            'owner_id' => 2,
            'opens_at' => '10:00:00',
            'closes_at' => '19:00:00',
        ]);
    }
}
