<?php

class ChatController extends \BaseController {
	
	public function getIndex() {

		if(Input::has('conversation')) {
			$current_conversation = Conversation::where('name',  Input::get('conversation'))->first();
		} else {
			$current_conversation = Auth::user()->conversations()->first();
		}

		Session::set('current_conversation', $current_conversation->name);
		
		$conversations = Auth::user()->conversations()->get();

		return View::make('templates/chat')->with(array(
			'conversations' 	   => $conversations, 
			'current_conversation' => $current_conversation
		));
	}
}
