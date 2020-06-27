<?php

namespace App\Http\Model\hotel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use  App\Http\Model\album\AlbumImg_model;
class HotelImages_model extends Model
{
    protected $table = 'hotel_images';
    public $timestamps=false;
    protected $fillable = [
        'hotel_id',
        'path',
        'name',
        'order',
        'delete',
        'delete_at',
        'created_at'
        
    ];
    public static function boot(){
        parent::boot();
    }
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
        $new_image= HotelImages_model::find($id);
        if($new_image){
            $new_image->delete();
            return true;
        }
        return false;
    }

    public static function getAll($id){
        return HotelImages_model::where(['hotel_id'=>$id])->get();
    }
   
}
