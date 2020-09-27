<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\PracticeQuestion::class, function (Faker $faker) {
    return [
        'subject_id' => rand(1, 4), 
        'sclass_id' => rand(1, 4),
        'topic_id' => rand(1,4),
        'question' => $faker->sentence(10),
        'Level' => rand(1, 4), // password
        'answer_id' => rand(1, 10),
        'user_id' => rand(1, 4),
    ];
});


     