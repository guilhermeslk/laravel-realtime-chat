<?php

class MessagesUpdateEventHandler {

	CONST EVENT   = 'messages.update';
	CONST CHANNEL = 'messages.update';

	public function handle($data)
    {
        $redis = Redis::connection();
        $redis->publish(self::CHANNEL, $data);
    }
}