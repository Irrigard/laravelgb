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
    return view('welcome');
});

Route::get('/welcome/', function () {
    return 'Welcome, user';
});

Route::get('/inf/', function () {
    return 'Information about project';
});

Route::get('/news/{id}', function (string $id) {
    return "News $id";
});

Route::get('/news/', function () {
    return 'All news';
});
