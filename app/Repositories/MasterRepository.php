<?php

namespace App\Repositories;

class MasterRepository
{
    public $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function count_list($params = [], $object = null)
    {
        $total_rows = (isset($object)) ? $object : $this->model;

        if (isset($params['search']) && $params['search'] != '') {
            $total_rows = $total_rows->where(function ($query) use ($params) {
                $i = 0;
                foreach ($params['searchable'] as $column) {
                    if ($i == 0) {
                        $query->whereRaw("LOWER({$column}) like ?", ['%' . strtolower($params['search'] . '%')]);
                    } else {
                        $query->orwhereRaw("LOWER({$column}) like ?", ['%' . strtolower($params['search'] . '%')]);
                    }
                    $i++;
                }
            });
        }

        if (isset($params['conditions'])) {
            foreach ($params['conditions'] as $row => $condition) {
                $operator = (isset($condition['operator'])) ? $condition['operator'] : '=';
                $total_rows = $total_rows->where($condition['field'], $operator, $condition['value']);
            }
        }

        return $total_rows->count();
    }

    public function get_list($params = [], $object = null)
    {
        $data = ($object) ? $object : $this->model;

        if (isset($params['search']) && $params['search'] != '') {
            $data = $data->where(function ($query) use ($params) {
                $i = 0;
                foreach ($params['searchable'] as $column) {
                    if ($i == 0) {
                        $query->whereRaw("LOWER({$column}) like ?", ['%' . strtolower($params['search'] . '%')]);
                    } else {
                        $query->orwhereRaw("LOWER({$column}) like ?", ['%' . strtolower($params['search'] . '%')]);
                    }
                    $i++;
                }
            });
        }

        if (isset($params['conditions'])) {
            foreach ($params['conditions'] as $row => $condition) {
                $operator = (isset($condition['operator'])) ? $condition['operator'] : '=';
                $data = $data->where($condition['field'], $operator, $condition['value']);
            }
        }

        if (isset($params['take'])) {
            $data = $data->take($params['take']);
        }

        if (isset($params['skip'])) {
            $data = $data->skip($params['skip']);
        }

        if (isset($params['relationship'])) {
            $data = $data->with($params['relationship']);
        }

        $order_field = (isset($params['order_field']) && $params['order_field'] != '') ? $params['order_field'] : $this->model->getTable() . '.' . $this->model->getKeyName();
        $order_sort = (isset($params['order_sort']) && $params['order_sort'] != '') ? $params['order_sort'] : 'DESC';

        $data = $data
            ->orderBy($order_field, $order_sort);

        $data = (isset($params['limit'])) ? $data->paginate($params['limit']) : $data->get();

        return $data;
    }

    public function get_first($params = [], $object = null)
    {
        $data = ($object) ? $object : $this->model;

        if (isset($params['search']) && $params['search'] != '') {
            $data = $data->where(function ($query) use ($params) {
                $i = 0;
                foreach ($params['searchable'] as $column) {
                    if ($i == 0) {
                        $query->whereRaw("LOWER({$column}) like ?", ['%' . strtolower($params['search'] . '%')]);
                    } else {
                        $query->orwhereRaw("LOWER({$column}) like ?", ['%' . strtolower($params['search'] . '%')]);
                    }
                    $i++;
                }
            });
        }

        if (isset($params['conditions'])) {
            foreach ($params['conditions'] as $row => $condition) {
                $operator = (isset($condition['operator'])) ? $condition['operator'] : '=';
                $data = $data->where($condition['field'], $operator, $condition['value']);
            }
        }

        if (isset($params['take'])) {
            $data = $data->take($params['take']);
        }

        if (isset($params['skip'])) {
            $data = $data->skip($params['skip']);
        }

        if (isset($params['relationship'])) {
            $data = $data->with($params['relationship']);
        }

        $order_field = (isset($params['order_field']) && $params['order_field'] != '') ? $params['order_field'] : $this->model->getTable() . '.' . $this->model->getKeyName();
        $order_sort = (isset($params['order_sort']) && $params['order_sort'] != '') ? $params['order_sort'] : 'DESC';

        $data = $data
            ->orderBy($order_field, $order_sort);

        $data = (isset($params['limit'])) ? $data->paginate($params['limit']) : $data->first();

        return $data;
    }

    public function save_record($params)
    {
        $data = $this->model->create($params);
        return $data;
    }

    public function update_record_by_id($id, $params)
    {
        return $this->model->where($this->model->getKeyName(), $id)->update($params);
    }

    public function delete_record_by_id($id, $object = null)
    {
        $data = ($object) ? $object : $this->model;

        if (is_array($id)) {
            $data = $data->whereIn($this->model->getTable() . '.' . $this->model->getKeyName(), $id)->get();
            foreach ($data as $model) {
                $model->delete();
            }

            return true;
        }

        return $data->where($this->model->getTable() . '.' . $this->model->getKeyName(), $id)->first()->delete();
    }
}
