<?php

namespace App\Repositories;

use Carbon\Carbon;

use App\Models\LogModel;

class LogRepository
{
    private Int
        $id,
        $main_dealer_id,
        $feature_id,
        $api_id,
        $status_code_factual,
        $status_code_actual;

    private string
        $main_dealer_name,
        $feature_name,
        $url,
        $request_header,
        $request_payload,
        $response_body_factual,
        $response_body_actual;

    private float
        $response_time,
        $response_time_accumulation;

    private bool
        $status_code_validation,
        $response_body_validation,
        $response_time_validation;

    private array
        $relationship = [];

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

    public function set_feature_id(Int $feature_id): self
    {
        $this->feature_id = $feature_id;
        return $this;
    }

    public function set_feature_name(string $feature_name): self
    {
        $this->feature_name = $feature_name;
        return $this;
    }

    public function set_api_id(Int $api_id): self
    {
        $this->api_id = $api_id;
        return $this;
    }

    public function set_url(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function set_request_header(string $request_header): self
    {
        $this->request_header = $request_header;
        return $this;
    }

    public function set_request_payload(string $request_payload): self
    {
        $this->request_payload = $request_payload;
        return $this;
    }

    public function set_status_code_factual(Int $status_code_factual): self
    {
        $this->status_code_factual = $status_code_factual;
        return $this;
    }

    public function set_status_code_actual(Int $status_code_actual): self
    {
        $this->status_code_actual = $status_code_actual;
        return $this;
    }

    public function set_status_code_validation(bool $status_code_validation): self
    {
        $this->status_code_validation = $status_code_validation;
        return $this;
    }

    public function set_response_body_factual(string $response_body_factual): self
    {
        $this->response_body_factual = $response_body_factual;
        return $this;
    }

    public function set_response_body_actual(string $response_body_actual): self
    {
        $this->response_body_actual = $response_body_actual;
        return $this;
    }

    public function set_response_body_validation(bool $response_body_validation): self
    {
        $this->response_body_validation = $response_body_validation;
        return $this;
    }

    public function set_response_time(float $response_time): self
    {
        $this->response_time = $response_time;
        return $this;
    }

    public function set_response_time_accumulation(float $response_time_accumulation): self
    {
        $this->response_time_accumulation = $response_time_accumulation;
        return $this;
    }

    public function set_response_time_validation(Int $response_time_validation): self
    {
        $this->response_time_validation = $response_time_validation;
        return $this;
    }

    public function set_relationship(array $relationship): self
    {
        $this->relationship = $relationship;
        return $this;
    }

    public function save()
    {
        $data = (new LogModel())->create([
            'id' => $this->id ?? null,
            'main_dealer_id' => $this->main_dealer_id ?? null,
            'main_dealer_name' => $this->main_dealer_name ?? null,
            'feature_id' => $this->feature_id ?? null,
            'feature_name' => $this->feature_name ?? null,
            'api_id' => $this->api_id ?? null,
            'url' => $this->url ?? null,
            'request_header' => $this->request_header ?? null,
            'request_payload' => $this->request_payload ?? null,
            'status_code_factual' => $this->status_code_factual ?? null,
            'status_code_actual' => $this->status_code_actual ?? null,
            'status_code_validation' => $this->status_code_validation ?? null,
            'response_body_factual' => $this->response_body_factual ?? null,
            'response_body_actual' => $this->response_body_actual ?? null,
            'response_body_validation' => $this->response_body_validation ?? null,
            'response_time' => $this->response_time ?? null,
            'response_time_accumulation' => $this->response_time_accumulation ?? null,
            'response_time_validation' => $this->response_time_validation ?? null,
        ]);

        if(!$data){
            return false;
        }

        return $data;
    }

    public function getList(): Object
    {
        $data = (new LogModel())->whereNull("deleted_at");

        if(isset($this->main_dealer_id)){
            $data = $data->where('main_dealer_id', $this->main_dealer_id);
        }

        return (object) [
            "total" => $data->count(),
            "rows" =>  $data->get()
        ];
    }

    public function get_response_time_accumulation()
    {
        return round((new LogModel())->whereNull('deleted_at')
            ->where('main_dealer_id', $this->main_dealer_id ?? 0)
            ->where('api_id', $this->api_id ?? 0)
            ->whereDate('created_at', '>=', Carbon::now()->subDays(7))
            ->where('response_time_validation', true)
            ->avg('response_time'), 2);
    }
}