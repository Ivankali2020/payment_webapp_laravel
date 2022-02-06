<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $guarded = [];

    public function getUser(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
