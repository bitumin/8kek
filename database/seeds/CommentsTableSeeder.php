<?php

use Illuminate\Database\Seeder;
use Bitumin\Comments\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Comment::class, 1000)->create();
    }
}
