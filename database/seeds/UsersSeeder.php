<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'someuser',
            'email' => 'someuser@gmail.com',
            'password' => bcrypt('123456')
        ]);
        DB::table('users')->insert([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('manager')
        ]);
        DB::table('users')->insert([
            'name' => 'testBuyer',
            'email' => 'someEmail@gmail.com',
            'password' => bcrypt('BuyerTests')
        ]);
    }
}
