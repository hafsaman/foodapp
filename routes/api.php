<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\PostsController;
use App\Http\Controllers\API\LabelController;
use App\Http\Controllers\API\RatingController;


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
Route::post('sociallogin', [RegisterController::class, 'sociallogin']);
Route::get('getregion', [RegisterController::class, 'region']);

Route::get('getpostsall', [PostsController::class, 'getpostsall']);
     
/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

//Route::middleware('auth:sanctum')->group( function () {
Route::middleware('auth:api')->group( function () {

Route::get('getprofile/{id}', [UserController::class, 'getprofile']);
Route::put('profileedit', [UserController::class, 'profileedit']);
Route::put('profileabout', [UserController::class, 'profileabout']);
Route::get('follow/{id}', [UserController::class, 'follow']);
Route::get('unfollow/{id}', [UserController::class, 'unfollow']);
Route::get('getfollwer', [UserController::class, 'getfollwer']);


Route::post('createpost', [PostsController::class, 'createpost']);
Route::get('getposts', [PostsController::class, 'getposts']);
Route::get('likepost/{id}', [PostsController::class, 'likepost']);
Route::get('unlikepost/{id}', [PostsController::class, 'unlikepost']);
Route::get('favouritepost/{id}', [PostsController::class, 'favouritepost']);
Route::get('unfavouritepost/{id}', [PostsController::class, 'unfavouritepost']);
Route::put('commentpost', [PostsController::class, 'commentpost']);
Route::get('getpostcomment/{postid}',[PostsController::class,'getcomment']);
Route::get('getpostfavourite',[PostsController::class,'getfavourite']);

Route::post('createlabel', [LabelController::class, 'createlabel']);
Route::get('getlabel', [LabelController::class, 'getlabel']);
Route::post('editlabel/{id}', [LabelController::class, 'editlabel']);
Route::post('deletelabel/{id}', [LabelController::class, 'deletelabel']);
Route::post('edituserlabel', [LabelController::class, 'edituserlabel']);

Route::post('addrate', [RatingController::class, 'addrate']);
Route::get('listrate', [RatingController::class, 'listrate']);

Route::get('getsearch', [PostsController::class, 'getsearch']);

Route::get('discover', [PostsController::class, 'discover']);
Route::get('getnotification', [PostsController::class, 'getnotification']);


});
