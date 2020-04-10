<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
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


$imagePaths = File::files(public_path('img/sample'));

$factory->define(Item::class, function (Faker $faker) use ($imagePaths) {

    $origin = $imagePaths[rand(0, count($imagePaths) - 1)];
    $image = basename($origin);
    $destination = storage_path('app/public/images/' . $image);
    File::copy($origin, $destination);

    return [
        'description' => $faker->text(300),
        'image' => $image,
    ];
});
