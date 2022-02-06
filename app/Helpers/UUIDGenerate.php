<?php

namespace App\Helpers;

use App\Transition;
use App\Wallet;

class UUIDGenerate {

    public static function accGenerate(){
        $account = mt_rand(1000000000000000,9999999999999999);

       if( Wallet::where('acc_number',$account)->exists()){
           self::accGenerate();
       }else{
           return $account;
       }

    }

    public static function refId(){
        $refId = mt_rand(1000000000000000,9999999999999999);

        if( Transition::where('ref_id',$refId)->exists()){
            self::refId();
        }else{
            return $refId;
        }
    }

    public static function transitionId(){
        $transitionId = mt_rand(1000000000000000,9999999999999999);

        if( Transition::where('ref_id',$transitionId)->exists()){
            self::$transitionId();
        }else{
            return $transitionId;
        }
    }
}


?>
