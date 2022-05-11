<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(6),
        'price' => $faker->numberBetween(50,300),
        'image' => $faker->imageUrl($width = 640, $height = 480,'technics'),
    ];
});
