<?php namespace LaravelRealtimeChat\Repositories\Message;

use LaravelRealtimeChat\Repositories\DbRepository;

class DBMessageRepository extends DbRepository implements MessageRepository {

    /**
     * @var Message
     */
    private $model;

    public function __construct(Message $model) 
    {
        $this->model = $model;
    }
}
