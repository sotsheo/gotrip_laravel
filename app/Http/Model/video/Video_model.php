<?php

namespace App\Http\Model\video;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use App\Cl\ClCategory;
class Video_model extends Model
{
    protected $table = 'video';
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
        'id_category',
        'img_path',
        'img_name',
        'img_root',
        'link_embe',
        'ishot',
        'orders',
        'meta_keywords',
        'meta_description',
        'meta_title',
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
            $model->link = $model->url_seo."/" . $model->url_seo . "_vd" .$model->id . '.html';
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
            $model->link = $model->url_seo."/" . $model->url_seo . "_vd" .$model->id . '.html';
            // $model->created_at=$model->updated_at=strtotime(date('d/m/Y H:i:s'));
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
    public static function getVideohot(){
        $data['limit']=0;
        return $data;
    }
    public static function getdataVideohot($limit){
        $where['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        $data=Video_model::limit($limit)->get();
        return $data;
    }
}
