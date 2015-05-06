<?php namespace LaravelRealtimeChat\Repositories\Conversation;

interface ConversationRepository {

    /**
     * Fetch a record by id
     * 
     * @param $id
     */
    public function getById($id);

    /**
     * Fetch a record by its name
     *
     * @param $name
     */
    public function getByName($name);
}
