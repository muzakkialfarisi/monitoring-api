<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\MainDealerModel;

class BackEndModel extends Model
{
    use SoftDeletes;

    protected $table = 'back_end';
    protected $dateFormat = "Y-m-d H:i:s";
    protected $fillable = [];

    protected $hidden = ['deleted_at'];

    public function main_dealer(){
        return $this->hasOne(MainDealer::class, 'id','main_dealer_id');
    }
}
