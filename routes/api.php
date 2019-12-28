<?php

Route::apiResource('/question','QuestionController');

Route::post('/question/create', 'QuestionController@store');

Route::apiResource('/category','CategoryController');

Route::apiResource('/question/{question}/reply','ReplyController');

Route::post('like/{reply}','LikeController@likeIt');
Route::delete('like/{reply}','LikeController@unLikeIt');

Route::group([

    'middleware' => 'api',
//    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});