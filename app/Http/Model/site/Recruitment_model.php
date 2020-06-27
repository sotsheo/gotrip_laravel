<?php

namespace App\Http\Model\site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use App\Http\Model\News_model;
use Validator;

class Recruitment_model extends Model
{
    protected $table = 'recruitment';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'state',
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
        'description',
        'task',
        'salary_min',
        'salary_max',
        'satus_salary',
        'contact',
        'email',
        'time_start',
        'time_deadline',
        'phone',
        'number',
        'address',
        'viewed',
        'stand',
        'time_start'
    ];
    public static function boot(){
        parent::boot();
        self::creating(function($model){
            $model->url_seo=createUrlpage($model->name);
            if($model->img){
                $time=strtotime(date("d/m/Y H:i:s"));
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
            $model->time_deadline=strtotime($model->time_deadline);
            $model->time_start=strtotime($model->time_start);
            
        });
        self::created(function($model){
           $model->link = "/" . $model->url_seo . "-ab-" .$model->id . '.html';
           $model->save();
        });
        self::updating(function($model){
            if($model->img){
                $time=strtotime(date("d/m/Y H:i:s"));
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
            $model->updated_at=strtotime(date('d/m/Y'));
            $model->url_seo=createUrlpage($model->name);
            $model->time_deadline=strtotime($model->time_deadline);
            $model->time_start=strtotime($model->time_start);
            $model->link = "/" . $model->url_seo . "-ab-" .$model->id . '.html';
            //  print_r($model->public_at);
            // die();
        });
        
    }
   
    //    Validation for form
    public static function validate($request){
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2|max:255',
                'short_description' => 'required',
                'description' => 'required',
                'stand' => 'required',
                'email'=>'email',
                'phone' => 'required',
                'address' => 'required',
                'time_start' => 'required',
                'time_deadline' => 'required',

            ],
            [
                'required' => ':attribute Không được để trống',
                'integer' => ':attribute Chỉ được nhập số',
                'email' =>':attribute Đúng định dạng Email'
            ],

            [
                'name' => 'Tiêu đề',
                'short_description' => 'Mô tả ngắn',
                'stand'=>'Vị trí ',
                'contact'=>'Người liên hệ',
                'email'=>'Email',
                'phone'=>'Số điện thoại ',
                'address'=>'Địa chỉ ',
                'time_start'=>'Ngày bắt đầu ',
                'time_start'=>'Ngày kết thúc '
            ]

        );
        if ($validate->fails()) {
            return  $validate->messages();
        }
        return false;
    }
}
