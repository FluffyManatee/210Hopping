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
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->freeEmail,
        'password' => bcrypt(123),
//        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Bar::class, function (Faker\Generator $faker) {
    $types = ['Dive Bar', 'Jazz Bar', 'Club', 'Country Bar'];
    $areas = ['Downtown', 'Alamo Heights', 'SouthTown', 'Stone Oak', 'North Central', 'Tobin Hill', 'The Rim'];
    return [
        'type' => $types[mt_rand(0,3)],
        'area' => $areas[mt_rand(0,6)],
        'name' => $faker->unique()->company,
        'address' => $faker->streetAddress,
        'phone' => $faker->randomNumber(7),
        'website' => $faker->url,
        'email' => $faker->freeEmail,
        'owner' => 0,
    ];
});

$factory->define(App\Review::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(),
        'content' => $faker->paragraph(),
        'created_by' => App\User::all()->random()->id,
        'beer_rating' => mt_rand(1,5),
        'bar_id' => App\Bar::all()->random()->id,
    ];
});


$factory->define(App\Special::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(),
        'content' => $faker->paragraph(),
        'bar_id' => App\Bar::all()->random()->id,
    ];
});

$factory->define(App\Event::class, function (Faker\Generator $faker) {
    return [
        'bar_id' => App\Bar::all()->random()->id,
        'title' => $faker->sentence(),
        'date' => $faker->date(),
        'content' => $faker->paragraph(),
        'created_by' => App\User::all()->random()->id,
    ];
});

$factory->define(App\Vote::class, function (Faker\Generator $faker) {
    return [
        'review_id' => App\Review::all()->random()->id,
        'vote' => mt_rand(0,1),
        'user_id' => App\User::all()->random()->id,
    ];
});

$factory->define(App\Feature::class, function (Faker\Generator $faker) {
    return [
        'bar_id' => App\Bar::all()->random()->id,
        'noise_level' => mt_rand(1,5),
        'smoking' => mt_rand(0,1),
        'food' => mt_rand(0,1),
        'pet_friendly' => mt_rand(0,1),
        'bikes' => mt_rand(0,1),
        'live_music' => mt_rand(0,1),
        'reservations' => mt_rand(0,1),
        'tvs' => mt_rand(0,1),
        '18+' => mt_rand(0,1),
        'kids' => mt_rand(0,1),
        'patio' => mt_rand(0,1),
        'pool' => mt_rand(0,1),
        'darts' => mt_rand(0,1),
    ];
});

$factory->define(App\Picture::class, function (Faker\Generator $faker) {
    return [
        'bar_id' => App\Bar::all()->random()->id,
        'pic_url' => $faker->imageUrl('cats'),
    ];
});