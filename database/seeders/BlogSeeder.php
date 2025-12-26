<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(8)->create()->each(function ($user) {
           
            Post::factory(rand(3, 7))->create([
                'user_id' => $user->id,
            ])->each(function ($post) {
               
                Comment::factory(rand(2, 12))->create([
                    'post_id' => $post->id,
                ]);
            });
        });
    }
}

