<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\SourceController as AdminSourceController;

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

Route::get('/inf/', function () {
    return 'Information about project';
});

Route::get('/news/', function () {
    return 'All news';
});

Route::get('/welcome/', [NewsController::class, 'welcome']);
Route::get('/categories/', [NewsController::class, 'categories'])->name('categories');
Route::get('/category/{id}', [NewsController::class, 'categoryNews'])->name('category');
Route::get('/news/{catId}/{id}', [NewsController::class, 'newsItem'])->name('news');

//admin
Route::group(['prefix'=>'admin', 'as'=>'admin.'], function () {
    Route::view('/', 'admin.index')->name('main');
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('news', AdminNewsController::class);
    Route::resource('sources', AdminSourceController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
