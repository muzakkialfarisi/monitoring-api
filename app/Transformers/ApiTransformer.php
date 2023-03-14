<?php

namespace App\Transformers;

use League\Fractal;

use App\Models\ApiModel;

class ApiTransformer extends Fractal\TransformerAbstract
{
    public function transform(ApiModel $model)
    {
        $data = [
            'id' => (int) $model->id,
            'back_end_id' => (int) $model->back_end_id,
            'feature_id' => (int) $model->feature_id,
            'feature_name' => $model->feature->name ?? '',
            'method' => $model->method,
            'base_url' => $model->back_end->base_url ?? null,
            'path' => $model->path,
            'url' => isset($model->back_end->base_url) ? $model->back_end->base_url . $model->path : $model->path,
            'headers' => json_decode($model->headers, true) ?? [],
            'body' => json_decode($model->body, true) ?? [],
            'params' => null,
        ];

        return $data;
    }
}