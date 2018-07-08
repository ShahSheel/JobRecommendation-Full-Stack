<?php

use Faker\Generator as Faker;

$factory->define(App\JobSearches::class, function (Faker $faker) {
    return [
    	//'id' => 10,
        'jobrole' => $faker->sentence(),
        'location' => $faker->sentence(),

    ];
});
