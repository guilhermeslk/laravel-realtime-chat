# Laravel Realtime Chat
[![Build Status](https://travis-ci.org/guilhermeslk/laravel-realtime-chat.svg?branch=master)](https://travis-ci.org/guilhermeslk/laravel-realtime-chat)
[![Code Climate](https://codeclimate.com/github/guilhermeslk/laravel-realtime-chat/badges/gpa.svg)](https://codeclimate.com/github/guilhermeslk/laravel-realtime-chat)

A realtime chat sample written in Laravel 4.2 + Redis + Node.js + Socket.io.

Um exemplo de chat realtime escrito em Laravel 4.2 + Redis Node.js + Socket.io (instruções somente em inglês).

Live example available at: http://chat.guilhermeslk.com.br :)

##Requirements
	Laravel 4.2
	MySQL
	Redis
	Node.js
	NPM

##How to install
### Step 1: Clone this repo

```bash
$ git clone https://github.com/guilhermeslk/laravel-realtime-chat.git
```
### Step 2: Install composer packages

```bash
$ cd laravel-realtime-chat
$ composer install
```
### Step 3: Configure Database
Edit your ***database.php*** to match your local database settings.

```php
    ...
	'connections' => array(

		'mysql' => array(
			'driver'    => 'mysql',
			'host'      => '<HOST>',
			'database'  => '<DATABASE>',
			'username'  => '<USERNAME>',
			'password'  => '<PASSWORD>',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),
    ...
```
### Step 4: Migrate & Populate Database
Run these commands to create and populate your database:

```bash
$ php artisan migrate
$ php artisan db:seed
```

### Step 5: Install NPM dependencies
CD into the nodejs folder and run npm install in order to have the all dependencies installed.

```bash
$ cd nodejs
$ npm install
```

### Step 6: Run PHP's built-in development server

```bash
$ cd ..
$ php artisan serve
```
### Step 7: Start Redis Server

```bash
$ redis-server
```

### Step 8: Start the "Realtime" server (nodejs/server.js)

```bash
$ ./realtime.sh
```

That's it! Now you should be ready to go!
