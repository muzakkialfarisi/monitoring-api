<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\MainDealerModel;
use App\Models\BackEndModel;
use App\Models\HeadersModel;
use App\Models\ParamsModel;
use App\Models\BodyModel;

class ApiModel extends Model
{
    use SoftDeletes;

    protected $table = 'api';
    protected $dateFormat = "Y-m-d H:i:s";
    protected $fillable = [];

    protected $hidden = ['deleted_at'];


    public function back_end(){
        return $this->hasOne(BackEndModel::class, 'id','back_end_id');
    }

    public function feature(){
        return $this->hasOne(FeatureModel::class, 'id','feature_id');
    }

    public function body(){
        return $this->hasMany(BodyModel::class, 'api_id', 'id');
    }

    public function params(){
        return $this->hasMany(ParamsModel::class, 'api_id', 'id');
    }

    public function headers(){
        return $this->hasMany(HeadersModel::class, 'api_id', 'id');
    }
}