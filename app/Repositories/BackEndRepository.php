<?php

namespace App\Repositories;

use Carbon\Carbon;

use App\Models\BackEndModel;

class BackEndRepository extends MasterRepository
{
    public $model;

    public function __construct()
    {
        $this->model = new BackEndModel();
        parent::__construct($this->model);
    }

    public function update_record_by_id($id, $params)
    {
        $data = [
            'name' => $params['name'] ?? '',
            'base_url' => $params['base_url'] ?? '',
            'is_active' => $params['is_active'] ?? 0
        ];
        return parent::update_record_by_id($id, $data);
    }

    public function save_record($params)
    {
        $data = [
            'main_dealer_id' => $params['main_dealer_id'] ?? 0,
            'name' => $params['name'] ?? '',
            'base_url' => $params['base_url'] ?? '',
            'is_active' => $params['is_active'] ?? 0
        ];
        return parent::save_record($data);
    }
}