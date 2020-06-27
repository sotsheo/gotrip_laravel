<?php

namespace App\Http\Model\combo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use  App\Http\Model\album\AlbumImg_model;
class ComboInfo_model extends Model
{
    protected $table = 'combo_info';
    public $timestamps=false;
    protected $fillable = [
        'combo_id',
        'content',
        'status',
        'time',
        'address',
        'time_to_stay',
        'type',
        'delete',
        'delete_at',
        'created_at'
    ]; 
    
}
