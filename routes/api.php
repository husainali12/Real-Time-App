<?php

Route::apiResource('/question','QuestionController');

Route::post('/question/create', 'QuestionController@store');

Route::apiResource('/category','CategoryController');