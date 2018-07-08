<?php

use Faker\Generator as Faker;

$factory->define(App\JobDetails::class, function (Faker $faker) {
    return [
           'location_of_job' => $faker->sentences(), //For python entry
           'api'  => $faker->sentences(),//For Laravel 
           'redirect' => $faker->sentences(),// For python entry
            'description' => $faker->sentences(), // For python entry
            'salary' => $faker->sentences(), // For pythone entry
         
    ];
});
