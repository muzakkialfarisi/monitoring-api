<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\MainDealerModel;
use App\Models\BackEndModel;;
use App\Models\FeatureModel;
use App\Models\LogModel;

class ApiModel extends Model
{
    use SoftDeletes;

    protected $table = 'api';
    protected $dateFormat = "Y-m-d H:i:s";
    protected $fillable = [
        'back_end_id',
        'feature_id',
        'path',
        'is_active',
        'method',
        'main_dealer_id',
        'headers',
        'params',
        'body',
        'status_code_validation',
        'response_time_validation',
        'response_body_validation',
    ];

    protected $hidden = ['deleted_at'];


    public function back_end(){
        return $this->hasOne(BackEndModel::class, 'id','back_end_id');
    }

    public function feature(){
        return $this->hasOne(FeatureModel::class, 'id','feature_id');
    }

    public function main_dealer(){
        return $this->hasOne(MainDealerModel::class, 'id','main_dealer_id');
    }

    public function status_code_log(){
        return $this->hasOne(LogModel::class, 'id','status_code_id');
    }

    public function response_time_log(){
        return $this->hasOne(LogModel::class, 'id','response_time_id');
    }

    public function response_body_log(){
        return $this->hasOne(LogModel::class, 'id','response_body_id');
    }
}