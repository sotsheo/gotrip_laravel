<?php

namespace App\Http\Model\code;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Cl\ClCategory;
use Illuminate\Http\Request;
use  App\Http\Model\album\AlbumImg_model;
class Code_model extends Model
{

    const TYPE_1=1;//LOẠI GIẢM GIÁ TIỀN
    const TYPE_2=2;// LOẠI GIẢM GIÁ %
    
    protected $table = 'code';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'time_start',
        'time_end',
        'type',
        'price',
        'created_at',
        'updated_at',
        'number_code',
        'prefix',
        'delete',
        'delete_at'
    ];
    public static function boot(){
        parent::boot();
        self::creating(function($model){
            $model->created_at=$model->updated_at=time();
            if($model->price){
                $model->price=(int)str_replace(',','',$model->price);
            }
             if($model->number_code){
                $model->number_code=(int)str_replace(',','',$model->number_code);
            }
            $model->time_start=strtotime(str_replace('/','-',$model->time_start));
            $model->time_end=strtotime(str_replace('/','-',$model->time_end));
        });
       
        self::updating(function($model){
            $model->updated_at=time();
        });
        
    }
   

    public static function validate($request){
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:5|max:255',
                'time_start'=>'required',
                'time_end'=>'required',
                'type'=>'required',
                'price'=>'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'integer' => ':attribute chỉ được nhập số',
            ],

            [
                'name' => 'Tiêu đề',
                'time_end' => 'Thời gian bắt đầu',
                'time_start'=>'Thời gian kết thúc',
                'type' => 'Loại giảm giá',
                'price'=>'Giảm giá'
            ]

        );
        if ($validate->fails()) {
            return  $validate->messages();
        }
        return false;
    }
    

    public static function getTypeArray(){
        return [
            self::TYPE_1=>'Loại 1',
            self::TYPE_2=>'Loại 2'
        ];
    }
   
}
