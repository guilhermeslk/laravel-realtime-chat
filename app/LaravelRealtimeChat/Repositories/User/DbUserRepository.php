<?php namespace LaravelRealtimeChat\Repositories\User;

use LaravelRealtimeChat\Repositories\DbRepository;

class DbUserRepository extends DbRepository implements UserRepository {

    /**
     * @var User
     */
    private $model;

    public function __construct(\User $model)
    {
        $this->model = $model;
    }

    public function getAllExcept($id)
    {
        return $this->model->where('id', '<>', $id)->get();
    }
}
