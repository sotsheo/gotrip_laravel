<?php

namespace App\Http\Model\banner;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
class Banner_model extends Model
{
    protected $table = 'banner';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'short_description',
        'img',
        'status',
        'created_at',
        'updated_at',
        'link',
        'img',
        'short_description',
        'description',
        'id_category',
        'img_path',
        'img_name',
        'img_root',
         'url_seo',
         'delete',
         'delete_at'

    ];
    public static function boot(){
        parent::boot();
        self::creating(function($model){
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/banner/';
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
        self::updating(function($model){
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/banner/';
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
            // $model->created_at=$model->updated_at=strtotime(date('d/m/Y H:i:s'));
        });
        
    }

    public static function validate($request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'id_category'=>'required'
            ],
            [
                'required' => ':attribute không được để trống'
            ],
            [
                'name' => 'Tiêu đề',
                'id_category'=>'Danh mục'
            ]
        );
        if ($validate->fails()) {
            return $validate->messages();
        }
        return false;
    }
}
