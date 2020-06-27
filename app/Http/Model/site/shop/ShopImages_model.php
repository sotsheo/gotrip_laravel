<?php

namespace App\Http\Model\Site\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;


class ShopImages_model extends Model
{
    protected $table = 'shop_images';
    public $timestamps = false;

    public  static function actionModel($image,$file,$time,$order=array()){


        if($image->save()){
            $destinationPath = 'upload/album/';
            $file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
            $link_image = $destinationPath . $time . "." . $file->getClientOriginalExtension();
            uploadFile($link_image,$file,$time);
            return ['img_path'=>$image->img_path,'img_name'=>$image->img_name,'id'=>$image->id];
        }
        return false;
    }
    public  static function actionRemove($id){
        $new_image= ShopImages_model::find($id);
        if($new_image){
            $new_image->delete();
            return true;
        }
        return false;
    }
}
