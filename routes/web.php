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

Auth::routes();
Route::get('/register/negocio/paso1', 'Auth\RegisterController@registerNegocio')->name('register.cuenta');
Route::post('/register/negocio', 'Auth\RegisterController@registerNegocioAccount')->name('register.negocio.post');
Route::get('/register/negocio/paso2', 'Auth\RegisterController@addNegocio')->middleware('noOwner')->name('register.negocio');



Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'WebController@index')->middleware('owner')->name('index');
Route::get('/upload/image', 'WebController@uploadImage')->name('uploadImage');

//POST


Route::get('/posts/create', 'WebController@createPost')->name('createpost');
Route::post('/posts/save', 'API\PostsController@create')->name('post.save');
Route::get('/post/{id}', 'WebController@showPost')->name('showPost');
Route::get('/car/{id}', 'WebController@showPost')->name('showPost');


//CARS
Route::get('/cars', 'WebController@index')->middleware('owner')->name('cars');
Route::get('/cars/create', 'WebController@createCarPost')->name('newcar');
Route::post('/cars/save', 'API\CarsController@store')->name('cars.save');


//Admin
Route::get('/dashboard','AdminController@dashboard')->middleware('admin')->name('admin-index');
Route::resource('comment', 'CommentsController')->middleware("admin");
Route::delete('commentCar/{id}', 'CommentsController@destroyCarComment')->middleware("admin")->name('comment.car.destroy');
Route::resource('commentcar', 'CommentsController')->middleware("admin");
Route::resource('admin/post', 'Dashboard\PostController')->middleware("admin");
Route::resource('admin/user', 'Dashboard\UserController')->middleware('admin');
Route::resource('admin/car', 'Dashboard\CarController')->middleware('admin');
Route::resource('admin/ads', 'Dashboard\AdsController')->middleware('admin');
Route::resource('admin/negocios', 'Dashboard\NegociosController');
Route::resource('admin/tipos', 'Dashboard\TiposController')->middleware('admin');
Route::resource('admin/tipos', 'Dashboard\TiposController')->middleware('admin');
Route::get('admin/posts/latest', 'Dashboard\PostController@latest')->middleware('admin');
Route::delete('admin/posts/latest/destroy', 'Dashboard\PostController@latestDestroy')->middleware('admin');

//Informativos
Route::get('/mision', 'WebController@index')->name('mision');
Route::get('/vision', 'WebController@index')->name('vision');
Route::get('/aviso-privacidad', 'WebController@index')->name('aviso-privacidad');
Route::get('/ayuda', 'WebController@index')->name('ayuda');
Route::get('/zona-publicitaria', 'WebController@index')->name('zona');
Route::get('/zona-publicitaria/{id}', 'WebController@index')->name('zona-show');
Auth::routes();

