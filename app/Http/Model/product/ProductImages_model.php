<?php

namespace App\Http\Model\product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Model\Category_product_model;
use App\Http\Model\Manufacturer_model;

class ProductImages_model extends Model
{
    protected $table = 'product_image';
    public $timestamps = false;
    public  static function actionModel($image,$file,$time,$order=array()){


        if($image->save()){

            $destinationPath = 'upload/product/';
            $file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
            $link_image = $destinationPath . $time . "." . $file->getClientOriginalExtension();
            uploadFile($link_image,$file,$time);
            return ['img_path'=>$image->img_path,'img_name'=>$image->img_name,'id'=>$image->id];
        }
        return false;
    }
    public  static function actionRemove($id){
        $new_image= ProductImages_model::find($id);
        if($new_image){
            $new_image->delete();
            return true;
        }
        return false;
    }
}
