<?php

namespace App\Http\Model\hotel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use App\Cl\ClCategory;
use  App\Http\Model\album\AlbumImg_model;
class HotelRoom_model extends Model
{
    protected $table = 'hotel_room';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'url_seo',
        'hotel_id',
        'price',
        'price_children',
        'img',
        'img_path',
        'img_name',
        'img_root',
        // 'province_id',
        'no_of_persons', //trạng thái có ng k 
        'square',
        'acreage',//diện tích
        'bed', // giường đơn 
        'double_bed', // giường đôi
        'price_extra_bed', // giá kê thêm giường
        'extra_bed', // kê thêm giường
        'breakfast', // ăn sáng k 
        'price_breakfast',// giá ăn sáng ng lớn
        'price_breakfast_children', // giá ăn sáng trẻ em
        'status',
        'ishot',
        'state',
        'room_item',
        'delete',
        'delete_at',
        'created_at',
        'updated_at',
        'viewed',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'link',

    ];
    public static function boot(){
        parent::boot();
        self::creating(function($model){
            $model->url_seo=createUrlpage($model->name);
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/news/';
                $model->img_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                if(isset($file)){
                    $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                    $model->img_path=url('upload/');
                    $model->img_name=$time.".".$file->getClientOriginalExtension();
                    uploadFile($model->img_root,$file,$time);
                    $model->img='';
                }
            }
            if($model->price){
                $model->price=(int)str_replace(',','',$model->price);
            }
            if($model->price_children){
                $model->price_children=(int)str_replace(',','',$model->price_children);
            }
            if($model->price_extra_bed){
                $model->price_extra_bed=(int)str_replace(',','',$model->price_extra_bed);
            }
             if($model->price_breakfast){
                $model->price_breakfast=(int)str_replace(',','',$model->price_breakfast);
            }
             if($model->price_breakfast_children){
                $model->price_breakfast_children=(int)str_replace(',','',$model->price_breakfast_children);
            }
            $model->created_at=$model->updated_at=time();
            if($time_start){
                $model->time_starts=strtotime(str_replace('/', '-', $model->time_starts));
                
            }
            
            
            
        });
        self::created(function($model){
           $model->link = "/" . $model->url_seo . "_rht" .$model->id . '.html';
           $model->save();
        });
        self::updating(function($model){
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/hotelroom/';
                $model->img_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                if(isset($file)){
                    $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                    $model->img_path=url('upload/');
                    $model->img_name=$time.".".$file->getClientOriginalExtension();
                    uploadFile($model->img_root,$file,$time);
                    $model->img='';
                }
            }
            if($model->price){
                $model->price=(int)str_replace(',','',$model->price);
            }
            if($model->price_children){
                $model->price_children=(int)str_replace(',','',$model->price_children);
            }
            if($model->price_extra_bed){
                $model->price_extra_bed=(int)str_replace(',','',$model->price_extra_bed);
            }
             if($model->price_breakfast){
                $model->price_breakfast=(int)str_replace(',','',$model->price_breakfast);
            }
             if($model->price_breakfast_children){
                $model->price_breakfast_children=(int)str_replace(',','',$model->price_breakfast_children);
            }
            if($time_start){
                $model->time_starts=strtotime(str_replace('/', '-', $model->time_starts));
                
            }
            $model->updated_at=time();
            $model->url_seo=createUrlpage($model->name);
            $model->link = "/" . $model->url_seo . "_rht" .$model->id . '.html';
            //  print_r($model->public_at);
            // die();
        });
        
    }
   

    public static function validate($request){
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:5|max:255',
                'hotel_id'=>'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'integer' => ':attribute chỉ được nhập số',
            ],

            [
                'name' => 'Tiêu đề',
                'hotel_id' => 'Khách sạn ',
            ]

        );
        if ($validate->fails()) {
            return  $validate->messages();
        }
        return false;
    }
    public static function getRoom($id){
        $where['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        $where['hotel_id']=$id;
        $data=HotelRoom_model::where($where)->get();
        $cat=[0=>'Phòng...'];
        if($data){
            foreach ($data as $key => $value) {
                $cat[$value->id]=$value['name'];
            }
        }
        return $cat;
    }

    public static function getRom($id){
        $where['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        $where['id']=$id;
        return HotelRoom_model::where($where)->first();
    }
}
