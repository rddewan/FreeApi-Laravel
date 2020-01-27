<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/validate_token', function () {
    return ['message' => 'true'];
})->middleware('auth:api');


Route::post('register','Api\Auth\AuthController@register');
Route::post('login','Api\Auth\AuthController@login');
Route::get('data/{id}','Api\Profile\UserProfileController@index');

Route::group(['prefix' => 'post'],function (){
    Route::group(['middleware' => 'auth:api'],function (){
        Route::post('add_post_blog','Api\Blog\BlogController@store');
        Route::post('update_post_blog','Api\Blog\BlogController@update');
        Route::post('post_image','Api\Blog\BlogController@storeImage');
        Route::get('all_post_detail','Api\Blog\BlogController@index');
        Route::delete('delete/{id}','Api\Blog\BlogController@destroy');
    });

});

Route::group(['prefix' => 'user'],function (){
    Route::group(['middleware'=> 'auth:api'],function (){
        Route::get('detail/{id}','Api\Auth\AuthController@userDetail');
        Route::post('user_profile','Api\Profile\UserProfileController@store');
        Route::post('update/user_password','Api\Profile\UserProfileController@updateUserPassword');
        Route::post('update/user_profile_image','Api\Profile\UserProfileController@updateProfileImage');
        Route::post('delete','Api\Profile\UserProfileController@destroy');

    });
});


