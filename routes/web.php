<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'IndexController@index')->name('client.index');
Route::get('gioi-thieu', 'IndexController@gioiThieu')->name('gioi-thieu');
Route::get('lien-he', 'IndexController@lienHe')->name('lien-he');
Route::post('lien-he', 'IndexController@guiMail')->name('lien-he');
Route::get('uu-dai', 'IndexController@uuDai')->name('uu-dai');


Route::group(['prefix' => 'dich-vu'], function () {
    Route::get('/', 'IndexController@dichVu')->name('dich-vu');
    Route::get('{name}', 'IndexController@chiTietDichVu')->name('chi-tiet-dich-vu');
});

Route::group(['prefix' => 'loai-phong'], function () {
    Route::get('/', 'IndexController@loaiPhongs')->name('loai-phong');
    Route::get('{name}', 'IndexController@chiTietLoaiPhong')->name('chi-tiet-loai-phong');
});

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
            Route::get('/create', 'RoomController@createRoom')->name('create');
            Route::post('/create', 'RoomController@actionCreateRoom')->name('action-create');
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

});
