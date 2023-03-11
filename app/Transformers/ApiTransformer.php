<?php

namespace App\Transformers;

use League\Fractal;

use App\Models\ApiModel;

class ApiTransformer extends Fractal\TransformerAbstract
{
    public function transform(ApiModel $model)
    {
        $headers = $this->parse($model->headers ?? []);
        $body = $this->parseBody($model->body ?? []);
        $params = $this->parse($model->params ?? []);

        $data = [
            'id' => (int) $model->id,
            'back_end_id' => (int) $model->back_end_id,
            'feature_id' => (int) $model->feature_id,
            'base_url' => $model->back_end->base_url ?? null,
            'path' => $model->path,
            'url' => isset($model->back_end->base_url) ? $model->back_end->base_url . $model->path : $model->path,
            'headers' => $headers,
            'body' => $body,
            'params' => $params,
        ];
        
        return $data;
    }

    private function parse($models)
    {
        if (count($models) > 0) {
            $data = [];
            foreach ($models as $item) {
                $data[$item->name] = $item->value;
            }
            return $data;
        }
        return [];
    }

    private function parseBody($models)
    {
        if (count($models) > 0) {
            $data = [];
            foreach ($models as $item) {
                $data[$item->name] = json_decode($item->value);
            }
            return $data;
        }
        return [];
    }
}
