<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'f_name'=>'Mohamed',
            'l_name'=>'osama',
            'role_id'=>'1',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('123456'),
            'mobile_number'=>'0111111111',
        ]);
    }
}
