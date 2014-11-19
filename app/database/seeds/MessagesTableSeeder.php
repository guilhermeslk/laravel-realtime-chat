<?php

class MessagesTableSeeder extends Seeder {

	public function run() {

		DB::table('messages')->delete();

		$user1 = DB::table('users')->where('username', 'heisenberg')->first();
		$user2 = DB::table('users')->where('username', 'pinkman')->first();
		$user3 = DB::table('users')->where('username', 'skyler')->first();
		$user4 = DB::table('users')->where('username', 'hank')->first();

		$conversation1 = DB::table('conversations')->where('author_id', $user1->id)->first();
		$conversation2 = DB::table('conversations')->where('author_id', $user3->id)->first();

		$messages = array(
			array(
				'created_at'	  => new DateTime,
				'body' 			  => 'Jesse!',
				'conversation_id' => $conversation1->id,
				'user_id'		  => $user1->id
			),
			array(
				'created_at'	  => new DateTime,
				'body' 			  => 'Yo, bitch!',
				'conversation_id' => $conversation1->id,
				'user_id'		  => $user2->id
			),
			array(
				'created_at'	  => new DateTime,
				'body' 			  => 'Tell him, Walt!',
				'conversation_id' => $conversation2->id,
				'user_id'		  => $user3->id
			),
			array(
				'created_at'	  => new DateTime,
				'body' 			  => 'Do what you\'re gonna do.',
				'conversation_id' => $conversation2->id,
				'user_id'		  => $user4->id
			),
			array(
				'created_at'	  => new DateTime,
				'body' 			  => 'Fuck you!',
				'conversation_id' => $conversation2->id,
				'user_id'		  => $user1->id
			)
		);

		DB::table('messages')->insert($messages);
	}
}