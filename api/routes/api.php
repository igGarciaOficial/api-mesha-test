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

    Route::post('/createEmployeer', 'UserController@createEmployeer'); 
});

Route::prefix('patient')->group(function(){
    Route::get('/{type?}', 'UserController@getUsersByType');
});

Route::prefix('attendance')->group(function()
{
    Route::get('/', 'AtendimentoController@index');

    Route::get('/patient/{id}', 'AtendimentoController@show');

    Route::post('/', 'AtendimentoController@store');

    Route::get('/duration/{idAtendimento}', 'RelacionamentoProcedimentoMedicosController@getTotalTime');

    Route::get('/{id}', 'AtendimentoController@getAttendenceById');
});