<?php

namespace App\Repositories;

use Carbon\Carbon;

use App\Models\User as UserModel;
use App\Repositories\MasterRepository;

class UserRepository extends MasterRepository
{
    public $model;

    public function __construct()
    {
        $this->model = new UserModel();
        parent::__construct($this->model);
    }
}