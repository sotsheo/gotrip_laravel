<?php

namespace App\Http\Model\combo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use  App\Http\Model\album\AlbumImg_model;
class ComboImages_model extends Model
{
    protected $table = 'combo_images';
    public $timestamps=false;
    protected $fillable = [
        'combo_id',
        'path',
        'name',
        'order',
        'created_at',
        'delete',
        'delete_at',
        
    ];
    public  static function actionModel($image,$file,$time,$order=array()){


        if($image->save()){

            $destinationPath = 'upload/hotel/';
            $file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
            $link_image = $destinationPath . $time . "." . $file->getClientOriginalExtension();
            uploadFile($link_image,$file,$time);
            return ['img_path'=>$image->path,'img_name'=>$image->name,'id'=>$image->id];
        }
        return false;
    }
    public  static function actionRemove($id){
        $new_image= ComboImages_model::find($id);
        if($new_image){
            $new_image->delete();
            return true;
        }
        return false;
    }

    public static function getAll($id){
        return ComboImages_model::where(['combo_id'=>$id])->get();
    }
    
}
