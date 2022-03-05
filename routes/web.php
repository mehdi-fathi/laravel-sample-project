<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

//    Redis::set("test",'te');


//    dd(app('UserService')->getActiveUsers(10,7));
//
//    $class = new \App\Logic\UserService(app('App\Repositories\User\UserRepository'));

    dd(app('UserService')->getActiveUsers(10, 7));


    return view('welcome');
});
