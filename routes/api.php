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
Route::post('forgotPassword', [RegisterController::class, 'forgotPassword']);
Route::post('verify_otp', [RegisterController::class, 'VerifyOTP']);
Route::post('changepassword', [RegisterController::class, 'ChangePassword']);
Route::post('sociallogin', [RegisterController::class, 'sociallogin']);
Route::get('getregion', [RegisterController::class, 'region']);
Route::post('teslike', [PostsController::class, 'teslike']);



Route::get('getpostsall', [PostsController::class, 'getpostsall']);
Route::post('getpostsearch', [PostsController::class, 'getpostsearch']);

     
/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

//Route::middleware('auth:sanctum')->group( function () {
Route::middleware('auth:api')->group( function () {
	
Route::post('changelanguage', [UserController::class, 'changelanguage']);
Route::get('getprofile/{id?}', [UserController::class, 'getprofile']);
Route::post('allrecommendations', [UserController::class, 'allrecommendations']);
Route::post('profileedit', [UserController::class, 'profileedit']);
Route::put('profileabout', [UserController::class, 'profileabout']);
Route::get('follow/{id}', [UserController::class, 'follow']);
Route::get('unfollow/{id}', [UserController::class, 'unfollow']);
Route::get('getfollwer', [UserController::class, 'getfollwer']);

Route::get('getlatlong', [PostsController::class, 'getlatlong']);
Route::post('createpost', [PostsController::class, 'createpost']);
Route::post('editpost', [PostsController::class, 'editpost']);
Route::post('deletepostgallary', [PostsController::class, 'deletepostgallary']);
Route::get('getposts', [PostsController::class, 'getposts']);
Route::get('likepost/{id}', [PostsController::class, 'likepost']);
Route::get('unlikepost/{id}', [PostsController::class, 'unlikepost']);
Route::get('favouritepost/{id}', [PostsController::class, 'favouritepost']);
Route::get('unfavouritepost/{id}', [PostsController::class, 'unfavouritepost']);
Route::put('commentpost', [PostsController::class, 'commentpost']);
Route::get('getpostcomment/{postid}',[PostsController::class,'getcomment']);
Route::post('getpostfavourite',[PostsController::class,'getfavourite']);
Route::post('getparticularpost',[PostsController::class,'getparticularpost']);
Route::post('deletepost',[PostsController::class,'deletepost']);



Route::post('createlabel', [LabelController::class, 'createlabel']);
Route::get('getlabel', [LabelController::class, 'getlabel']);
Route::post('editlabel/{id}', [LabelController::class, 'editlabel']);
Route::post('deletelabel/{id}', [LabelController::class, 'deletelabel']);
Route::post('edituserlabel', [LabelController::class, 'edituserlabel']);

Route::post('storeoreditOrBuy', [UserController::class, 'storeoreditOrBuy']);
Route::get('defaultLabels', [UserController::class, 'defaultLabels']);



Route::post('addrate', [RatingController::class, 'addrate']);
Route::get('listrate', [RatingController::class, 'listrate']);

Route::get('getsearch', [PostsController::class, 'getsearch']);

Route::post('discover', [PostsController::class, 'discover']);
Route::post('seasonal', [PostsController::class, 'seasonal']);
Route::get('discover_seasonal_posts', [PostsController::class, 'discover_seasonal_posts']);

Route::get('getnotification', [PostsController::class, 'getnotification']);
Route::post('on_offnotifications', [PostsController::class, 'on_offnotifications']);


Route::post('follwersdata', [UserController::class, 'follwersdata']);
Route::post('follwingdata', [UserController::class, 'follwingdata']);
Route::post('getvideos', [UserController::class, 'getvideos']);
Route::post('getphotos', [UserController::class, 'getphotos']);
Route::post('getshoppingposts', [UserController::class, 'getshoppingposts']);
Route::post('getallLabels', [PostsController::class, 'getallLabels']);

Route::get('logoutuser', [UserController::class, 'logout']);
Route::post('getallpostlikes', [PostsController::class, 'getallpostlikes']);



});
