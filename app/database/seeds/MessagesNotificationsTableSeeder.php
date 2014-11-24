<?php

class MessagesNotificationsTableSeeder extends Seeder {
	
	public function run() {

		DB::table('messages_notifications')->delete();

		$user1 = DB::table('users')->where('username', 'heisenberg')->first();
		$user2 = DB::table('users')->where('username', 'pinkman')->first();
		$user3 = DB::table('users')->where('username', 'skyler')->first();
		$user4 = DB::table('users')->where('username', 'hank')->first();

		$message1 = DB::table('messages')->where('body', 'Jesse!')->first();
		$message2 = DB::table('messages')->where('body', 'Yo, bitch!')->first();
		$message3 = DB::table('messages')->where('body',  'Tell him, Walt!')->first();
		$message4 = DB::table('messages')->where('body',  'Do what you\'re gonna do.')->first();
		$message5 = DB::table('messages')->where('body',  'Fuck you!')->first();

		$messages_notifications = array(
			array(
				'user_id'    	  => $user2->id,
				'message_id' 	  => $message1->id,
				'conversation_id' => $message1->conversation_id,
				'read'		 	  => true,
				'created_at' 	  => new DateTime,
				'updated_at' 	  => new DateTime,
			),
			array(
				'user_id'    	  => $user1->id,
				'message_id'      => $message2->id,
				'conversation_id' => $message2->conversation_id,
				'read'		 	  => true,
				'created_at' 	  => new DateTime,
				'updated_at' 	  => new DateTime,
			),
			array(
				'user_id'         => $user1->id,
				'message_id' 	  => $message3->id,
				'conversation_id' => $message3->conversation_id,
				'read'		 	  => true,
				'created_at' 	  => new DateTime,
				'updated_at' 	  => new DateTime,
			),
			array(
				'user_id'    	  => $user4->id,
				'message_id' 	  => $message3->id,
				'conversation_id' => $message3->conversation_id,
				'read'		      => true,
				'created_at'      => new DateTime,
				'updated_at'      => new DateTime,
			),
			array(
				'user_id'    	  => $user1->id,
				'message_id'	  => $message4->id,
				'conversation_id' => $message4->conversation_id,
				'read'		 	  => true,
				'created_at' 	  => new DateTime,
				'updated_at' 	  => new DateTime,
			),
			array(
				'user_id'    	  => $user3->id,
				'message_id' 	  => $message4->id,
				'conversation_id' => $message4->conversation_id,
				'read'		 	  => true,
				'created_at' 	  => new DateTime,
				'updated_at' 	  => new DateTime,
			),
			array(
				'user_id'    	  => $user4->id,
				'message_id' 	  => $message5->id,
				'conversation_id' => $message5->conversation_id,
				'read'		 	  => true,
				'created_at' 	  => new DateTime,
				'updated_at' 	  => new DateTime,
			),
			array(
				'user_id'    	  => $user3->id,
				'message_id' 	  => $message5->id,
				'conversation_id' => $message5->conversation_id,
				'read'		 	  => true,
				'created_at' 	  => new DateTime,
				'updated_at' 	  => new DateTime,
			)
		);

		DB::table('messages_notifications')->insert($messages_notifications);
	}
}