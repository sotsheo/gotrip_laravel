<?php

namespace App\Http\Model\site\shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use  App\Http\Model\site\shop\ShopImages_model;
class Shop_model extends Model
{
    protected $table = 'shop';
    public $timestamps=false;
    //
    public  static  function actionModel($model,$request){
       $time = strtotime(date("d-m-Y h:i:s"));
        $model->name = $request->name;

    
        if ($request->img) {
            $file = $request->file('img');
            $destinationPath = 'upload/shop/';
            $model->img = $destinationPath . $time . "." . $file->getClientOriginalExtension();
        }
        if($model->name){
            $model->url_seo = createUrlpage($model->name);
        }
        $model->link =  $model->url_seo . "-shop-" . '1' . ".html";
        $model->state = $request->state;
        if ($request->short_description) {
            $model->short_description = $request->short_description;
        }
        $model->short_description = "";
        if ($request->short_description) {
            $model->short_description = $request->short_description;
        }
         if ($request->address) {
            $model->address = $request->address;
        }
         if ($request->province) {
            $model->province = $request->province;
        }

         if ($request->district) {
            $model->district = $request->district;
        }

         if ($request->map) {
            $model->map = $request->map;
        }

        if ($request->orders) {
            $model->orders = $request->orders;
        }

        
        $model->date_create = strtotime(date('d-m-Y'));

        // kiểm tra tồn tại của thời gian nếu không thì lấy thời gian hiện tại
       
        $validation=Shop_model::validation_news($request);
        if( $validation){
            $data['validation']=$validation;
            $data['model']=$model;
            return $data;
        }
        if(isset( $file)){
            $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
            $model->img_path=url('upload/');
            $model->img_name=$time.".".$file->getClientOriginalExtension();
            uploadFile($model->img,$file,$time);
        }
         if($request->id){
             $model->link = $model->url_seo . "-shop-" .$request->id . '.html';
         }
        if ($model->save()) {
            $id_insert=Shop_model::orderBy('id','DESC')->first();
            if(!$request->id){
                $id_insert=Shop_model::find($id_insert->id);
                $id_insert->link = $id_insert->url_seo . "-shop-" .$id_insert->id . '.html';
                $id_insert->save();
            }
             $images=ShopImages_model::where('id_shop',0)->get();
                if($images){
                    foreach($images as $img){
                        $tem=ShopImages_model::find($img->id);
                        $tem->id_shop=$id_insert->id;
                        $tem->save();
                    }
                }

           
            Session::flash('messages', 'Đã thêm thành công bài viết ' . $model->name);
            return 'true';
        }
        

    }

    public static function validation_news($request){
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:1|max:255',
                'order'=>'integer',
                 'id_category'=>'integer',
            ],
            [
                'required' => ':attribute Không được để trống',
                'integer' => ':attribute Chỉ được nhập số',
            ],

            [
                'name' => 'Tiêu đề',
                'order' => 'Thứ tự',
                'id_category'=>'Danh mục'
            ]

        );
        if ($validate->fails()) {
            return  $validate->messages();
        }
        return false;
    }
    
}
