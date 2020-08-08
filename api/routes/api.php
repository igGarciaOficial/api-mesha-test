<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->group(function()
{
    Route::get('/', 'UserController@index');
    
    Route::get('/profile/{id}', 'UserController@show'); // Get a specifique user;
    
    Route::post('/', 'UserController@store');

    Route::put('/{id}', 'UserController@update');

    Route::delete('/{id}', 'UserController@destroy');

    Route::put('/turnAEmployeer/{solicitante}/{final}', 'UserController@turnUserAEmployeer');
});