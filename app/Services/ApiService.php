<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Libraries\Factory;

use App\Repositories\ApiRepository;
use App\Repositories\BackEndRepository;
use App\Transformers\Transformer;
use App\Transformers\ApiTransformer;

class ApiService
{
    private Int
        $main_dealer_id = 0;

    private string
        $back_end_name;

    public function set_main_dealer_id(Int $main_dealer_id): self
    {
        $this->main_dealer_id = $main_dealer_id;
        return $this;
    }

    public function set_back_end_name(string $back_end_name): self
    {
        $this->back_end_name = $back_end_name;
        return $this;
    }

    public function getApi()
    {
        $back_end = (new BackEndRepository())
            ->set_main_dealer_id($this->main_dealer_id ?? 0)
            ->set_name($this->back_end_name ?? '')
            ->getFirst();

        if(!$back_end){
            return false;
        }

        $data = (new ApiRepository())
            ->set_back_end_id($back_end->id)
            ->set_relationship([
                'back_end', 'body', 'params', 'authorization'
            ])
            ->getList();
        
        if(!$data){
            return false;
        }

        $data->rows = (new Transformer())->buildCollection($data->rows, new ApiTransformer);

        return $data;
    }
}