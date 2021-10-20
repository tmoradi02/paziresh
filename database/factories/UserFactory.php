<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\PermissionUser;
use App\Channel;
use App\Classes;
use App\ArmAgahi;
use App\Box_Type;
use App\Box_Prog_Group;
use App\Cast;
use App\Product;
use App\Title;
use App\Owner;
use App\Adver_Type;
use App\Adver_Type_Coef;
use App\Tariff;


use carbon\carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'status' => '1',
        'tell'=> $faker->phoneNumber ,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(PermissionUser::class, function( )
{
    return [
        'user_id' => rand(1,10),
        'permission_id' => rand(1,10),
    ];
});

$factory->define(Channel::class, function(Faker $faker)
{
    return [
        'channel_name' => $faker->name ,
        'degree' => rand(1,20),
        'kind' => rand(1,2),
        'user_id' => rand(1,10),
    ];
});

$factory->define(Classes::class , function(Faker $faker)
{
    return [
        'class_name' => $faker->name ,
        'user_id' => rand(1,10),
    ];
});

$factory->define(Box_Type::class , function(Faker $faker)
{
    return [
        'box_type' => $faker->name ,
        'user_id' => rand(1,10),
    ];
});

$factory->define(Box_Prog_Group::class , function(Faker $faker)
{
    return
    [
        'prog_group' => $faker->name,
        'user_id' => rand(1,10),
    ];
});

$factory->define(Cast::class , function(Faker $faker)
{
    return 
    [
        'cast' => $faker->name ,
        'user_id' => rand(1,10),
    ];
});

$factory->define(Product::class , function(Faker $faker)
{
    return[
        'product' => $faker->name,
        'cast_id' => rand(1,10),
        'user_id' => rand(1, 10),
    ];
});

$factory->define(Title::class, function(Faker $faker)
{
    return [
        'title' => $faker->name,
        'user_id' => rand(1, 10),
    ];
});

$factory->define(Owner::class , function(Faker $faker)
{
    return [
        'owner' => $faker->name,
        'manager_owner' => $faker->name,
        'tell_owner' => $faker->phoneNumber,
        'fax_owner' =>  $faker->phoneNumber, 
        'email_owner' => $faker->safeEmail,
        'address_owner' => $faker->address,
        'kind_group' => rand(1,3),
        'description_owner' => $faker->name,
        'user_id' => rand(1,10),
    ];
});

$factory->define(Adver_Type::class , function(Faker $faker)
{
    return [
        'adver_type' => $faker->name ,
        'user_id' => rand(1,10),
    ];
});

$factory->define(Adver_Type_Coef::class,function()
{
    return [
        'Adver_Type_id' => rand(1,10),
        'coef' => rand(1,6),
        'from_date' => carbon::now()->addDays(rand(5,10)),
        'to_date' => carbon::now()->addDays(rand(20,30)),
        'user_id' => rand(1,10),
    ];
});

$factory->define(ArmAgahi::class, function()
{
    return [
        'channel_id' => rand(1,10),
        'coef' => rand(1,3),
        'from_date' => carbon::now()->addDays(rand(5,10)),   //carbon::now()->addDays(rand(5,10)), //$faker->date('Y_m_d'),  //date($format = 'Y-m-d', $max = 'now') // '1979-06-09'
        'to_date' => carbon::now()->addDays(rand(20,30)),    //$faker->date(),
        'user_id' => rand(1,10),
    ];
});

$factory->define(Tariff::class, function(Faker $faker)
{
    return [
        'channel_id' => rand(1,14),
        'classes_id' => rand(1,15),
        'from_date' => carbon::now()->addDays(rand(5,10)),
        'to_date' => carbon::now()->addDays(rand(20,30)),
        'box_type_id' => rand(1,20),
        // 'price' => $faker->randomFloat(4, 0, 100000),
        'price' => $faker->randomNumber(5),
        'user_id' => rand(1,12),
    ];
});



