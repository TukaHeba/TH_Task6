<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::create([
            'body'=> 'Comment 1 in post 1',
            'post_id' => '1',
            'user_id'=> '1',
        ]);
        Comment::create([
            'body'=> 'Comment 2 in post 1',
            'post_id' => '1',
            'user_id'=> '2',
        ]);
        Comment::create([
            'body'=> 'Comment 3 in post 1',
            'post_id' => '1',
            'user_id'=> '3',
        ]);
        Comment::create([
            'body'=> 'Comment 1 in post 2',
            'post_id' => '2',
            'user_id'=> '1',
        ]);
        Comment::create([
            'body'=> 'Comment 2 in post 2',
            'post_id' => '2',
            'user_id'=> '2',
        ]);
        Comment::create([
            'body'=> 'Comment 3 in post 2',
            'post_id' => '2',
            'user_id'=> '3',
        ]);
        Comment::create([
            'body'=> 'Comment 4 in post 2',
            'post_id' => '2',
            'user_id'=> '1',
        ]);
        Comment::create([
            'body'=> 'Comment 1 in post 8',
            'post_id' => '8',
            'user_id'=> '1',
        ]);
        Comment::create([
            'body'=> 'Comment 1 in post 5',
            'post_id' => '5',
            'user_id'=> '2',
        ]);
        Comment::create([
            'body'=> 'Comment 2 in post 5',
            'post_id' => '5',
            'user_id'=> '2',
        ]);
        Comment::create([
            'body'=> 'Comment 1 in post 4',
            'post_id' => '4',
            'user_id'=> '3',
        ]);

    }
}
