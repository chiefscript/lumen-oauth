<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 7)->create()->each(function ($user) {
            $posts = factory(App\Post::class)->make();
            $user->posts()->save($posts);

            $comments = factory(App\Comment::class, 7)->make();
            $user->comments()->saveMany($comments);
        });
    }
}
