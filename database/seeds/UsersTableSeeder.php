<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'first_name' => str_random(10),
            'last_name' => str_random(10),
            'phone' => str_random(20),
            'location' => 'default',
            'image' => 'https://picsum.photos/200/300/?image='.rand(1,200),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'type' => 'default',
        ]);
    }
}
