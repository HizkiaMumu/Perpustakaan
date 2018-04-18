<?php

Route::get('/login', ['as' => 'login', 'uses' => 'AdminPagesController@login']);

Route::post('/login', 'UsersController@auth');

Route::get('/logout', 'UsersController@logout');

Route::group(['middleware' => 'auth'], function(){
  Route::get('/admin', 'AdminPagesController@halamanBuku');

  // CRUD BUKU
  Route::post('/admin/buku/tambah-buku', 'BukuController@tambahBuku');
  Route::get('/admin/buku/hapus-buku/{id}', 'BukuController@hapusBuku');
  Route::get('/admin/buku/detail-buku/{id}', 'BukuController@detailBuku');
  Route::post('/admin/buku/detail-buku/{id}', 'BukuController@editBuku');
  // END CRUD BUKU
});
