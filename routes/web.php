<?php

use Illuminate\Support\Facades\Route;
/*Client*/
Route::get('/', 'IndexController@index')->name('client.index');
Route::get('introduction', 'IndexController@introduction')->name('client.introduction');
Route::get('contact', 'IndexController@contact')->name('client.contact');
Route::post('contact', 'IndexController@sendMail')->name('client.contact');
Route::get('promotions', 'IndexController@promotion')->name('client.promotions');


Route::group(['prefix' => 'services'], function () {
    Route::get('/', 'IndexController@services')->name('client.services.index');
    Route::get('{service}', 'IndexController@detailService')->name('client.services.detail');
});

Route::group(['prefix' => 'typerooms'], function () {
    Route::get('/', 'IndexController@typeRoom')->name('client.typerooms.index');
    Route::get('{typeRoom}', 'IndexController@detailTypeRoom')->name('client.typerooms.detail');
});
/*Admin*/
Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::get('/', 'IndexController@index')->name('index');

    Route::prefix('diagram')->name('diagram.')->group(function () {
        Route::get('/', 'DiagramController@index')->name('index');
    });

    Route::prefix('type-rooms')->name('type-rooms.')->group(function () {
        Route::get('/', 'TypeRoomController@index')->name('index');
        Route::get('/getListTypeRoom', 'TypeRoomController@getListTypeRoom')->name('getListTypeRoom');
        Route::get('/create', 'TypeRoomController@createTypeRoom')->name('create');
        Route::post('/create', 'TypeRoomController@actionCreateTypeRoom')->name('actionCreateTypeRoom');
        Route::get('/{id}/delete', 'TypeRoomController@delete')->name('delete');
        Route::get('/{id}/detail', 'TypeRoomController@detail')->name('detail');
        Route::get('/{id}/edit', 'TypeRoomController@edit')->name('edit');
        Route::post('/{id}/edit', 'TypeRoomController@actionEdit')->name('edit');
        Route::prefix('/{id}/rooms')->name('rooms.')->group(function () {
            Route::get('/', 'RoomController@getRoomByTypeRoom')->name('getRoomByTypeRoom');
            Route::get('/getListRoom', 'RoomController@getListRoomByTypeRoom')->name('getListRoomByTypeRoom');
            Route::get('/create', 'RoomController@create')->name('create');
            Route::post('/create', 'RoomController@actionCreate')->name('action-create');
            Route::get('{idRoom}/edit', 'RoomController@edit')->name('edit');
            Route::post('{idRoom}/edit', 'RoomController@actionEdit')->name('edit');
            Route::get('{idRoom}/delete', 'RoomController@delete')->name('delete');
        });
    });

    Route::prefix('list-rooms')->name('rooms.')->group(function () {
        Route::get('/', 'RoomController@index')->name('index');
    });

    Route::prefix('library-images')->name('library-images.')->group(function () {
        Route::get('/', 'LibraryImageController@index')->name('index');
        Route::post('/', 'LibraryImageController@actionSaveImage')->name('index');
        Route::post('/{id?}', 'LibraryImageController@actionDeleteImage')->name('delete');
    });

    Route::prefix('diagrams')->name('diagrams.')->group(function () {
        Route::get('/', 'DiagramController@index')->name('index');
    });

    Route::prefix('devices')->name('devices.')->group(function () {
        Route::get('/', 'DeviceController@index')->name('index');
        Route::get('/getList', 'DeviceController@getList')->name('get-list');
        Route::get('/create', 'DeviceController@create')->name('create');
        Route::post('/create', 'DeviceController@actionCreate')->name('create');
        Route::get('/{id}/edit', 'DeviceController@edit')->name('edit');
        Route::post('/{id}/edit', 'DeviceController@actionEdit')->name('edit');
        Route::get('/{id}/delete', 'DeviceController@delete')->name('delete');
        Route::get('/{id}/detail', 'DeviceController@detail')->name('detail');
    });

    Route::prefix('services')->name('services.')->group(function (){
       Route::get('/', 'ServiceController@index')->name('index');
       Route::get('/getList', 'ServiceController@getList')->name('getList');
       Route::get('/create', 'ServiceController@create')->name('create');
       Route::post('/create', 'ServiceController@actionCreate')->name('create');
       Route::get('/{id}/edit', 'ServiceController@edit')->name('edit');
       Route::post('/{id}/edit', 'ServiceController@actionEdit')->name('edit');
       Route::get('/{id}/delete', 'ServiceController@delete')->name('delete');
       Route::get('/{id}/detail', 'ServiceController@detail')->name('detail');
    });

    Route::prefix('promotions')->name('promotions.')->group(function (){
       Route::get('/', 'PromotionController@index')->name('index');
       Route::get('/getList', 'PromotionController@getList')->name('getList');
       Route::get('/create', 'PromotionController@create')->name('create');
       Route::post('/create', 'PromotionController@actionCreate')->name('create');
       Route::get('/{promotion}/edit', 'PromotionController@edit')->name('edit');
       Route::post('/{promotion}/edit', 'PromotionController@actionEdit')->name('edit');
       Route::get('/{promotion}/delete', 'PromotionController@delete')->name('delete');
    });

});
