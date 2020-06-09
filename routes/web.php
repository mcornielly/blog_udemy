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

// Route::get('email', function(){
//     return new App\Mail\LoginCredentials(App\User::first(), 'asdd12121');
// });


// Route::get('/', 'PagesController@home')->name('pages.home');
// Route::get('about', 'PagesController@about')->name('pages.about');
// Route::get('archive', 'PagesController@archive')->name('pages.archive');
// Route::get('contac', 'PagesController@contact')->name('pages.contact');
// Route::get('blog/{post}', 'PostsController@show')->name('posts.show');
// Route::get('categorias/{category}', 'CategoriesController@show')->name('categories.show');
// Route::get('etiquetas/{tag}', 'TagsController@show')->name('tags.show');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function(){
    Route::get('/', 'AdminController@index')->name('admin');

    Route::resource('posts', 'PostsController', ['except' => 'show', 'as' => 'admin']);
    Route::resource('users', 'UsersController', ['as' => 'admin']);
    Route::resource('roles', 'RolesController', ['except' => 'show', 'as' => 'admin']);
    Route::resource('permissions', 'PermissionsController', ['only' => ['index','edit','update'], 'as' => 'admin']);

Route::group(['middleware' => ['role:Admin']], function () {
    Route::put('users/{user}/roles', 'UsersRolesController@update')->name('admin.users.roles.update');
});

Route::group(['middleware' => ['role:Admin']], function () {
    Route::put('users/{user}/permissions', 'UsersPermissionsController@update')->name('admin.users.permissions.update');
});    

    // Route::get('posts', 'PostsController@index')->name('admin.posts.index');
    // Route::get('posts/create', 'PostsController@create')->name('admin.posts.create');
    // Route::post('posts', 'PostsController@store')->name('admin.posts.store');
    // Route::get('posts/{post}', 'PostsController@edit')->name('admin.posts.edit');
    // Route::put('posts/{post}', 'PostsController@update')->name('admin.posts.update');
    // Route::delete('posts/{post}', 'PostsController@destroy')->name('admin.posts.destroy');

    Route::post('posts/{post}/photos', 'PhotosController@store')->name('admin.posts.photos.store');
    Route::delete('photos/{photo}', 'PhotosController@destroy')->name('admin.photos.destroy');
});

// Route::auth();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('pasword/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('pasword/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('pasword/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('pasword/reset', 'Auth\ResetPasswordController@reset');


// SPA
Route::get('/{any?}', 'PagesController@spa')->name('pages.spa')->where('any', '.*');