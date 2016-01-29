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

/*$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});*/

// factory pour insérer des données dans la table products par l'entité Product
use Carbon\Carbon;

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    return [
        'category_id' => rand(1,2),
        'name' => $name,
        'slug' => str_slug($name, '-'),
        'abstract' => $faker->paragraph(rand(1,2)),
        'content' => $faker->paragraph(rand(2,5)),
        'price' => $faker->randomFloat(2,20,2000), // 2: nombre de chiffres après la virgule, 20: min, 2000: max
        'quantity' => rand(0,10),
        'published_at' => $faker->dateTime('now'),
    ];
});

/*$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return ['name' => $faker->word];
});*/

$factory->define(App\Customer::class, function (Faker\Generator $faker) {
    static $userId = 0;     // variable statique n'est reconnue que dans la fonction, chaque fois on l'appèlle la fonction, cette variable statique va garder sa valeur précédante
    return [
        'user_id'        => ++$userId,  // d'abord incrémenter et après faire assigner à $userId
        'address'        => $faker->address,
        'number_card'    => $faker->creditCardNumber,
        'number_command' => 0,
    ];
});