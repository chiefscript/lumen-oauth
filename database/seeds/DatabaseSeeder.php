<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;
use App\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Post::truncate();
        Comment::truncate();

        factory(App\User::class, 7)->create()->each(function ($user) {
            $posts = factory(App\Post::class)->make();
            $user->posts()->save($posts);
        });

        $this->call(CommentsTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
