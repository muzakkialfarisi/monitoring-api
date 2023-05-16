<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BodyModel extends Model
{
    use SoftDeletes;

    protected $table = 'body';
    protected $dateFormat = "Y-m-d H:i:s";
    protected $fillable = [];

    protected $hidden = ['deleted_at'];
}
