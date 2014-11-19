<?php

class ConversationsUsersTableSeeder extends Seeder {

	public function run() {

		DB::table('conversations_users')->delete();

		$user1 = DB::table('users')->where('username', 'heisenberg')->first();
		$user2 = DB::table('users')->where('username', 'pinkman')->first();
		$user3 = DB::table('users')->where('username', 'skyler')->first();
		$user4 = DB::table('users')->where('username', 'hank')->first();

		$conversation1 = DB::table('conversations')->where('author_id', $user1->id)->first();
		$conversation2 = DB::table('conversations')->where('author_id', $user3->id)->first();

		$conversations_users = array(
			array(
				'user_id' 		  => $user1->id,
				'conversation_id' => $conversation1->id
			),
			array(
				'user_id' 		  => $user2->id,
				'conversation_id' => $conversation1->id
			),
			array(
				'user_id' 		  => $user1->id,
				'conversation_id' => $conversation2->id
			),
			array(
				'user_id' 		  => $user3->id,
				'conversation_id' => $conversation2->id
			),
			array(
				'user_id' 		  => $user4->id,
				'conversation_id' => $conversation2->id
			)
		);

		DB::table('conversations_users')->insert($conversations_users);
	}
}