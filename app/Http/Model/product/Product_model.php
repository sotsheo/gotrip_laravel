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
use App\Cl\ClCategory;
use Cookie;
class Product_model extends Model
{
    protected $table = 'product';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'code',
        'url_seo',
        'id_category',
        'id_category',
        'slogan',
        'price',
        'price_market',
        'price_discount',
        'price_discount_market',
        'short_description',
        'description',
        'img_path',
        'img_name',
        'img',
        'img_root',
        'link',
        'viewed',
        'quantity',
        'manufacturer',
        'status',
        'ishot',
        'isselling',
        'user',
        'key_card',
        'orders',
        'created_at',
        'updated_at',
        'public_at',
        'meta_keywords',
        'meta_description',
        'meta_title',
        'id_manufacturer',
        'star',
        'number_ratting',// đánh giá
        'product_root',// sản phẩm gốc 
        'note',
        'price_ship',
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
            $model->created_at=$model->updated_at=time();
            $model->public_at=time();
            if($model->price){
                $model->price=str_replace(',','',$model->price);
            }
            if($model->price_market){
                $model->price_market=str_replace(',','',$model->price_market);
            }
        });
        self::created(function($model){
            $model->updated_at=time();
            $model->link="/".$model->url_seo."_pd".$model->id.".html";
            $model->save();
        });
        self::updating(function($model){
            $model->url_seo=createUrlpage($model->name);
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
            if($model->price){
                $model->price=str_replace(',','',$model->price);
            }
            if($model->price_market){
                $model->price_market=str_replace(',','',$model->price_market);
            }
            $model->link="/".$model->url_seo."_pd".$model->id.".html";
            $model->public_at=strtotime(str_replace('/','-',$model->public_at));
            $model->updated_at=time();
        });
        
    }
    

    public static function validate($request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2|max:255',
                'orders,id_category' => 'required,integer',
                'price,price_market' => 'required,integer',
                'id_category'=>'exists:product_category,id'
            ],
            [
                'required' => ':attribute Không được để trống',
                'orders' => ':attribute phải là số',
                'exists'=>':attribute không được rông'
            ],
            [
                'name' => 'Tiêu đề',
                'orders' => 'Tứ tự',
                'id_category' => 'Danh mục',
                'price'=>'Giá',
                'price_market'=>'Giá thị trường'
            ]
        );
        if ($validate->fails()) {
            return $validate->messages();
        }
        return false;
    }

    public static function productall($limit)
    {
        $product=Product_model::limit($limit)->get();
        return $product;
    }

     public static function productwidgets()
    {
         $data['limit'] = 0;
        return $data;
    }

    public static function getproductscorrelate(){
        $data['limit'] = 0;
        return $data;
    }

    public static function getProductOption($option=array(),$id=0){
        $where['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        $query=Product_model::query();
        $orders='orders ASC,id DESC';
        if(isset($option['id_category']) && $option['id_category']) {
            $where['id_category']=$option['id_category'];
        }
        if($id!=0) {
             $query->where('id','!=',$id);
        }
        $query->where($where);
        $query->where('public_at','<=',time());
        $product=$query->get();
        $products=[0=>'Lựa chọn ...'];
        if($product){
            foreach($product as $p){
                $products[$p->id]=$p->name;
            }
            
        }
        return $products;
        
    }

    public static function getProducts($option=array()){
        $where['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        $w=Website_model::first();
        $query=Product_model::query();
        $page=$w->pagesize;

        if(isset($option['id_category']) && $option['id_category']) {
            $where['id_category']=$option['id_category'];
        }
        if(isset($option['pagesize']) && $option['pagesize']) {
            $page=$option['pagesize'];
        }
        if(isset($option['status'])) {
            $where['status']=$option['status'];
        }
        $orders='orders ASC,id DESC';
        if(isset($option['order']) && $option['order']) {
            switch ($option['order']) {
                case 'price':
                    $order='price DESC';
                    break;
                
                case 'price_desc':
                    $order='price DESC';
                    break;

                case 'new':
                    $order='orders ASC,id DESC';
                    break;

                case 'order':
                    $order='number_order DESC';
                    break;
            }
            $orders=$order;
        }
        $query->where($where);
        if(isset($option['price_max']) && $option['price_max']) {
            $query->where('price','>=',$option['price_min']);
            $query->where('price','<=',$option['price_max']);
        }
        if(isset($option['name']) && $option['name']) {
            $query->where('name','like','%'.$option['name'].'%');
        }
        if(isset($option['star']) && $option['star']) {
            $query->where('star','>=',$option['star']);
        }
        if(!isset($option['admin'])) {
          $query->where('public_at','<=',time());
        }
        
        $products = $query->orderByRaw($orders)->paginate($page);
        return $products;

    }

    public static function getproductscorrelatedata($limit){
        $category=ProductCategory_model::where('url_seo',request()->segment(1))->first();
        $product_now=Product_model::where('link',$category->url_seo.'/'.request()->segment(2))->where('id_category',$category->id)->first();
         $productscorrelate=Product_model::where('id','!=',$product_now->id)->limit($limit)->get();
        return $productscorrelate;
    }

    public static function getProductInArray($data,$limits=0){
        $w=Website_model::first();
        $limit=$w->page_size;
        if($limits){
            $limit=$limits;
        }
        $where=[];
        $where['status']=1;
        $where['public_at']='>'.time();
        return Product_model::select('id',
            'name',
            'img_root',
            'price',
            'price_market',
            'img_name',
            'img_path',
            'short_description',
            'link'
        )->where($where)->whereIn('id',$data)->limit($limit)->get();
    }

    public static function setCookie($name,$data,$time=0){
        $minutes=30*24*3600;
        if($time){
            $time*=60;
            $minutes=0;
        }
        return Cookie::queue($name, $data, $minutes);
    }

    public static function getCookie($name){
        if(Cookie::get($name) !== false){
            return json_decode(Cookie::get($name));
        }
        return false;
    }
}
