<?php

namespace App\Http\Model\hotel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use App\Cl\ClCategory;
use  App\Http\Model\album\AlbumImg_model;
class Hotel_model extends Model
{
    protected $table = 'hotel';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'url_seo',
        'star',
        'overview',
        'img',
        'img_path',
        'img_name',
        'img_root',
        'province_id',
        'lat',
        'lng',
        'address',
        'phone',
        'email',
        'ishot',
        'status',
        'map',
        'viewed',
        'hotel_item_list',
        'delete',
        'delete_at',
        'updated_at',
        'meta_keywords',
        'meta_title',
        'meta_description'
    ];
    public static function boot(){
        parent::boot();
        self::creating(function($model){
            $model->url_seo=createUrlpage($model->name);
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/hotel/';
                $model->img_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                if(isset($file)){
                    $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                    $model->img_path=url('upload/');
                    $model->img_name=$time.".".$file->getClientOriginalExtension();
                    uploadFile($model->img_root,$file,$time);
                    $model->img='';
                }
            }
            $model->created_at=$model->updated_at=strtotime(date('d/m/Y H:i:s'));

            
        });
        self::created(function($model){
            
           $model->link = "/" . $model->url_seo . "_ht" .$model->id . '.html';
           $model->save();
        });
        self::updating(function($model){
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/hotel/';
                $model->img_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                if(isset($file)){
                    $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                    $model->img_path=url('upload/');
                    $model->img_name=$time.".".$file->getClientOriginalExtension();
                    uploadFile($model->img_root,$file,$time);
                    $model->img='';
                }
            }
            $model->updated_at=time();
            $model->url_seo=createUrlpage($model->name);
            $model->link = "/" . $model->url_seo . "_ht" .$model->id . '.html';
            //  print_r($model->public_at);
            // die();
        });
        
    }
   

    public static function validate($request){
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:5|max:255',
                'province_id'=>'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'integer' => ':attribute chỉ được nhập số',
            ],

            [
                'name' => 'Tiêu đề',
                'province_id' => 'Thành phố',
            ]

        );
        if ($validate->fails()) {
            return  $validate->messages();
        }
        return false;
    }

    public static function getArrayHotel(){
        $where['status']=$where_item['status']=ClCategory::ACTIVE;
        $where['delete']=$where_item['delete']=ClCategory::NOT_ACTIVE;
        $data=Hotel_model::where($where)->get();
        $cat=[0=>'Khách sạn...'];
        if($data){
            foreach ($data as $key => $value) {
                $cat[$value->id]=$value->name;
            }
        }
        return $cat;
        
    }

    public static function getHotel($id){
        $where['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        $where['id']=$id;
        return Hotel_model::where($where)->first();
    }
    
}
