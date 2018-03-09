<?php

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/contact', 'HomeController@contact')->name('home.contact');

Route::post('/sendmail', 'HomeController@sendMail')->name('home.sendmail');

Route::group(['middleware'=>'auth'], function(){

    Route::get('/admin', 'AdminController@index')->name('admin');

    Route::resource('/admin/users', 'AdminUsersController', ['names'=>[
        'index'=>'admin.users.index',
        'create'=>'admin.users.create',
        'store'=>'admin.users.store',
        'edit'=>'admin.users.edit',
        'update'=>'admin.users.update',
        'show'=>'admin.users.show',
        'destroy'=>'admin.users.destroy'
    ]]);

    Route::resource('/admin/categories', 'AdminCategoriesController', ['names'=>[
        'index'=>'admin.categories.index',
        'create'=>'admin.categories.create',
        'store'=>'admin.categories.store',
        'edit'=>'admin.categories.edit',
        'update'=>'admin.categories.update',
        'show'=>'admin.categories.show',
        'destroy'=>'admin.categories.destroy'
    ]]);

    Route::resource('/admin/posts', 'AdminPostsController', ['names'=>[
        'index'=>'admin.posts.index',
        'create'=>'admin.posts.create',
        'store'=>'admin.posts.store',
        'edit'=>'admin.posts.edit',
        'update'=>'admin.posts.update',
        'show'=>'admin.posts.show',
        'destroy'=>'admin.posts.destroy'
    ]]);

});