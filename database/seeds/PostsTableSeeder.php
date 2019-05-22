<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title' => str_random(30),
            'body' => str_random(250),
            'cover_image' => 'https://picsum.photos/200/300/?image='.rand(1,200),
            'user_id' => rand(1, 10),

        ]);
    }
}
