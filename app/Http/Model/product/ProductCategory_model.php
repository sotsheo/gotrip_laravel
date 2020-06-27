<?php

namespace App\Http\Model\product;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\product\Product_model;
use App\Cl\ClCategory;
use Validator;
class ProductCategory_model extends Model
{
    protected $table = 'product_category';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'id_parent',
        'id_group_properties',
        'url_seo',
        'short_description',
        'description',
        'img_path',
        'img_name',
        'img',
        'img_root',
        'link',
        'view_detail',
        'view',
        'status',
        'ishome',
        'key_card',
        'user',
        'orders',
        'created_at',
        'updated_at',
        'meta_keywords',
        'meta_description',
        'meta_title',
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
                $destinationPath = 'upload/category_product/';
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
            // $model->public_at=strtotime($model->public_at);
            
        });
        self::created(function($model){
            $model->created_at=$model->updated_at=time();
            $model->link="/".$model->url_seo."_cpd".$model->id.".html";
            $model->save();
        });
        self::updating(function($model){
            $model->url_seo=createUrlpage($model->name);
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/category_product/';
                $model->img_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                if(isset($file)){
                    $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                    $model->img_path=url('upload/');
                    $model->img_name=$time.".".$file->getClientOriginalExtension();
                    uploadFile($model->img_root,$file,$time);
                    $model->img='';
                }
            }
            $model->link="/".$model->url_seo."_cpd".$model->id.".html";
            //$model->public_at=strtotime($model->public_at);
            $model->updated_at=time();
        });
        
    }
    
    public static function validate($request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2|max:255',
                'orders' => 'integer'
            ],
            [
                'required' => ':attribute Không được để trống',
                'integer' => ':attribute phải là số'
            ],
            [
                'name' => 'Tiêu đề',
                'orders' => 'Thứ tự'
            ]
        );
        if ($validate->fails()) {
            return $validate->messages();
        }
        return false;
    }

    public static function productcategoryishome($limit_category, $limit){
        $where['status']=$where_item['status']=ClCategory::ACTIVE;
        $where['delete']=$where_item['delete']=ClCategory::NOT_ACTIVE;
        $where['ishome']=ClCategory::ACTIVE;
        if ($limit_category && $limit) {
            $categorys = array();
            $category = ProductCategory_model::where($where)->limit($limit_category)->get();
            if ($category) {
                foreach ($category as $cate) {
                      $where_item['id_category']=$cate->id;
                    $product = Product_model::where($where_item)->limit($limit)->get();
                    $cate['product'] = $product;
                    $categorys[] = $cate;
                }
            }
            return $categorys;
        }
    }

    // Lấy tất cả
    public static function getcateishome(){
        $where['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        $where['ishome']=ClCategory::ACTIVE;
        $category = ProductCategory_model::where($where)->get();
        $data['limit'] = 0;
        $data['limit_category'] = 0;
        return $data;
    }

    public static function getCategory(){
        $where['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        return ProductCategory_model::where($where)->orderByRaw('orders ASC,id DESC')->get();
    }
}
