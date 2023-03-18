<?php

namespace App\Repositories;

use Carbon\Carbon;

use App\Models\FeatureModel;

class FeatureRepository
{
    private Int
        $id;

    private string
        $name;

    private bool
        $is_active;

    private array
        $relationship = [];

    public function set_id(Int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function set_name(bool $name): self
    {
        $this->name = $name;
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
        $data = (new FeatureModel())->whereNull("deleted_at");

        if(isset($this->id)){
            $data = $data->where('id', $this->id);
        }

        if(isset($this->name)){
            $data = $data->where('name', $this->name);
        }

        if(isset($this->is_active)){
            $data = $data->where('is_active', $this->is_active);
        }

        if(count($this->relationship) > 0){
            $data = $data->with($this->relationship);
        }

        return (object) [
            "total" => $data->count(),
            "rows" =>  $data->get()
        ];
    }

    public function set_data(array $params): self
    {
        $data = [
            'name' => $params['name'] ?? '',
            'is_active' => $params['is_active'] ?? 0
        ];

        $this->data = $data;

        return $this;
    }

    public function update()
    {
        $data = (new FeatureModel())->whereNull("deleted_at");

        if(isset($this->id)){
            $data = $data->where('id', $this->id);
        }

        if(isset($this->name)){
            $data = $data->where('name', $this->name);
        }

        if(isset($this->is_active)){
            $data = $data->where('is_active', $this->is_active);
        }

        $data = $data->update($this->data);

        if(!$data){
            return false;
        }

        return $data;
    }

    public function create()
    {
        $data = (new FeatureModel())->create($this->data);

        if(!$data){
            return false;
        }

        return $data;
    }
}