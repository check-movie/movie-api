<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\CommentController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth', 'middleware' => 'api'], function () {
    Route::post('register',           [ AuthController::class, 'register']);
    Route::post('login',              [ AuthController::class, 'login']);
});


Route::middleware(['jwt.auth'])->group(function () {

    Route::post('movie/store', [ MovieController::class, 'store']);
    Route::get('movies/show',  [ MovieController::class, 'showMyMovies']);
    Route::get('movie/{movie_id}/show/comments',  [ MovieController::class, 'showMoviesWithComments']);

    Route::post('movie/{movie_id}/rate',          [ RateController::class, 'rate']);
    Route::post('movie/rate/{rate_id}/update',    [ RateController::class, 'update']);

    Route::post('movie/{movie_id}/comment/store', [ CommentController::class, 'store']);

});
Route::get('movies/index', [ MovieController::class, 'index']);

