<?php

namespace App\Http\Model\site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
class Introduce_model extends Model
{
    protected $table = 'introduces';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'img',
        'img_path',
        'img_name',
        'key',
        'short_description',
        'description',
        'meta_keywords',
        'meta_description',
        'meta_title',
    ];
    public static function boot(){
        parent::boot();
        self::creating(function($model){
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/group_product/';
                $model->img_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                $model->img='';
            }
            
        });
        
        self::updating(function($model){
           
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/group_product/';
                $model->img_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                $model->img='';
            }
        });
        
    }
    // public static function actionModel($in,$request)
    // {
    //     if($request->name){
    //         $in->name=$request->name;
    //     }
    //     $time=strtotime(date("d-m-Y h:i:s"));
    //     if($request->img){
    //         $file = $request->file('img');
    //         $destinationPath = 'upload/introduct/';
    //         $in->icon=$destinationPath.$time.".".$file->getClientOriginalExtension();
    //     }
    //     if($request->key){
    //         $in->key=$request->key;
    //     }
    //     if($request->short_description){
    //         $in->short_description=$request->short_description;
    //     }
    //     if($request->editor1){
    //         $in->description=$request->editor1;
    //     }
    //     if($in->save()){
    //         if(isset( $file)){
    //             $file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
    //         }
    //         if(isset( $files)){
    //             $files->move($destinationPath,$time.".".$files->getClientOriginalExtension());
    //         }
    //     }
    //     return 'true';
    // }

    public static function getIntroduce(){
        return Introduce_model::first();
    }
}
