<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function() {
	return Redirect::route('auth.postLogin');
});

Route::get('/login', array(
	'as'   => 'auth.getLogin',
	'uses' => 'AuthController@getLogin'
));

Route::post('/login', array(
	'as'   => 'auth.postLogin',
	'uses' => 'AuthController@postLogin'
));

Route::get('/logout', array(
	'as'   => 'auth.getLogout',
	'uses' => 'AuthController@getLogout'
));

Route::get('/chat', array(
	'before' => 'auth',
	'as'     => 'chat.index',
	'uses'   => 'ChatController@getIndex'
));

Route::get('/messages/', array(
	'before' => 'auth',
	'as'     => 'messages.index',
	'uses'   => 'MessageController@getIndex'
));

Route::post('/messages/', array(
	'before' => 'auth',
	'as'     => 'messages.store',
	'uses'   => 'MessageController@postStore'
));

Route::get('users/{user_id}/conversations', array(
	'before' => 'auth',
	'as'	 => 'conversations_users.index',
	'uses'	 => 'ConversationUserController@getIndex'
));

Route::post('/conversations/', array(
	'before' => 'auth',
	'as' 	 => 'conversations.postStore',
	'uses'   => 'ConversationController@postStore'
));