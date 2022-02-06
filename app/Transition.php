<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transition extends Model
{
    public function owner(){

        return $this->belongsTo(User::class,'user_id','id');

    }

    public function fromOtherUser(){

        return $this->belongsTo(User::class,'source_id','id');

    }
}
