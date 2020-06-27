<?php

namespace App\Http\Model\Au;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use  App\Http\Model\album\albumImg_model;
class Group_au_model extends Model
{
    protected $table = 'au_user';
    public $timestamps=false;
    //
    public  static  function actionModel($model){

        if ($model->save()) {
            return 'true';
        }


    }


}
