<?php

namespace App\Http\Model\combo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use App\Cl\ClCategory;
use  App\Http\Model\album\AlbumImg_model;
class ComboCategory_model extends Model
{
    protected $table = 'combo_category';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'id_parent',
        'url_seo',
        'short_description',
        'description',
        'ishot',
        'status',
        'view',
        'meta_keywords',
        'meta_description',
        'meta_title',
        'img',
        'img_path',
        'img_name',
        'img_root',
        'order',
        'delete',
        'delete_at',
        'created_at',
        'updated_at',
    ];
    public static function boot(){
        parent::boot();
        self::creating(function($model){
            $model->url_seo=createUrlpage($model->name);
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/combo/';
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
           $model->link = "/" . $model->url_seo . "_ccb" .$model->id . '.html';
           $model->save();
        });
        self::updating(function($model){
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/combo/';
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
            $model->link = "/" . $model->url_seo . "_ccb" .$model->id . '.html';
            //  print_r($model->public_at);
            // die();
        });
        
    }
   

    public static function validate($request){
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:5|max:255',
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
    
     public static function getArrayCategory($id=0){
        $where['status']=ClCategory::ACTIVE;
        $where['delete']=0;
        $query=ComboCategory_model::query();
        if($id){
            $query->where('id','!=',$id);
        }
        return $query->where($where)->orderByRaw('id DESC')->get();
        
    }
     public static function getcategoryishot(){
        $where['status']=ClCategory::ACTIVE;
        $where['ishot']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        $category = ComboCategory_model::where($where)->get();
        $data['limit'] = 0;
        $data['limit_category'] = 0;
        return $data;
    }
}
