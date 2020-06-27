<?php

namespace App\Http\Model\product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Model\product\ProductCategory_model;
use App\Http\Model\product\Manufacturer_model;
use App\Http\Model\product\ProductImages_model;
use App\Http\Model\site\Website_model;
use Cookie;
class ProductRating_model extends Model
{
    protected $table = 'product_rating';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'id_product',
        'img_path',
        'img_name',
        'img',
        'img_root',
        'phone',
        'address',
        'email',
        'content',
        'rate',
        'status',
        'created_at',
        'updated_at',
        'have_bought',
        'delete',
        'delete_at'

    ];
     public static function boot(){
        parent::boot();
        self::creating(function($model){
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/group_product/';
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
           
        });
        self::updating(function($model){
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/group_product/';
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
        });
        
    }
    

    public static function validate($request)
    {
        $validated = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'id_product' => 'required',
                'email' => 'required',
                'rate' => 'required',
                'phone' => 'required',
                'content' => 'required',
                'address' => 'required'
            ],
            [
                'required' => ':attribute Không được để trống'
            ],
            [
                'name' => 'Tiêu đề',
                'id_product' => 'Sản phẩm',
                'phone'=>'Số điện thoại',
                'address'=>'Địa chỉ',
                'content'=>'Nội dung',
                'email'=>'Email',
                'rate'=>'Đánh giá'
            ]
        );
        if ($validated->fails()) {
            return $validated->messages();
        }
        return false;
    }


}
