<?php

use App\Http\Controllers\PostController;
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

// Route::get('/', function () {
//     return view('top');
// });

Route::get('/', 'PostController@index');

Route::get('/list', function () {
    return view('posts/list');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/post', 'PostController@store');

Route::get('/post/show/{post_id}', 'PostController@show');

Route::put('/post/update/{post_id}', 'PostController@update');

Route::delete('/post/delete/{post_id}', 'PostController@delete');

Route::post('/like', 'PostController@like');

Route::post('/comment/{post_id}', 'CommentController@store');
