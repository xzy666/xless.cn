<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Article::class, function (Faker\Generator $faker) {
    static $title;
    return [
        'title' => $title=$faker->title(10),
        'subtitle' => $faker->word,
        //content 包括raw 和 html组成的json
        'content' =>json_encode(['raw'=>$faker->sentence,'html'=>$faker->sentence]),
        'slug' => $title.'-'.time().'-'.str_random(10),
        'page_image'=>$faker->imageUrl(),
        'meta_description'=>$faker->sentence,
        'is_draft'=>!!random_int(0,1),
        'is_original'=>!!random_int(0,1),
        'view_count'=>random_int(1,1000),
        'user_id'=>1,
        'last_user_id'=>1,
    ];
});
$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'parent_id'=>0,
        'description'=>$faker->sentence,
        'name'=>$faker->word,
        'image_url'=>$faker->imageUrl(),
        'path'=>$faker->word
    ];
});
$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'tag'=>$faker->uuid,
        'title'=>$faker->word,
        'meta_description'=>$faker->sentence
    ];
});
