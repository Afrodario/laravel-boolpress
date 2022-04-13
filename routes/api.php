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
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


//Le rotte inserite dentro api.php rispondono al prefisso api, servono a Laravel per recuperare informazioni
Route::get('/posts', 'Api\PostController@index');

//Questa rotta rimanda al prefisso slug per la visualizzazione di ogni singolo post
Route::get('/posts/{slug}', 'Api\PostController@show');
