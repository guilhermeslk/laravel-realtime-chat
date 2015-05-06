<?php

use Illuminate\Support\Facades\Redis;

class ChatConversationsEventHandler {

	CONST EVENT   = 'chat.conversations';
	CONST CHANNEL = 'chat.conversations';

	public function handle($data)
    {
        $redis = Redis::connection();
        $redis->publish(self::CHANNEL, $data);
    }
}