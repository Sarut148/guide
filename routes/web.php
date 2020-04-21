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
Route::get('/', 'HomeController@index');
Auth::routes();
Route::get('/home', 'TaskController@index');
// Route::get('/task', 'TaskController@index');
Route::get('/show-task', 'TaskController@show_task');
Route::post('/search_task_user', 'TaskController@get_taskByUser');

Route::get('/show-guide', 'UserController@get_all');
Route::post('/search_guide', 'UserController@get_byCard');
Route::get('/manage-profile', 'UserController@get_youself');
Route::post('/update-profile', 'UserController@update');

Route::get('/show-tour', 'TourController@index');
Route::post('/add-tour', 'TourController@insert');
Route::post('/update-tour', 'TourController@update');
Route::post('/delete-tour', 'TourController@delete');
Route::post('/update-tour_detail', 'TourController@add_guide');


Route::post('/search_card', 'CardController@get_card');
Route::get('/manage-card', 'CardController@index');
Route::post('/add-card', 'CardController@insert');
Route::post('/update-card', 'CardController@update');
Route::get('/manage-yourcard', 'CardController@get_cardByID');
Route::post('/add-card_detail', 'CardController@insert_card_detail');

Route::post('/delete-card', 'CardController@delete_card');
Route::post('/delete-typecard', 'CardController@delete_type');
