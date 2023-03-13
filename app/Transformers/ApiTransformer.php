<?php

namespace App\Transformers;

use League\Fractal;

use App\Models\ApiModel;

class ApiTransformer extends Fractal\TransformerAbstract
{
    public function transform(ApiModel $model)
    {
        $headers = $this->parseHeaders($model->headers ?? []);
        $body = $this->parseBody($model->body ?? []);

        $data = [
            'id' => (int) $model->id,
            'back_end_id' => (int) $model->back_end_id,
            'feature_id' => (int) $model->feature_id,
            'feature_name' => $model->feature->name ?? '',
            'method' => $model->method,
            'base_url' => $model->back_end->base_url ?? null,
            'path' => $model->path,
            'url' => isset($model->back_end->base_url) ? $model->back_end->base_url . $model->path : $model->path,
            'headers' => $headers,
            'body' => $body,
            'params' => null,
        ];

        return $data;
    }

    private function parseHeaders($models)
    {
        if (isset($models->value)) {
            $data = json_decode($models->value, true);
            return $data;
        }
        return [];
    }

    private function parseBody($models)
    {
        if (isset($models->value)) {
            $data = json_decode($models->value, true);
            return $data;
        }
        return [];
    }
}