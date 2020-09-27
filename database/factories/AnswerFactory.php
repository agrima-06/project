<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\PracticeAnswer::class, function (Faker $faker) {
	$options = array("A", "B", "C", "D", "E");
    return [
        'optionA' => $faker->word, 
        'optionB' => $faker->word,
        'optionC' => $faker->word,
        'optionD' => $faker->word,
        'optionE' => $faker->word, // password
        'correct_option' => $options[rand(0, 4)],
        'hint' =>  $faker->sentence(10),
        'explanation' => $faker->paragraph(3),
    ];
});


     