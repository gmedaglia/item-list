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


$path = public_path('img/sample');
$imgPaths = File::files($path);

$factory->define(Item::class, function (Faker $faker) use ($imgPaths) {
    $imgPath = $imgPaths[rand(0, count($imgPaths) - 1)];
    $img = basename($imgPath);
    Storage::put('img/', File::get($imgPath));

    return [
        'description' => $faker->text(300),
        'image' => $img,
    ];
});
