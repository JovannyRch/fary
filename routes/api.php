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
 Route::get('posts/', 'API\PostsController@index');
 Route::get('posts/user/{user_id}', 'API\PostsController@myPosts');
 Route::get('posts/{lat}/{long}', 'API\PostsController@index');
 Route::get('posts/search/{content}', 'API\PostsController@search');
 Route::get('posts/search/{content}/{lat}/{long}', 'API\PostsController@search');
 Route::get('posts/{id}', 'API\PostsController@show');
 Route::delete('posts/{id}', 'API\PostsController@destroy');
 
 //Comments
 Route::post('comments','API\CommentsController@store' ); 
 Route::delete('comments/{comment_id}','API\CommentsController@destroy' ); 
 Route::get('comments/post/{post_id}', 'API\CommentsController@getComments');
 Route::get('comments/post/{post_id}/firts', 'API\CommentsController@getFirtsComments');
 
 
 //Cars
 Route::get('cars','API\CarsController@index'); 
 Route::get('cars/user/{user_id}','API\CarsController@myPosts'); 
 Route::get('cars/{lat}/{long}','API\CarsController@index'); 
 Route::get('cars/search/{content}','API\CarsController@search'); 
 Route::get('cars/search/{content}/{lat}/{long}','API\CarsController@search'); 

 Route::post('cars/','API\CarsController@store'); 
 Route::delete('cars/{id}','API\CarsController@destroy'); 
 
 
 //Comentarios de post de autos usados
 Route::post('car/comments','API\CommentCarPostsController@store' ); 
 Route::delete('car/comments/{comment_id}','API\CommentCarPostsController@destroy' ); 
 Route::get('car/{car_post_id}/comments', 'API\CommentCarPostsController@getComments');
 Route::get('car/{car_post_id}/comments/firts', 'API\CommentCarPostsController@getFirtsComments');
 
 
 // Traer toda la publicidad de negocios
 Route::get('ads','API\AdsController@index' ); 
 Route::get('tipos','API\TiposController@index' ); 
 Route::get('tipos/{id}','API\TiposController@negocios' ); 