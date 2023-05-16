<?php

namespace App\Repositories;

use Carbon\Carbon;

use App\Models\FeatureModel;

class FeatureRepository  extends MasterRepository
{
    public $model;

    public function __construct()
    {
        $this->model = new FeatureModel();
        parent::__construct($this->model);
    }

    public function update_record_by_id($id, $params)
    {
        $data = [
            'name' => $params['name'] ?? '',
            'is_active' => $params['is_active'] ?? 0
        ];
        return parent::update_record_by_id($id, $data);
    }

    public function save_record($params)
    {
        $data = [
            'name' => $params['name'] ?? '',
            'is_active' => $params['is_active'] ?? 0
        ];
        return parent::save_record($data);
    }
}
