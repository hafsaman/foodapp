<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\PostsController;

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
  
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::get('getpostsall', [PostsController::class, 'getpostsall']);
     
/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::middleware('auth:api')->group( function () {
	
Route::get('getprofile/{id}', [UserController::class, 'getprofile']);
Route::put('profileedit', [UserController::class, 'profileedit']);
Route::put('profileabout', [UserController::class, 'profileabout']);
Route::put('follow/{id}', [UserController::class, 'follow']);
Route::put('unfollow/{id}', [UserController::class, 'unfollow']);
Route::post('createpost', [PostsController::class, 'create']);

Route::get('getposts', [PostsController::class, 'getposts']);
Route::get('likepost/{id}', [PostsController::class, 'likepost']);
Route::get('unlikepost/{id}', [PostsController::class, 'unlikepost']);
Route::get('favouritepost/{id}', [PostsController::class, 'favouritepost']);
Route::get('unfavouritepost/{id}', [PostsController::class, 'unfavouritepost']);
Route::put('commentpost', [PostsController::class, 'commentpost']);




});
