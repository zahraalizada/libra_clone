<?php



Route::prefix('author')->group(function() {
    Route::get('/', 'AuthorController@index')->name('author.index');
    Route::get('/create', 'AuthorController@create')->name('author.create');
    Route::post('/store', 'AuthorController@store')->name('author.store');
    Route::get('/edit/{id}', 'AuthorController@edit')->name('author.edit');
    Route::get('/update/{id}', 'AuthorController@update')->name('author.update');
    Route::get('/delete/{id}', 'AuthorController@destroy')->name('author.delete');

});
