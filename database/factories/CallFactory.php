<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Call;
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


$factory->define(Call::class, function (Faker $faker) {
	$start_dateTIme = date('Y-m-d H:i:s');
    return [
        'user_id' => User::all()->random()->id,
        'title' => $faker->realText(15),
        'content' => $faker->realText(255),
        'start_dateTIme' => $start_dateTIme,
        'end_dateTime' => date('Y-m-d H:i:s', strtotime($start_dateTIme. '+1 days')),
        'status' => 1
    ];
});
