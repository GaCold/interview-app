<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    return [
        'product_code' => \Illuminate\Support\Str::random(),
        'product_name' => $faker->name,
        'price' => rand(100000, 500000),
        'image_path' => 'https://www.feedough.com/wp-content/uploads/2020/07/PRODUCT-LINE-808x451.png'
    ];
});
