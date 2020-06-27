<?php

namespace App\Http\Model\menu;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Model\menu\MenuCategory_model;
use App\Http\Model\news\News_model;
use App\Http\Model\news\PageContent_model;
use App\Http\Model\news\NewsCategory_model;
use App\Http\Model\product\Product_model;
use App\Http\Model\product\ProductCategory_model;
use App\Http\Model\combo\ComboCategory_model;
use App\Http\Model\Websites_model;
use App\Http\Model\album\AlbumCategory_model;
use App\Cl\ClCategory;
class Menu_model extends Model
{
    protected $table = 'menu';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'id_category',
        'state',
        'id_parent',
        'url_seo',
        'img',
        'img_root',
        'icon',
        'icon_root',
        'short_description',
        'ishot',
        'created_at',
        'updated_at',
        'orders',
        'link',
        'type'
    ];
    public static function boot(){
        parent::boot();
        self::creating(function($model){
            if($model->img){
                $time=time();;
                $file = $model->img;
                $destinationPath = 'upload/menu/img/';
                $model->img_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                $file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                $model->img='';
            }
             if($model->icon){
                $time=time();;
                $file = $model->icon;
                $destinationPath = 'upload/menu/icon/';
                $model->icon_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                $file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                $model->icon='';
            }
            $model->created_at=$model->updated_at=time();
            
        });
        self::updating(function($model){
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/menu/img/';
                $model->img_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                $file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                $model->img='';
            }
             if($model->icon){
                $time=time()+1;
                $file = $model->icon;
                $destinationPath = 'upload/menu/icon/';
                $model->icon_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                $file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                $model->icon='';
            }
            $model->updated_at=time();
           
            // $model->link = "/" . $model->url_seo . "-ab-" .$model->id . '.html';
            //  print_r($model->public_at);
            // die();
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

    public static function getLinkmenu(){
        $where['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        // Link thường 
        $page=array(
            ["name"=>"Trang sản phẩm","link"=>"/san-phamall.html"],
            ["name"=>"Trang chủ","link"=>"/"],
            ["name"=>"Trang tuyển dụng","link"=>"tuyen-dung.html"],
            ["name"=>"Liên hệ","link"=>"lien-he.html"],
            ["name"=>"Giới thiệu","link"=>"gioi-thieu.html"],
            ["name"=>"Cửa hàng","link"=>"shop.html"],
            ["name"=>"Album ảnh","link"=>"album.html"],
            ["name"=>"Combo","link"=>"combo.html"]
        );
        $data["Link thường"]=$page;
        // category news
        // danh mục tin tức
        $category_news= NewsCategory_model::where($where)->get();
        if($category_news){
            $tem_v1=array();
            foreach($category_news as $category){
                $category["item"]= News_model::where($where)->where("id_category",$category->id)->get();
                $tem_v1[]=$category;
            }
        }
        $data["Tin tức"]= $tem_v1;
        // danh mục sản phảm
        $category_product= ProductCategory_model::where($where)->get();
        if($category_product){
            $tem_v1=array();
            foreach($category_product as $category){
                $category["item"]= Product_model::where($where)->where("id_category",$category->id)->get();
                $tem_v1[]=$category;
            }
        }
        $data["Sản phẩm"]= $tem_v1;
         // danh mục combo
        $category_combo= ComboCategory_model::where($where)->get();
        $data["Combo"]= $category_combo;
        $data["Trang nội dung"]= PageContent_model::where($where)->get();
        $data["video"]=AlbumCategory_model::where($where)->get();
        return $data;
    }

    public static function getAllMenu($category,$id=0){
        // $where['status']=ClCategory::ACTIVE;
        // $where['delete']=ClCategory::NOT_ACTIVE;
        $where['id_category']=$category;
        $query=Menu_model::query();
        if($id){
            $query->where('id','!=',$id);
        }
        return $query->where($where)->get();
    }
}
