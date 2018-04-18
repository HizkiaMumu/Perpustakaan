<?php

Route::get('/login', ['as' => 'login', 'uses' => 'AdminPagesController@login']);

Route::post('/login', 'UsersController@auth');

Route::group(['middleware' => 'auth'], function(){
  Route::get('/admin', 'AdminPagesController@home');
});
