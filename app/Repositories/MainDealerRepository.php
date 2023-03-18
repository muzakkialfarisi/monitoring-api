<?php

namespace App\Repositories;

use Carbon\Carbon;

use App\Models\MainDealerModel;

class MainDealerRepository
{
    private Int
        $id;

    private bool
        $is_active;
    
    private string
        $name;

    private array
        $data = [],
        $relationship = [];

    public function set_id(Int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function set_name(string $set_name): self
    {
        $this->id = $id;
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

    public function getFirst()
    {
        $data = (new MainDealerModel())->whereNull("deleted_at");

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
       
        $data = $data->first();

        if(!$data){
            return false;
        }

        return $data;
    }

    public function getList(): Object
    {
        $data = (new MainDealerModel())->whereNull("deleted_at");

        if(isset($this->id)){
            $data = $data->where('id', $this->id);
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
        $data = (new MainDealerModel())->whereNull("deleted_at");

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
        $data = (new MainDealerModel())->create($this->data);

        if(!$data){
            return false;
        }

        return $data;
    }
}