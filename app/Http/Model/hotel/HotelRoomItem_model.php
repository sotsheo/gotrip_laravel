<?php

namespace App\Http\Model\hotel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use App\Cl\ClCategory;
use  App\Http\Model\album\AlbumImg_model;
class HotelRoomItem_model extends Model
{
    protected $table = 'hotel_room_items';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'description',
        'status',
        'status',
        'delete',
        'delete_at',
        'created_at',
        'updated_at'
        
    ];
    public static function boot(){
        parent::boot();
        self::creating(function($model){
            $model->created_at=$model->updated_at=time();
        });
        self::updating(function($model){
        	$model->created_at=$model->updated_at=time();
    	});
    }
   
    public static function getAll(){
         $where['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        return HotelRoomItem_model::where($where)->get();
    }
      public static function validate($request){
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                
            ],
            [
                'required' => ':attribute không được để trống',
                'integer' => ':attribute chỉ được nhập số',
            ],

            [
                'name' => 'Tiêu đề',
                
            ]

        );
        if ($validate->fails()) {
            return  $validate->messages();
        }
        return false;
    }
}
