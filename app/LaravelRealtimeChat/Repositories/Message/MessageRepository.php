<?php namespace LaravelRealtimeChat\Repositories\Message;

interface MessageRepository {

    /**
     * Fetch a message by id
     *
     * @param $id
     */
    public function getById($id);
}
