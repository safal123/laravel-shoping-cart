<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => $faker->numberBetween($min = 1, $max = 10),
        'name' => $faker->name,
        'description' => $faker->text,
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 20),
        'discount' => $faker->numberBetween($min = 1, $max = 100),
        'is_active' => 1
    ];
});
