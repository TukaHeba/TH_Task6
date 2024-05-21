<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'title' => 'Post 1',
            'body'=> 'The body of: post 1',
            'category_id' => '1',
            'user_id'=> '1',
        ]);
        Post::create([
            'title' => 'Post 2',
            'body'=> 'The body of: post 2',
            'category_id' => '2',
            'user_id'=> '1',
        ]);
        Post::create([
            'title' => 'Post 3',
            'body'=> 'The body of: post 3',
            'category_id' => '3',
            'user_id'=> '1',
        ]);
        Post::create([
            'title' => 'Post 4',
            'body'=> 'The body of: post 4',
            'category_id' => '1',
            'user_id'=> '2',
        ]);
        Post::create([
            'title' => 'Post 5',
            'body'=> 'The body of: post 5',
            'category_id' => '2',
            'user_id'=> '2',
        ]);
        Post::create([
            'title' => 'Post 6',
            'body'=> 'The body of: post 6',
            'category_id' => '3',
            'user_id'=> '2',
        ]);
        Post::create([
            'title' => 'Post 7',
            'body'=> 'The body of: post 7',
            'category_id' => '1',
            'user_id'=> '3',
        ]);
        Post::create([
            'title' => 'Post 8',
            'body'=> 'The body of: post 8',
            'category_id' => '2',
            'user_id'=> '3',
        ]);
        Post::create([
            'title' => 'Post 9',
            'body'=> 'The body of: post 9',
            'category_id' => '3',
            'user_id'=> '3',
        ]);

    }
}
