<?php

namespace App\Http\Model\combo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use  App\Http\Model\album\AlbumImg_model;
class ComboOrder_model extends Model
{
    protected $table = 'combo_order';
    public $timestamps=false;
    protected $fillable = [
        'code_order',
        'user_id',
        'name',
        'phone',
        'address',
        'email',
        'content',
        'code',
        'type',
        'prefix',
        'state',
        'status',
        'combo_id',
        'price_all',
        'created_at',
        'ip'
    ]; 

    public static function validate($request){
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            ],
            [
                'required' => ':attribute không được để trống',
                'email' => ':attribute không đúng định dạng',
                'integer' => ':attribute chỉ được nhập số',
                'regex' => ':attribute không đúng định dạng',
            ],

            [
                'name' => 'Tên của bạn',
                'email' => 'Email',
                'phone' => 'Số điện thoại',
            ]

        );
        if ($validate->fails()) {
            return  $validate->messages();
        }
        return false;
    }
    
}
