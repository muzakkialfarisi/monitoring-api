<?php

namespace App\Repositories;

use Carbon\Carbon;

use App\Models\ApiModel;

class ApiRepository
{
    private Int
        $id,
        $main_dealer_id,
        $back_end_id,
        $feature_id;

    private bool
        $is_active,
        $status_code_validation,
        $response_time_validation,
        $response_body_validation;

    private array
        $data = [],
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

    public function set_main_dealer_id(string $main_dealer_id): self
    {
        $this->main_dealer_id = $main_dealer_id;
        return $this;
    }

    public function set_status_code_validation(bool $status_code_validation): self
    {
        $this->status_code_validation = $status_code_validation;
        return $this;
    }

    public function set_response_time_validation(bool $response_time_validation): self
    {
        $this->response_time_validation = $response_time_validation;
        return $this;
    }

    public function set_response_body_validation(bool $response_body_validation): self
    {
        $this->response_body_validation = $response_body_validation;
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
        $api_model = $this->api_model->whereNull("deleted_at");

        if(isset($this->id)){
            $api_model = $api_model->where('id', $this->id);
        }

        if(isset($this->main_dealer_id)){
            $api_model = $api_model->where('main_dealer_id', $this->main_dealer_id);
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

        if(isset($this->is_active)){
            $api_model = $api_model->where('is_active', $this->is_active);
        }

        if(count($this->relationship) > 0){
            $api_model = $api_model->with($this->relationship);
        }

        $api_model = $api_model->first();

        if(!$api_model){
            return false;
        }

        return $api_model;
    }

    public function getList(): Object
    {
        $api_model = $this->api_model->whereNull("deleted_at");

        if(isset($this->id)){
            $api_model = $api_model->where('id', $this->id);
        }

        if(isset($this->main_dealer_id)){
            $api_model = $api_model->where('main_dealer_id', $this->main_dealer_id);
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

        if(isset($this->is_active)){
            $api_model = $api_model->where('is_active', $this->is_active);
        }

        if(count($this->relationship) > 0){
            $api_model = $api_model->with($this->relationship);
        }

        return (object) [
            "total" => $api_model->count(),
            "rows" =>  $api_model->get()
        ];
    }

    public function getListIsError()
    {
        $data = (new ApiModel())->where('is_active', 1)
            ->whereNull('deleted_at')
            ->where('status_code_validation', 0)
            ->orWhere('response_time_validation', 0)
            ->orWhere('response_body_validation', 0)
            ->orderBy('priority')
            ->with(['main_dealer']);

        return (object) [
            "total" => $data->count(),
            "rows" =>  $data->get()
        ];
    }

    public function set_data($param): self
    {
        $data = [
            'back_end_id' => $param['back_end_id'] ?? null,
            'main_dealer_id' => $param['main_dealer_id'] ?? null,
            'feature_id' => $param['feature_id'] ?? null,
            'path' => $param['path'] ?? null,
            'is_active' => $param['is_active'] ?? 0,
            'method' => $param['method'] ?? null,
            'main_dealer_id' => $param['main_dealer_id'] ?? null,
            'headers' => $param['headers'] ?? null,
            'params' => $param['params'] ?? null,
            'body' => $param['body'] ?? null,
            'status_code_validation' => $param['status_code_validation'] ?? 1,
            'response_time_validation' => $param['response_time_validation'] ?? 1,
            'response_body_validation' => $param['response_body_validation'] ?? 1,
            'headers' => $param['headers'] ?? null,
            'body' => $param['body'] ?? null,
            'params' => $param['params'] ?? null,
            'status_code_actual' => $param['status_code_actual'] ?? null,
            'response_time_actual' => $param['response_time_actual'] ?? null,
            'response_body_actual' => $param['response_body_actual'] ?? null,
            'response_time_tolerance' => $param['response_time_tolerance'] ?? null,
            'is_push_email' => $param['is_push_email'] ?? null,
            'is_check_status_code' => $param['is_check_status_code'] ?? null,
            'is_check_response_body' => $param['is_check_response_body'] ?? null,
            'is_check_response_time' => $param['is_check_response_time'] ?? null,
            'priority' => $param['priority'] ?? 0,
            'status_code_id' => 0,
            'response_time_id' => 0,
            'response_body_id'=> 0,
        ];

        $this->data = $data;

        return $this;
    }

    public function create($param)
    {
        $data = (new ApiModel())->create($this->data);    
        
        if(!$data){
            return false;
        }

        return $data;
    }  

    public function update($param)
    {
        $data = (new ApiModel())->whereNull("deleted_at");

        if(isset($this->id)){
            $data = $data->where('id', $this->id);
        }

        if(isset($this->main_dealer_id)){
            $data = $data->where('main_dealer_id', $this->main_dealer_id);
        }

        if(isset($this->back_end_id)){
            $data = $data->where('back_end_id', $this->back_end_id);
        }

        if(isset($this->feature_id)){
            $data = $data->where('feature_id', $this->feature_id);
        }

        if(isset($this->path)){
            $data = $data->where('path', $this->path);
        }

        if(isset($this->is_active)){
            $data = $data->where('is_active', $this->is_active);
        }

        $data = $data->update($this->data);

        if(!$data){
            return false;
        }

        return true;
    }

    public function delete()
    {
        $data = (new ApiModel())->whereNull("deleted_at");

        if(isset($this->id)){
            $data = $data->where('id', $this->id);
        }

        if(isset($this->main_dealer_id)){
            $data = $data->where('main_dealer_id', $this->main_dealer_id);
        }

        if(isset($this->back_end_id)){
            $data = $data->where('back_end_id', $this->back_end_id);
        }

        if(isset($this->feature_id)){
            $data = $data->where('feature_id', $this->feature_id);
        }

        if(isset($this->path)){
            $data = $data->where('path', $this->path);
        }

        if(isset($this->is_active)){
            $data = $data->where('is_active', $this->is_active);
        }

        $data = $data->delete();
        
        if(!$data){
            return false;
        }

        return true;
    }
}