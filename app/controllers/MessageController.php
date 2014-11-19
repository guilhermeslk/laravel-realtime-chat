<?php

class MessageController extends \BaseController {

	public function getIndex() {

		$conversation = Conversation::where('name', Input::get('conversation'))->first();
		$messages 	  = Message::where('conversation_id', $conversation->id)->orderBy('created_at')->get();

		return View::make('templates/messages')->with('messages', $messages)->render();
	}

	public function postStore() {
		$rules 	   = array('body' => 'required');
		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			return Response::json([
				'success' => false,
				'result' => $validator->messages()
			]);
		}

		$conversation = Conversation::where('name', Input::get('conversation'))->first();

		$params = array(
			'conversation_id' => $conversation->id,
			'body' 			  => Input::get('body'),
			'user_id' 		  => Input::get('user_id'),
			'created_at'	  => new DateTime
		);

   		$message = Message::create($params);

   		foreach($conversation->users as $user) {

   			$params = array(
   				'user_id' => $user->id,
   				'message_id' => $message->id,
   				'read'    => false
   			);

   			MessageNotification::create($params);
   		}

   		$data = array(
			'conversation' => Input::get('conversation'), 
			'user_id' 	   => Input::get('user_id'),
			'result'       => Str::words($message->body, 5)
		);

		Event::fire(MessagesUpdateEventHandler::EVENT, array(json_encode($data)));

   		return Response::json([
   			'success' => true,
   			'result' => $message
   		]);
	}
}