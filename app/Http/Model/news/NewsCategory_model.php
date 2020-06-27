<?php

namespace App\Http\Model\news;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use App\Http\Model\news\News_model;
use App\Http\Model\site\Lang_model;
use App\ClCategory;
use Illuminate\Http\Request;
use Validator;
use Cookie;
class NewsCategory_model extends Model
{
    
    protected $table = 'news_category';
    protected $fillable = [
        'name',
        'id_parent',
        'view_detail',
        'view',
        'status',
        'url_seo',
        'img',
        'key_card',
        'img_path',
        'img_name',
        'short_description',
        'description',
        'ishome',
        'created_at',
        'updated_at',
        'order',
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
                $destinationPath = 'upload/category_news/';
                $model->img_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                if(isset($file)){
                    $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                    $model->img_path=url('upload/');
                    $model->img_name=$time.".".$file->getClientOriginalExtension();
                    uploadFile($model->img_root,$file,$time);
                    $model->img='';
                }
            }
            $model->created_at=$model->updated_at=strtotime(date('d/m/Y H:i:s'));
        });
        self::created(function($model){
            $model->link = "/" . $model->url_seo . "_cn" .$model->id . '.html';
            $model->save();
        });
        self::updating(function($model){
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/category_news/';
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
            $model->url_seo=createUrlpage($model->name);
            $model->link = "/" . $model->url_seo . "_cn" .$model->id . '.html';
        });
    }
    public $timestamps=false;

    //    lấy tất cả danh mục nằm ngoài trang chủ
    public static function get_category(){
        $where['status']=$where_item['status']=ClCategory::ACTIVE;
        $where['ishome']=$where_item['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        $category = Category_news_model::where($where)->get();
        $data['limit'] = 0;
        $data['limit_category'] = 0;
        return $data;
    }
    //    lấy tất cả danh mục nằm ngoài trang chủ
    public static function categoryishome($limit_category, $limit){
        $where['status']=$where_item['status']=ClCategory::ACTIVE;
        $where['ishome']=$where_item['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        $query=NewsCategory_model::query();
        if ($limit_category && $limit) {
            $query->where($where);
            $categorys = array();
            $category = NewsCategory_model::where($where)->limit($limit_category)->get();
            if ($category) {
                foreach ($category as $cate) {
                    $where_item['id_category']=$cate->id;
                    $news = News_model::where($where_item)->limit($limit)->get();
                    $cate['news'] = $news;
                    $categorys[] = $cate;
                }
            }
            return $categorys;
        }
    }
    // Lấy tất cả
    public static function getnewsincategory(){
        $where['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        $category = NewsCategory_model::where($where)->get();
        $data['limit'] = 0;
        $data['category'] = $category;
        return $data;
    }


//    Validation for form
    public static function validate($request){
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:5|max:255',
                'short_description' => 'required',
                'order'=>'integer'
            ],
            [
                'required' => ':attribute Không được để trống',
                'integer' => ':attribute Chỉ được nhập số',
            ],

            [
                'name' => 'Tiêu đề',
                'short_description' => 'Mô tả ngắn',
                'order' => 'Thứ tự'
            ]

        );
        if ($validate->fails()) {
            return  $validate->messages();
        }
        return false;
    }
}
