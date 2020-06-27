<?php

namespace App\Http\Model\combo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use  App\Http\Model\album\AlbumImg_model;
class ComboPoint_model extends Model
{
    protected $table = 'combo_point';
    public $timestamps=false;
    protected $fillable = [
        'user_id',
        'name',
        'combo_id',
        'img',
        'img_path',
        'img_name',
        'img_root',
        'point',
        'email',
        'phone',
        'address',
        'status',
        'ishot',
        'user_created',
        'created_at',
        'user_created',
        'created_at',
        'ip',
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
                $destinationPath = 'upload/combopoint/';
                $model->img_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                if(isset($file)){
                    $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                    $model->img_path=url('upload/');
                    $model->img_name=$time.".".$file->getClientOriginalExtension();
                    uploadFile($model->img_root,$file,$time);
                    $model->img='';
                }
            }
            $model->created_at=time();
            $model->ip=getIP();
            
        });
       
        self::updating(function($model){
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/combopoint/';
                $model->img_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                if(isset($file)){
                    $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                    $model->img_path=url('upload/');
                    $model->img_name=$time.".".$file->getClientOriginalExtension();
                    uploadFile($model->img_root,$file,$time);
                    $model->img='';
                }
            }
            $model->ip=getIP();
         
        });
        
    }
   

    public static function validate($request){
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:5|max:255',
                'content' => 'required',
                'point' => 'required|integer',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'integer' => ':attribute chỉ được nhập số',
            ],

            [
                'name' => 'Tiêu đề',
                'content' => 'Nội dung',
                'point' => 'Điểm',
                'email' => 'Email',
                'address' => 'Địa chỉ',
            ]

        );
        if ($validate->fails()) {
            return  $validate->messages();
        }
        return false;
    }
    
    
}
