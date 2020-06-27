<?php

namespace App\Http\Model\au;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use  App\Http\Model\album\AlbumImg_model;
class Au_model extends Model
{
    protected $table = 'au';
    public $timestamps=false;
    //
    public  static  function actionModel($model){

        if ($model->save()) {
            return 'true';
        }


    }


}
