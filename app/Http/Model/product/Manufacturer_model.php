<?php

namespace App\Http\Model\product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
class Manufacturer_model extends Model
{
    protected $table = 'manufacturer';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'short_description',
        'created_at',
        'updated_at',
        'description',
        'meta_keywords',
        'meta_description',
        'meta_title',
        'public_at',
        'state',
        'link',
        'img',
        'img_root',
        'url_seo',
        'delete'
    ];
    public static function boot(){
        parent::boot();
        self::creating(function($model){
             $model->url_seo=createUrlpage($model->name);
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/manufacturer/';
                $model->img_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                $model->img='';
            }
            $model->created_at=$model->updated_at=time();
            
            
        });
        self::created(function($model){
            $model->link="/".$model->url_seo."_mf".$model->id.".html";
            $model->save();
        });
        self::updating(function($model){
            $model->url_seo=createUrlpage($model->name);
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/manufacturerv/';
                $model->img_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                $model->img='';
                
            }
            $model->link="/".$model->url_seo."_mf".$model->id.".html";
            
            $model->updated_at=time();
        });
        
    }

    public static function validate($request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2|max:255'
            ],
            [
                'required' => ':attribute Không được để trống'
            ],
            [
                'name' => 'Tiêu đề'
            ]
        );
        if ($validate->fails()) {
            return $validate->messages();
        }
        return false;
    }

   
}
