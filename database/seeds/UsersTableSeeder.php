<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Simple',
            'last_name' => 'Software',
            'email' => 'bruno.navarreteon@gmail.com',
            'password' => bcrypt('asdfasdf'),
            'type' => 'admin',
        ]);

        DB::table('users')->insert([
            'first_name' => 'Miriam',
            'last_name' => 'Ayala',
            'email' => 'miriam@miriam.mx',
            'password' => bcrypt('asdfasdf'),
            'type' => 'owner',
        ]);

        DB::table('users')->insert([
            'first_name' => 'Juan',
            'last_name' => 'Manager',
            'email' => 'juanm@miriam.mx',
            'password' => bcrypt('asdfasdf'),
            'type' => 'manager',
            'owner_id' => 2
        ]);

        /*
         / Employees
        */

        DB::table('users')->insert([
            'first_name' => 'Cindy',
            'last_name' => 'Jimenez',
            'email' => 'cindye@miriam.mx',
            'password' => bcrypt('asdfasdf'),
            'type' => 'employee',
            'owner_id' => 2,
            'store_id' => rand(1,2)
        ]);

        DB::table('users')->insert([
            'first_name' => 'María',
            'last_name' => 'Sánchez',
            'email' => 'mariae@miriam.mx',
            'password' => bcrypt('asdfasdf'),
            'type' => 'employee',
            'owner_id' => 2,
            'store_id' => rand(1,2)
        ]);

        DB::table('users')->insert([
            'first_name' => 'Jimena',
            'last_name' => 'Gómez',
            'email' => 'jimenae@miriam.mx',
            'password' => bcrypt('asdfasdf'),
            'type' => 'employee',
            'owner_id' => 2,
            'store_id' => rand(1,2)
        ]);

        DB::table('users')->insert([
            'first_name' => 'Daniela',
            'last_name' => 'Hernández',
            'email' => 'danih@miriam.mx',
            'password' => bcrypt('asdfasdf'),
            'type' => 'employee',
            'owner_id' => 2,
            'store_id' => rand(1,2)
        ]);

        DB::table('users')->insert([
            'first_name' => 'Laura',
            'last_name' => 'Chavez',
            'email' => 'lauc@miriam.mx',
            'password' => bcrypt('asdfasdf'),
            'type' => 'employee',
            'owner_id' => 2,
            'store_id' => rand(1,2)
        ]);

        DB::table('users')->insert([
            'first_name' => 'Georgina',
            'last_name' => 'Valle',
            'email' => 'geov@miriam.mx',
            'password' => bcrypt('asdfasdf'),
            'type' => 'employee',
            'owner_id' => 2,
            'store_id' => rand(1,2)
        ]);

        /*
         / Customer
        */

        DB::table('users')->insert([
            'first_name' => 'Sandra',
            'last_name' => 'González',
            'email' => 'sandrac@hotmail.com',
            'password' => bcrypt('asdfasdf'),
            'type' => 'client',
            'owner_id' => 2
        ]);

        DB::table('users')->insert([
            'first_name' => 'Alejandra',
            'last_name' => 'Andere',
            'email' => 'alejandrac@hotmail.com',
            'password' => bcrypt('asdfasdf'),
            'type' => 'client',
            'owner_id' => 2
        ]);

        DB::table('users')->insert([
            'first_name' => 'Sara',
            'last_name' => 'López',
            'email' => 'sarac@hotmail.com',
            'password' => bcrypt('asdfasdf'),
            'type' => 'client',
            'owner_id' => 2
        ]);

        DB::table('users')->insert([
            'first_name' => 'Yolanda',
            'last_name' => 'Gómez',
            'email' => 'yolandac@hotmail.com',
            'password' => bcrypt('asdfasdf'),
            'type' => 'client',
            'owner_id' => 2
        ]);

        DB::table('users')->insert([
            'first_name' => 'Michelle',
            'last_name' => 'De la Garza',
            'email' => 'michelec@hotmail.com',
            'password' => bcrypt('asdfasdf'),
            'type' => 'client',
            'owner_id' => 2
        ]);
    }
}
