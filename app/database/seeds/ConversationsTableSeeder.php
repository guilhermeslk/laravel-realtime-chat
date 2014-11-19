<?php 

class ConversationsTableSeeder extends Seeder {
	
	public function run() {

		DB::table('conversations')->delete();

		$user1 = DB::table('users')->where('username', 'heisenberg')->first();
		$user2 = DB::table('users')->where('username', 'skyler')->first();

		$conversations = array(
			array(
				'created_at' => new DateTime,
				'name' 		 => str_random(30),
				'author_id'  => $user1->id
			),
			array(
				'created_at' => new DateTime,
				'name' 		 => str_random(30),
				'author_id'  => $user2->id
			)
		);

		DB::table('conversations')->insert($conversations);
	}
}