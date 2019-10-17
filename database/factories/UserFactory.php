<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $randomCreatedAt = Carbon::now();
    $randomCreatedAt
        ->subDays(rand(2,144))
        ->setHours(rand(0,23))
        ->setMinutes(rand(0,59))
        ->setSeconds(rand(0,59));
    $randomVerifiedAt = $randomCreatedAt->copy()->addMinutes(rand(2,30));
    return [
        'username' => $faker->userName,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'created_at' => $randomCreatedAt,
        'updated_at' => $randomCreatedAt,
        'email_verified_at' => $randomVerifiedAt,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
