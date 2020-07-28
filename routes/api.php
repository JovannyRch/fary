<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "API" middleware group. Enjoy building your API!
|

Route::middleware('auth:API')->get('/user', function (Request $request) {
    return $request->user();
});
*/



 //Posts
 Route::post('posts/', 'API\PostsController@create');
 Route::delete('posts/{id}', 'API\PostsController@destroy');
 Route::get('posts/', 'API\PostsController@index');
 Route::get('posts/urgentes', 'API\PostsController@postsWithoutRange');
 Route::get('posts/user/{user_id}/{lat}/{long}', 'API\PostsController@postsWithLogin');
 Route::get('posts/user/{user_id}', 'API\PostsController@postsWithLogin');
 Route::get('posts/{lat}/{long}', 'API\PostsController@index');
 Route::get('search/posts/{content}', 'API\PostsController@search');
 Route::get('search/posts/{content}/{lat}/{long}', 'API\PostsController@search');
 Route::get('posts/{id}', 'API\PostsController@show');
 
 //Comments
 Route::post('comments/posts','API\CommentsController@store' ); 
 Route::delete('comments/posts/{comment_id}','API\CommentsController@destroy' ); 
 Route::get('comments/posts/{post_id}', 'API\CommentsController@getComments');
 Route::get('comments/posts/{post_id}/firts', 'API\CommentsController@getFirtsComments');
 
 
 //Cars

 Route::post('cars/','API\CarsController@store'); 
 Route::get('cars/{id}','API\CarsController@show'); 
 Route::delete('cars/{id}','API\CarsController@destroy'); 
 Route::get('cars','API\CarsController@index'); 
 Route::get('cars/user/{user_id}/{lat}/{long}', 'API\CarsController@postsWithLogin');
 Route::get('cars/user/{user_id}', 'API\CarsController@postsWithLogin');
 Route::get('cars/{lat}/{long}','API\CarsController@index'); 
 Route::get('search/cars/{content}','API\CarsController@search'); 
 Route::get('search/cars/{content}/{lat}/{long}','API\CarsController@search'); 

 
 
 //Comentarios de post de autos usados
 Route::post('comments/cars','API\CommentCarPostsController@store' ); 
 Route::delete('comments/cars/{comment_id}','API\CommentCarPostsController@destroy' ); 
 Route::get('comments/cars/{car_post_id}', 'API\CommentCarPostsController@getComments');
 Route::get('comments/cars/{car_post_id}/firts', 'API\CommentCarPostsController@getFirtsComments');
 
 
 // Traer toda la publicidad de negocios
 Route::get('ads','API\AdsController@index' ); 
 Route::get('ads/{latitud}/{longitud}','API\AdsController@index' ); 
 Route::get('tipos','API\TiposController@index' ); 
 Route::get('tipos/{id}','API\TiposController@negocios' ); 

 //Notificaciones

 Route::get('notifications/{user_id}','API\NotificationsController@getNotifications');
 Route::put('notifications/cars/{id}','API\NotificationsController@verNotificacionCars');
 Route::put('notifications/posts/{id}','API\NotificationsController@verNotificacionPosts');