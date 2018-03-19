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

Route::get('/search', 'HomeController@search')->name('home.search');

Route::get('/contact', 'HomeController@contact')->name('home.contact');

Route::get('/post/{slug}', 'HomeController@post')->name('home.post');

Route::get('/category/{slug}', 'HomeController@postsCategory')->name('home.category.post');

Route::get('/user/{slug}', 'HomeController@postsUser')->name('home.user.post');

Route::post('/sendmail', 'HomeController@sendMail')->name('home.sendmail');

Route::group(['middleware'=>'auth'], function(){

    Route::get('/profile', 'ProfileController@index')->name('profile');

    Route::get('/profile/settings', 'ProfileController@edit')->name('profile.settings');

    Route::get('/profile/change_password', 'ProfileController@change_password')->name('profile.change_password');

    Route::patch('/profile/update/{id}', 'ProfileController@update')->name('profile.update');

    Route::patch('/profile/update_password/{id}', 'ProfileController@update_password')->name('profile.update_password');

});

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

    Route::resource('/admin/comments', 'PostCommentsController', ['names'=>[
        'index'=>'admin.comments.index',
        'create'=>'admin.comments.create',
        'store'=>'admin.comments.store',
        'edit'=>'admin.comments.edit',
        'update'=>'admin.comments.update',
        'show'=>'admin.comments.show',
        'destroy'=>'admin.comments.destroy'
    ]]);

    Route::resource('/admin/comment/replies', 'CommentRepliesController', ['names'=>[
        'index'=>'admin.comment.replies.index',
        'create'=>'admin.comment.replies.create',
        'store'=>'admin.comment.replies.store',
        'edit'=>'admin.comment.replies.edit',
        'update'=>'admin.comment.replies.update',
        'show'=>'admin.comment.replies.show',
        'destroy'=>'admin.comment.replies.destroy'
    ]]);

    Route::resource('/admin/photos', 'AdminPhotosController', ['names'=>[
        'index'=>'admin.photos.index',
        'create'=>'admin.photos.create',
        'store'=>'admin.photos.store',
        'edit'=>'admin.photos.edit',
        'update'=>'admin.photos.update',
        'show'=>'admin.photos.show',
        'destroy'=>'admin.photos.destroy'
    ]]);

    Route::delete('/admin/delete/photo', 'AdminPhotosController@deletePhoto')->name('admin.photos.deletePhoto');

    Route::resource('/admin/notifications', 'AdminNotificationsController', ['names'=>[
        'index'=>'admin.notifications.index',
        'create'=>'admin.notifications.create',
        'store'=>'admin.notifications.store',
        'edit'=>'admin.notifications.edit',
        'update'=>'admin.notifications.update',
        'show'=>'admin.notifications.show',
        'destroy'=>'admin.notifications.destroy'
    ]]);

});