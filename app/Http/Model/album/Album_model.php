<?php

namespace App\Http\Model\album;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Cl\ClCategory;
use Illuminate\Http\Request;
use  App\Http\Model\album\AlbumImg_model;
class Album_model extends Model
{
    protected $table = 'album';
    public $timestamps=false;
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
            $model->created_at=$model->updated_at=time();

            
        });
        self::created(function($model){
           $model->link = "/" . $model->url_seo . "_ab" .$model->id . '.html';
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
            $model->link = "/" . $model->url_seo . "_ab" .$model->id . '.html';
            //  print_r($model->public_at);
            // die();
        });
        
    }
   

    public static function validate($request){
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:5|max:255',
                'order'=>'integer',
                 'id_category'=>'integer',
            ],
            [
                'required' => ':attribute không được để trống',
                'integer' => ':attribute chỉ được nhập số',
            ],

            [
                'name' => 'Tiêu đề',
                'order' => 'Thứ tự',
                'id_category'=>'Danh mục'
            ]

        );
        if ($validate->fails()) {
            return  $validate->messages();
        }
        return false;
    }
    public static function getAlbumhot(){
        $data['limit']=0;
        return $data;
    }
    public static function getdataAlbumhot($limit){
        $where['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        $where['ishot']=ClCategory::ACTIVE;
        $query=Album_model::query();
        $album=$query->where($where)->limit($limit)->get();
        if( $album){
            foreach($album as $ab){
             $ab['img']=AlbumImg_model::where('id_album',$ab->id)->get();
             $data[]=$ab;
            }
        }
        return $data;
    }
}
