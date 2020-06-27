<?php

namespace App\Http\Model\Video;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
class VideoCategory_model extends Model
{
    protected $table = 'video_category';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'img',
        'status',
        'created_at',
        'updated_at',
        'link',
        'img',
        'short_description',
        'img_path',
        'img_name',
        'img_root',
        'ishot',
        'view',
        'view_detail',
        'orders',
        'meta_keywords',
        'meta_description',
        'meta_title',
        'url_seo',
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
                $destinationPath = 'upload/video/';
                // $model->img=$destinationPath.$time.".".$file->getClientOriginalExtension();
                if(isset($file)){
                    $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                    $model->img_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                    $model->img_path=url('upload/');
                    $model->img_name=$time.".".$file->getClientOriginalExtension();
                    uploadFile($model->img_root,$file,$time);
                    $model->img='';
                }
            }
            $model->created_at=$model->updated_at=time();
        });
        self::created(function($model){
            $model->link = $model->url_seo."/" . $model->url_seo . "_cvd" .$model->id . '.html';
            $model->save();
        });
        self::updating(function($model){
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/video/';
                // $model->img=$destinationPath.$time.".".$file->getClientOriginalExtension();
                if(isset($file)){
                    $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                    $model->img_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                    $model->img_path=url('upload/');
                    $model->img_name=$time.".".$file->getClientOriginalExtension();
                    uploadFile($model->img_root,$file,$time);
                    $model->img='';
                }
            }
            $model->updated_at=time();
            $model->link = $model->url_seo."/" . $model->url_seo . "_cvd" .$model->id . '.html';
            // $model->created_at=$model->updated_at=strtotime(date('d/m/Y H:i:s'));
        });   
    }


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
}
