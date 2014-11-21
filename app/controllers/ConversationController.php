<?php

class ConversationController extends \BaseController {

	public function postStore() {

		$rules = array( 
			'users' => 'required|array',
			'body'  =>  'required'
		);

		$validator = Validator::make(Input::only('users', 'body'), $rules);

		if($validator->fails()) {
			return Response::json([
				'success' => false,
				'result' => $validator->messages()
			]);
		}

		// Create Conversation
		$params = array(
			'created_at' => new DateTime,
			'name' 		 => str_random(30),
			'author_id'  => Auth::user()->id
		);

		$conversation = Conversation::create($params);

		$conversation->users()->attach(Input::get('users'));
		$conversation->users()->attach(array(Auth::user()->id));

		// Create Message
		$params = array(
			'conversation_id' => $conversation->id,
			'body' 			  => Input::get('body'),
			'user_id' 		  => Auth::user()->id,
			'created_at'	  => new DateTime
		);

		$message = Message::create($params);
		
		// Create Message Notifications
		$messages_notifications = array();

		foreach(Input::get('users') as $user_id) {
			array_push($messages_notifications, new MessageNotification(array('user_id' => $user_id, 'read' => false))); 
		}

		$message->messages_notifications()->saveMany($messages_notifications);

		return Response::json([
			'success' => true,
			'result' => $conversation
		]);
	}
}