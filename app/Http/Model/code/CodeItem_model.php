<?php

namespace App\Http\Model\code;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Cl\ClCategory;
use Illuminate\Http\Request;
use  App\Http\Model\album\AlbumImg_model;
class CodeItem_model extends Model
{
    protected $table = 'code_item';
    public $timestamps=false;
    protected $fillable = [
        'key',
        'code_id',
        'order_id',
        'created_at',
        'use_time',
        'user_id',
    ];
   
 
   
}
