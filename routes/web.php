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

/**
 * Home
 */

Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home'
]);

/**
 * Authentication
 */

Route::get('signup', [
    'uses' => 'AuthController@getSignup',
    'as' => 'auth.signup',
    'middleware' => ['guest']
]);

Route::post('signup', [
    'uses' => 'AuthController@postSignup',
    'middleware' => ['guest']
]);

Route::get('signin', [
    'uses' => 'AuthController@getSignin',
    'as' => 'auth.signin',
    'middleware' => ['guest']
]);

Route::post('signin', [
    'uses' => 'AuthController@postSignin',
    'middleware' => ['guest']
]);

Route::get('signout', [
    'uses' => 'AuthController@getSignout',
    'as' => 'auth.signout',
    'middleware' => ['auth']

]);

/**
 * Search
 */

Route::get('search', [
    'uses' => 'SearchController@getResults',
    'as' => 'search.results',
    'middleware' => ['auth']
]);

/**
 * User Profile
 */

Route::get('user/{username}', [
    'uses' => 'ProfileController@getProfile',
    'as' => 'profile.index',
    'middleware' => ['auth']
]);

Route::get('profile/edit', [
    'uses' => 'ProfileController@getEdit',
    'as' => 'profile.edit',
    'middleware' => ['auth']
]);

Route::post('profile/edit', [
    'uses' => 'ProfileController@postEdit',
    'middleware' => ['auth']
]);

/**
 * User Friends
 */

Route::get('friends', [
    'uses' => 'FollowController@index',
    'as' => 'friends.view',
    'middleware' => ['auth']
]);

Route::get('friends/follow/{username}', [
    'uses' => 'FollowController@getFollow',
    'as' => 'friends.follow',
    'middleware' => ['auth']
]);

Route::post('friends/unfollow/{username}', [
    'uses' => 'FollowController@postUnfollow',
    'as' => 'friends.unfollow',
    'middleware' => ['auth']
]);

/**
 * Statuses
 */

Route::post('status', [
    'uses' => 'StatusController@postStatus',
    'as' => 'status.post',
    'middleware' => ['auth']
]);

Route::post('status/{statusId}/reply', [
    'uses' => 'StatusController@postReply',
    'as' => 'status.reply',
    'middleware' => ['auth']
]);

Route::get('status/{statusId}/like', [
    'uses' => 'StatusController@getLike',
    'as' => 'status.like',
    'middleware' => ['auth']
]);

Route::get('status/{statusId}/unlike', [
    'uses' => 'StatusController@getUnlike',
    'as' => 'status.unlike',
    'middleware' => ['auth']
]);


/**
 * events
 */

Route::get('event/add', [
    'uses' => 'EventController@add',
    'as' => 'event.add',
    'middleware' => ['auth']
]);

Route::post('event/add', [
    'uses' => 'EventController@postEvent',
    'middleware' => ['auth']
]);

Route::get('events', [
    'uses' => 'EventController@index',
    'as' => 'event.index',
    'middleware' => ['auth']
]);

/**
 * Stock
 */

Route::get('items', [
    'uses' => 'ItemController@index',
    'as' => 'item.index',
    'middleware' => ['auth']
]);

Route::get('item/{itemId}/view', [
    'uses' => 'ItemController@view',
    'as' => 'item.view',
    'middleware' => ['auth']
]);

Route::get('item/add', [
    'uses' => 'ItemController@addItem',
    'as' => 'item.add',
    'middleware' => ['auth']
]);

Route::post('item/add', [
    'uses' => 'ItemController@postItem',
    'middleware' => ['auth']
]);

Route::get('itemview/{item}', [
    'uses' => 'ItemController@view',
    'as' => 'item.view',
    'middleware' => ['auth']
]);

Route::get('itemask/{item}', [
    'uses' => 'ItemController@ask',
    'as' => 'item.ask',
    'middleware' => ['auth']
]);

/**
 * Fund
 */

Route::get('fund/add', [
    'uses' => 'FundController@addFund',
    'as' => 'fund.add',
    'middleware' => ['auth']
]);

Route::post('fund/add', [
    'uses' => 'FundController@postFund',
    'as' => 'fund.add',
    'middleware' => ['auth']
]);

Route::get('funds', [
    'uses' => 'FundController@index',
    'as' => 'fund.index',
    'middleware' => ['auth']
]);

Route::get('fundview/{fund}', [
    'uses' => 'FundController@view',
    'as' => 'fund.view',
    'middleware' => ['auth']
]);

Route::get('support/{fund}', [
    'uses' => 'FundController@support',
    'as' => 'fund.support',
    'middleware' => ['auth']
]);

/**
 * Messages
 */

Route::get('messages', [
    'uses' => 'MessageController@index',
    'as' => 'message.index',
    'middleware' => ['auth']
]);

Route::post('message/{friend_id}/post', [
    'uses' => 'MessageController@postMessage',
    'as' => 'message.send',
    'middleware' => ['auth']
]);


Route::get('message/{friend_id}/view', [
    'uses' => 'MessageController@view',
    'as' => 'message.view',
    'middleware' => ['auth']
]);


/**
 * Admin authentication
 */

Route::get('admin', [
    'uses' => 'AdminController@getSignin',
    'as' => 'admin.signin',
    'middleware' => ['guest']
]);

Route::post('admin', [
    'uses' => 'AdminController@postSignin',
    'middleware' => ['guest']
]);

Route::get('signout', [
    'uses' => 'AdminController@getSignout',
    'as' => 'auth.signout',
    'middleware' => ['auth']

]);

Route::get('addadmin', [
    'uses' => 'AdminController@getSignup',
    'as' => 'admin.add',
    'middleware' => ['auth']
]);

Route::post('addadmin', [
    'uses' => 'AdminController@postSignup',
    'middleware' => ['auth']
]);


/**
 * Charity
 */

Route::get('addcharity', [
    'uses' => 'CharityController@getSignup',
    'as' => 'charity.add',
    'middleware' => ['auth']
]);

Route::post('addcharity', [
    'uses' => 'CharityController@postSignup',
    'middleware' => ['auth']
]);

Route::get('charity', [
    'uses' => 'CharityController@index',
    'as' => 'charity.view',
    'middleware' => ['auth']
]);
Auth::routes();

Route::get('/home', 'HomeController@index');


/**
 * Notification
 */

Route::get('notifications', [
    'uses' => 'NotificationController@index',
    'as' => 'notifications.view',
    'middleware' => ['auth']
]);

Route::get('test', [
    'uses' => 'EventController@event',
    'as' => 'test'
]);

Route::get('auth/{driver}', ['as' => 'socialAuth', 'uses' => 'Auth\RegisterController@redirectToProvider']);
Route::get('auth/{driver}/callback', ['as' => 'socialAuthCallback', 'uses' => 'Auth\RegisterController@handleProviderCallback']);
