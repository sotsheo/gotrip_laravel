<?php

namespace App\Http\Model\album;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use App\Cl\ClCategory;
use  App\Http\Model\album\AlbumImg_model;
use  App\Http\Model\album\Album_model;
class AlbumCategory_model extends Model
{
    protected $table = 'album_category';
     protected $fillable = [
        'name',
        'id_category',
        'status',
        'url_seo',
        'img',
        'img_path',
        'img_name',
        'img_root',
        'short_description',
        'ishot',
        'created_at',
        'updated_at',
        'orders',
        'meta_keywords',
        'meta_description',
        'meta_title',
        'link',
        'delete',
        'delete_at'
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
            $model->created_at=$model->updated_at=strtotime(date('d/m/Y H:i:s'));
        });
        self::created(function($model){
           $model->link = "/" . $model->url_seo . "_cab" .$model->id . '.html';
           $model->save();
        });
        self::updating(function($model){
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
            $model->updated_at=time();
            $model->url_seo=createUrlpage($model->name);
            $model->link = "/" . $model->url_seo . "_cab" .$model->id . '.html';
            //  print_r($model->public_at);
            // die();
        });
        
    }
    public $timestamps=false;
    //
   

     public static function validate($request){
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:5|max:255',
                'order'=>'integer'
            ],
            [
                'required' => ':attribute Không được để trống',
                'integer' => ':attribute Chỉ được nhập số',
            ],

            [
                'name' => 'Tiêu đề',
                'order' => 'Thứ tự'
            ]

        );
        if ($validate->fails()) {
            return  $validate->messages();
        }
        return false;
    }

    public static function categoryishome(){
        $data['limit'] = 0;
        $data['limit_category'] = 0;
        return $data;
    }

    public static function getdatacategoryishome($limit,$limit_category){
        $data_v1==array();
        $where['status']=$where_item['status']=ClCategory::ACTIVE;
        $where['delete']=$where_item['delete']=ClCategory::NOT_ACTIVE;
        $where['ishome']=ClCategory::ACTIVE;
        $category=AlbumCategory_model::where($where)->limit($limit_category)->get();
        if($category){
            foreach($category as $cate){
                $where_item['id_category']=$cate->id;
                $album=Album_model::where($where_item)->limit($limit)->get();
                  if($album){
                    foreach($category as $cate){
                        $album['img']=AlbumImg_model::where('id_album',$album->id)->get();
                        $data[]= $album;
                    }
                  }   
            }
        }
        $data_v1['category']=$category;
        $data_v1['album']=$data;
        return $data_v1;
    }
}
