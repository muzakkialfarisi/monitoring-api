<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeatureModel extends Model
{
    use SoftDeletes;

    protected $table = 'feautre';
    protected $dateFormat = "Y-m-d H:i:s";
    protected $fillable = [];

    protected $hidden = ['deleted_at'];
}
