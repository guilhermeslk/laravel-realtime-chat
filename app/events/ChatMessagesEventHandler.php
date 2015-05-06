<?php

use Illuminate\Support\Facades\Redis;

class ChatMessagesEventHandler {

	CONST EVENT   = 'chat.messages';
	CONST CHANNEL = 'chat.messages';

	public function handle($data)
    {
        $redis = Redis::connection();
        $redis->publish(self::CHANNEL, $data);
    }
}