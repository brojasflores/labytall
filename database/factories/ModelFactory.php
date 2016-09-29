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
        'rut' => $faker->numberBetween($min=1000000, $max=20000000),
        'email' => $faker->safeEmail,
        'nombres' => $faker->firstName,
        'apellidos' => $faker->lastName,
        'password' => bcrypt('pass'),
        'remember_token' => str_random(10),
    ];
});
