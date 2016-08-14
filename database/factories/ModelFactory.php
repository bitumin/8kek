<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'avatar' => 'default.jpg',
        'name' => $faker->userName,
        'email' => $faker->safeEmail,
        'password' => bcrypt('test'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => rtrim($faker->sentence(5), '.'),
        'image' => 'test.jpg',
        'up' => mt_rand(0,1000),
        'down' => mt_rand(0,1000),
        'views' => mt_rand(0,10000),
        'created_at' => $faker->dateTimeBetween('-2 years', 'now')
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'post_id' => App\Post::inRandomOrder()->first()->id,
        'user_id' => $faker->boolean(50) ? App\User::inRandomOrder()->first()->id : null,
        'content' => $faker->text(),
        'created_at' => $faker->dateTimeBetween('-2 years', 'now')
    ];
});
