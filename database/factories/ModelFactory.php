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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password = '';

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'token' => $faker->sha256,
        'remember_token' => str_random(10),
    ];
});

$factory->state(\App\Models\User::class, 'admin', function (\Faker\Generator $faker) {
    return [
        'is_admin' => 1,
    ];
});

$factory->define(App\Models\Question::class, function (Faker\Generator $faker) {
    return [
        'title' => null,
        'is_multiple' => false
    ];
});

$factory->define(App\Models\Answer::class, function (Faker\Generator $faker) {
    return [
        'title' => null
    ];
});

$factory->define(App\Models\UserAnswer::class, function (Faker\Generator $faker) {
    return [
        'user_id' => null,
        'answer_id' => null,
        'question_id' => null
    ];
});
