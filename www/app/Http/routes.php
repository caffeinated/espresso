<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'EspressoController@index');

Route::get('virtualhost/add', 'VirtualHostsController@add');
Route::post('virtualhost/add', 'VirtualHostsController@store');

Route::get('apache/error-log', 'Apache\ErrorLogController@index');
Route::get('apache/error-log/show', 'Apache\ErrorLogController@show');

/*
|--------------------------------------------------------------------------
| View Composers
|--------------------------------------------------------------------------
|
*/

View::composer('layouts.partials.sidebar', 'App\Composers\SidebarComposer');