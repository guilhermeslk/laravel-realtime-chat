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

App::bind('LaravelRealtimeChat\Repositories\Conversation\ConversationRepository', 'LaravelRealtimeChat\Repositories\Conversation\DbConversationRepository');
App::bind('LaravelRealtimeChat\Repositories\User\UserRepository', 'LaravelRealtimeChat\Repositories\User\DbUserRepository');

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
	'as'   => 'auth.logout',
	'uses' => 'AuthController@logout'
));

Route::get('/chat/', array(
	'before' => 'auth',
	'as'     => 'chat.index',
	'uses'   => 'ChatController@index'
));

Route::get('/messages/', array(
	'before' => 'auth',
	'as'     => 'messages.index',
	'uses'   => 'MessageController@index'
));

Route::post('/messages/', array(
	'before' => 'auth',
	'as'     => 'messages.store',
	'uses'   => 'MessageController@store'
));

Route::get('users/{user_id}/conversations', array(
	'before' => 'auth',
	'as'	 => 'conversations_users.index',
	'uses'	 => 'ConversationUserController@index'
));

Route::post('/conversations/', array(
	'before' => 'auth',
	'as' 	 => 'conversations.store',
	'uses'   => 'ConversationController@store'
));

Route::get('/conversations/', array(
	'before' => 'auth',
	'as' 	 => 'conversations.index',
	'uses'   => 'ConversationController@index'
));

