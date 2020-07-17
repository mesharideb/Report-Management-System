<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');



Auth::routes();

Route::middleware('auth')->group(function () {
//    Route::get('/users','UserController@index')->middleware('role:admin');
    Route::middleware('role:admin')->group(function () {


        Route::get('/users', 'UserController@index');
        Route::get('/roleUser/{id}', 'UserController@edit_role');
        Route::post('/updateUserRole/{id}', 'UserController@update_role');
        Route::get('/groupUser/{id}', 'UserController@edit_group');
        Route::post('/updateUserGroup/{id}', 'UserController@update_group');
        Route::get('/deleteUser/{id}', 'UserController@destroy');

        Route::get('roles', 'RoleController@index');
        Route::get('createRole', 'RoleController@create');
        Route::post('storeRole', 'RoleController@store');
        Route::post('updateRole/{id}', 'RoleController@update');
        Route::get('deleteRole/{id}', 'RoleController@destroy');
        Route::get('editRole/{id}', 'RoleController@edit');

        Route::get('permissions', 'PermissionController@index');
        Route::get('createPermission', 'PermissionController@create');
        Route::post('storePermission', 'PermissionController@store');
        Route::post('updatePermission/{id}', 'PermissionController@update');
        Route::get('deletePermission/{id}', 'PermissionController@destroy');
        Route::get('editPermission/{id}', 'PermissionController@edit');

        Route::get('groups', 'GroupController@index');
        Route::get('createGroup', 'GroupController@create');
        Route::post('storeGroup', 'GroupController@store');
        Route::post('updateGroup/{id}', 'GroupController@update');
        Route::get('deleteGroup/{id}', 'GroupController@destroy');
        Route::get('editGroup/{id}', 'GroupController@edit');

        Route::get('tags', 'TagController@index');
        Route::get('createTag', 'TagController@create');
        Route::post('storeTag', 'TagController@store');
        Route::post('updateTag/{id}', 'TagController@update');
        Route::get('deleteTag/{id}', 'TagController@destroy');
        Route::get('editTag/{id}', 'TagController@edit');
    });

    Route::get('reports', 'ReportController@index');
    Route::get('createReport', 'ReportController@create');
    Route::post('storeReport', 'ReportController@store');
    Route::post('updateReport/{id}', 'ReportController@update');
    Route::get('deleteReport/{id}', 'ReportController@destroy');
    Route::get('editReport/{id}', 'ReportController@edit');
    Route::get('showReport/{id}', 'ReportController@show');

    Route::get('search', 'ReportController@search');

});


