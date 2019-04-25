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
            'name' => 'Царь',
            'email' => '777@gmail.com',
            'password' => bcrypt('777_777'),
        ]);
    }
}
