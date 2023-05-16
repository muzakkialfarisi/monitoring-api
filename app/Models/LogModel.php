<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\MainDealerModel;

class LogModel extends Model
{
    use SoftDeletes;

    protected $table = 'log';
    protected $dateFormat = "Y-m-d H:i:s";
    protected $fillable = [
        'main_dealer_id',
        'main_dealer_name',
        'feature_id',
        'feature_name',
        'api_id',
        'url',
        'request_header',
        'request_payload',
        'status_code_factual',
        'status_code_actual',
        'status_code_validation',
        'response_body_factual',
        'response_body_actual',
        'response_body_validation',
        'response_time',
        'response_time_accumulation',
        'response_time_validation',
    ];

    protected $hidden = ['deleted_at'];

    public function main_dealer()
    {
        return $this->hasOne(MainDealerModel::class, 'id', 'main_dealer_id');
    }
}
