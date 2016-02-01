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

use Carbon\Carbon;

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    return [
        'category_id' => rand(1,2),
        'name' => $name,
        'slug' => str_slug($name, '-'),
        'abstract' => $faker->paragraph(rand(1,2)),
        'content' => $faker->paragraph(rand(2,5)),
        'price' => $faker->randomFloat(2,20,2000),
        'quantity' => rand(0,10),
        'published_at' => $faker->dateTime('now'),
    ];
});

$factory->define(App\Customer::class, function (Faker\Generator $faker) {
    static $userId = 0;
    return [
        'user_id'        => ++$userId,
        'address'        => $faker->address,
        'number_card'    => $faker->creditCardNumber,
        'number_command' => 0,
    ];
});