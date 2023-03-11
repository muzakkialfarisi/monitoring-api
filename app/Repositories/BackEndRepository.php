<?php

namespace App\Repositories;

use Carbon\Carbon;

use App\Models\BackEndModel;

class BackEndRepository
{
    private Int
        $id = 0,
        $main_dealer_id = 0;

    private bool
        $is_active = false;

    private array
        $relationship = [];
    
    private string 
        $name,
        $base_url;

    public function set_id(Int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function set_main_dealer_id(Int $main_dealer_id): self
    {
        $this->main_dealer_id = $main_dealer_id;
        return $this;
    }

    public function set_name(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function set_base_url(string $base_url): self
    {
        $this->base_url = $base_url;
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
        $data = (new BackEndModel())->whereNull("deleted_at");

        if($this->id > 0){
            $data = $data->where('id', $this->id);
        }

        if($this->main_dealer_id > 0){
            $data = $data->where('main_dealer_id', $this->main_dealer_id);
        }

        if(!empty($this->name)){
            $data = $data->where('name', $this->name);
        }

        if(!empty($this->base_url)){
            $$data = $$data->where('base_url', $this->base_url);
        }

        if(count($this->relationship) > 0){
            $data = $$data->with($this->relationship);
        }

        return $data->first();
    }
}