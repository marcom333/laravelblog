<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        "title"=>$faker->catchPhrase(),
        "description"=>$faker->paragraph(3,true),
        "owner_id"=>1,
    ];
});
