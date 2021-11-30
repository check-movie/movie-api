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

Route::middleware(['is_movie_owner'])->group(function()
{
    Route::post('movie/{movie_id}/rate',       [ RateController::class, 'rate'])
        ->middleware('has_rated');

    Route::post('movie/{movie_id}/comment/store', [ CommentController::class, 'store']);

});

Route::middleware(['jwt.auth'])->group(function () {

    Route::post('movie/store',         [ MovieController::class, 'store'])
        ->middleware('has_stored');

    Route::get('movies/show',          [ MovieController::class, 'showMyMovies']);
    Route::get('movies/show/comments', [ MovieController::class, 'showMyMoviesWithComments']);
    Route::get('movies/show/rates',    [ MovieController::class, 'showMyMoviesWithRates']);

    Route::post('movie/rate/{rate_id}/update', [ RateController::class, 'update'])
        ->middleware('own_grade');

    Route::middleware(['is_comment_owner'])->group(function () {

        Route::post('comment/{comment_id}/update',    [ CommentController::class, 'update'])
            ->middleware('is_comment_owner');

        Route::delete('comment/{comment_id}/destroy', [ CommentController::class, 'destroy'])
            ->middleware('is_comment_owner');

    });

    Route::get('rates/show', [ RateController::class, 'showMyRates']);

});
