<?php namespace LaravelRealtimeChat\Repositories\User;

interface UserRepository {
    
    /**
     * Fetch a record by id
     * 
     * @param $id
     */
    public function getById($id);

    /**
     * Fetch all users except the one specified by the id
     *
     * @param $id;
     */
    public function getAllExcept($id);
}
