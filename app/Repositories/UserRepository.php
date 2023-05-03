<?php

namespace App\Repositories;


use App\Models\User as UserModel;
use App\Repositories\MasterRepository;
use App\Repositories\AuthRepository;

class UserRepository extends MasterRepository
{
    public $model;

    public function __construct()
    {
        $this->model = new UserModel();
        parent::__construct($this->model);
    }

    public function save_record($params)
    {
        $salt = (new AuthRepository())->salt();

        $data = [
            'name'      => $params['name'],
            'username'  => $params['username'],
            'email'     => $params['email'],
            'password'  => (new AuthRepository())->hash($params['username'] . $salt),
            'salt'      => $salt,
            'is_active' => 1,
        ];

        return parent::save_record($data);
    }
}
