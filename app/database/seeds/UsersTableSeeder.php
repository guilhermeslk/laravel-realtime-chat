<?php

class UsersTableSeeder extends Seeder {

	public function run() {
		DB::table('users')->delete();

		$users = array(
			array(
				'email' 	  => 'heisenberg@gmail.com',
				'username'	  => 'heisenberg',
				'password' 	  => Hash::make('heisenberg'),
				'image_path' => '/img/heisenberg.jpg',
				'created_at' => new DateTime,
				'updated_at'  => new DateTime
			),
			array(
				'email' 	  => 'pinkman@gmail.com',
				'username'	  => 'pinkman',
				'password' 	  => Hash::make('pinkman'),
				'image_path' => '/img/pinkman.jpg',
				'created_at' => new DateTime,
				'updated_at'  => new DateTime
			),
			array(
				'email' 	  => 'skyler@gmail.com',
				'username'	  => 'skyler',
				'password' 	  => Hash::make('skyler'),
				'image_path' => '/img/skyler.jpg',
				'created_at' => new DateTime,
				'updated_at'  => new DateTime
			),
			array(
				'email' 	  => 'hank@gmail.com',
				'username'	  => 'hank',
				'password' 	  => Hash::make('hankdea'),
				'image_path' => '/img/hank.jpg',
				'created_at' => new DateTime,
				'updated_at'  => new DateTime
			),
			array(
				'email' 	  => 'gusfring@gmail.com',
				'username'	  => 'gusfring',
				'password' 	  => Hash::make('gusfring'),
				'image_path' => '/img/gusfring.jpg',
				'created_at' => new DateTime,
				'updated_at'  => new DateTime
			)
		);

		DB::table('users')->insert($users);
	}
}