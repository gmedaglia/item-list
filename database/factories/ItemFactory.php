<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;

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


$img = Storage::files('public/img/sample');

$factory->define(Item::class, function (Faker $faker) use ($img) {
    return [
        'description' => $faker->text(300),
        'image' => basename($img[rand(0, count($img) - 1)]),
    ];
});
