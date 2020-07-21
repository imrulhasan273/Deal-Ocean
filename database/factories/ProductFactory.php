<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2),
        'description' => $faker->sentence(20),
        'price' => $faker->numberBetween(100, 5000),
        // 'shop_id' => $faker->numberBetween(5, 6),
        'cover_img' => 'demo_product.jpg'
    ];
});
