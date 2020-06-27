<?php

namespace App\Http\Model\flight;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Cl\ClCategory;
use Illuminate\Http\Request;
use  App\Http\Model\album\AlbumImg_model;
class Airline_model extends Model
{
    protected $table = 'airline';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'code',
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
           $model->link = "/" . $model->url_seo . "_al" .$model->id . '.html';
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
            $model->link = "/" . $model->url_seo . "_al" .$model->id . '.html';
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
    
    public static function getName($id){
        $data=Airline_model::find($id);
        return ($data)?$data['name']:'';
    }

    public static function getArrayAirline(){
        $where['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        $data=Airline_model::where($where)->get();
        $cat=[0=>'Chuyến bay...'];
        if($data){
            foreach ($data as $key => $value) {
                $cat[$value->id]=$value->name;
            }
        }
        return $cat;
        
    }
}
