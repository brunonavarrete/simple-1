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
            'email' => 'admin@simplesoftware.mx',
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
            'last_name' => 'Empleado',
            'email' => 'cindye@miriam.mx',
            'password' => bcrypt('asdfasdf'),
            'type' => 'employee',
            'owner_id' => 2
        ]);

        DB::table('users')->insert([
            'first_name' => 'María',
            'last_name' => 'Empleado',
            'email' => 'mariae@miriam.mx',
            'password' => bcrypt('asdfasdf'),
            'type' => 'employee',
            'owner_id' => 2
        ]);

        DB::table('users')->insert([
            'first_name' => 'Jimena',
            'last_name' => 'Empleado',
            'email' => 'jimenae@miriam.mx',
            'password' => bcrypt('asdfasdf'),
            'type' => 'employee',
            'owner_id' => 2
        ]);

        /*
         / Customer
        */

        DB::table('users')->insert([
            'first_name' => 'Sandra',
            'last_name' => 'Cliente',
            'email' => 'sandrac@hotmail.com',
            'password' => bcrypt('asdfasdf'),
            'type' => 'client',
            'owner_id' => 2
        ]);

        DB::table('users')->insert([
            'first_name' => 'Alejandra',
            'last_name' => 'Cliente',
            'email' => 'alejandrac@hotmail.com',
            'password' => bcrypt('asdfasdf'),
            'type' => 'client',
            'owner_id' => 2
        ]);

        DB::table('users')->insert([
            'first_name' => 'Sara',
            'last_name' => 'Cliente',
            'email' => 'sarac@hotmail.com',
            'password' => bcrypt('asdfasdf'),
            'type' => 'client',
            'owner_id' => 2
        ]);

        DB::table('users')->insert([
            'first_name' => 'Yolanda',
            'last_name' => 'Cliente',
            'email' => 'yolandac@hotmail.com',
            'password' => bcrypt('asdfasdf'),
            'type' => 'client',
            'owner_id' => 2
        ]);

        DB::table('users')->insert([
            'first_name' => 'Michele',
            'last_name' => 'Cliente',
            'email' => 'michelec@hotmail.com',
            'password' => bcrypt('asdfasdf'),
            'type' => 'client',
            'owner_id' => 2
        ]);
    }
}
