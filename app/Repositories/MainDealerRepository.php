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

    private array
        $relationship = [];

    public function set_id(Int $id): self
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

    public function getFirst(): Object
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
       
        $data = $data->first();

        return (object) $data;
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
}