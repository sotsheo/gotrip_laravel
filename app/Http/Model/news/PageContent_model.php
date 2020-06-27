<?php

namespace App\Http\Model\news;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
class PageContent_model extends Model
{
    protected $table = 'pagecontent';
    protected $fillable = [
        'name',
        'status',
        'url_seo',
        'img',
        'key_card',
        'img_path',
        'img_name',
        'img_root',
        'short_description',
        'description',
        'view_detail',
        'created_at',
        'updated_at',
        'public_at',
        'orders',
        'meta_keywords',
        'meta_description',
        'meta_title',
        'viewed',
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
            $model->public_at=strtotime($model->public_at);
            if(!$model->public_at){
                $model->public_at=time();
            }
            
        });
        self::created(function($model){
           $model->link = "/" . $model->url_seo . "_page" .$model->id . '.html';
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
            $model->public_at=strtotime(str_replace('/','-',$model->public_at));
            $model->updated_at=time();
            $model->url_seo=createUrlpage($model->name);
            $model->link = "/" . $model->url_seo . "_page" .$model->id . '.html';
            //  print_r($model->public_at);
            // die();
        });
        
    }
    public $timestamps=false;
    public static function validate($request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:5|max:255',
                'description'=>'required',
            ],
            [
                'required' => ':attribute Không được để trống'
            ],

            [
                'name' => 'Tiêu đề',
                'description'=>'Nội dung',
            ]

        );
        if ($validate->fails()) {
            return $validate->messages();
        }
        return false;
    }
}
