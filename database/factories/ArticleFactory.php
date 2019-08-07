<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
      'title'=>$faker->text(50),
      'body'=>$faker->text(200),
      'user_id'=>8
    ];
});
