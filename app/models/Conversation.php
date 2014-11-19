<?php

class Conversation extends Eloquent {

	protected $table = 'conversations';

	public function users() {
		return $this->belongsToMany('User', 'conversations_users', 'conversation_id', 'user_id')->where('user_id', '<>', Auth::user()->id);
	}

	public function messages() {
		return $this->hasMany('Message', 'conversation_id', 'id');
	}

	public function getUnreadMessagesCounterAttribute() {
		
		$messages_ids = DB::table('messages')->where('conversation_id', $this->attributes['id'])
		->lists('id');

		$counter = DB::table('messages_notifications')
		->whereIn('message_id', $messages_ids)
		->where('read', false)
		->where('user_id', Auth::user()->id)->count();
		
		return $counter;
	}
}