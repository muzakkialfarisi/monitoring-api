<?php

namespace App\Repositories;

use Carbon\Carbon;

use App\Models\ApiModel;

class ApiRepository
{
    private Int
        $id,
        $back_end_id,
        $feature_id;

    private bool
        $is_active;

    private array
        $relationship = [];
    
    private string 
        $path;

    public function __construct()
    {
        $this->api_model = new ApiModel();
    }

    public function set_id(Int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function set_back_end_id(Int $back_end_id): self
    {
        $this->back_end_id = $back_end_id;
        return $this;
    }

    public function set_feature_id(Int $feature_id): self
    {
        $this->feature_id = $feature_id;
        return $this;
    }

    public function set_path(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    public function set_is_active(bool $is_active): self
    {
        $this->is_active = $is_active;
        return $this;
    }

    public function set_relationship(array $relationship): self
    {
        $this->relationship = $relationship;
        return $this;
    }

    public function getList(): Object
    {
        $api_model = $this->api_model->whereNull("deleted_at");

        if(isset($this->id)){
            $api_model = $api_model->where('id', $this->id);
        }

        if(isset($this->back_end_id)){
            $api_model = $api_model->where('back_end_id', $this->back_end_id);
        }

        if(isset($this->feature_id)){
            $api_model = $api_model->where('feature_id', $this->feature_id);
        }

        if(isset($this->path)){
            $api_model = $api_model->where('path', $this->path);
        }

        if(count($this->relationship) > 0){
            $api_model = $api_model->with($this->relationship);
        }

        return (object) [
            "total" => $api_model->count(),
            "rows" =>  $api_model->get()
        ];
    }
}