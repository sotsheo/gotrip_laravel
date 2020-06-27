<?php

namespace App\Http\Model\news;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
class Newsletter_model extends Model
{
    protected $table = 'newsletter';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'title',
        'content',
        'viewed',
        'created_at',
        'delete'
    ];
    public $timestamps=false;
    public static function boot(){
        parent::boot();
        self::creating(function($model){
             $model->created_at=time();
        });
    }


    public static function validate($request){
        $validate = Validator::make(
            $request->all(),
            [
                'email' => 'required',
                'name' => 'required',
                'title' => 'required',
                'email'=>'email',
                'phone'=>'required',
                'content'=>'required'
            ],
            [
                'required' => ':attribute Không được để trống',
                'email' => ':attribute phải đúng định dạng email'
            ],

            [
                'email' => 'Email',
                'name' => 'Tên',
                'phone' => 'Số điện thoại',
                'title' => 'Tiêu đề',
                'content'=>'Nội dung'
            ]

        );
        if ($validate->fails()) {
            return  $validate->messages();
        }
        return false;
    }
}
