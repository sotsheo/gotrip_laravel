<?php
namespace App\Http\Model\news;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Model\news\NewsCategory_model;
use App\Http\Model\site\Website_model;
class News_model extends Model
{
    protected $table = 'news';
    protected $fillable = [
        'name',
        'id_category',
        'status',
        'url_seo',
        'img',
        'key_card',
        'img_path',
        'img_name',
        'img_root',
        'short_description',
        'description',
        'ishot',
        'created_at',
        'updated_at',
        'public_at',
        'orders',
        'meta_keywords',
        'meta_description',
        'meta_title',
        'viewed',
        'link',
        'id_category_track',
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
                $destinationPath = 'upload/news/';
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
            $model->public_at=strtotime(str_replace('/', '-', $model->public_at));
            //print_r($model->public_at);
            if(!$model->public_at){
                $model->public_at=time();
            }

             // $model->save();
        });
        self::created(function($model){
            $model->id_category_track=News_model::getAllCategoryTrack($model->id_category);
           $model->link = "/" . $model->url_seo . "_n" .$model->id . '.html';
           $model->save();
        });
        self::updating(function($model){
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/news/';
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
            if(!$model->public_at){
                $model->public_at=time();
                 // print_r($model->public_at);
            }else{
                $tem=strtotime(str_replace('/','-',$model->public_at));
                if($tem){
                    $model->public_at=$tem;
                }
            }
            $model->link = "/" . $model->url_seo . "_n-=" .$model->id . '.html';
            $model->id_category_track=News_model::getAllCategoryTrack($model->id_category);
            //  print_r($model->public_at);
            // die();
        });
        
    }
    public $timestamps=false;
    

    public static function validate($request){
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:5|max:255',
                'order'=>'integer',
                'id_category'=>'required',
                'description'=>'required',
            ],
            [
                'required' => ':attribute Không được để trống',
                'integer' => ':attribute Chỉ được nhập số',
            ],

            [
                'name' => 'Tiêu đề',
                'id_category'=>'Danh mục',
                'order' => 'Thứ tự'
            ]

        );
        if ($validate->fails()) {
            return  $validate->messages();
        }
        return false;
    }

    public static function getHotNews($limit){
        $data=News_model::where("ishot",1)->limit($limit)->get();
        return $data;
    }

    public static  function getHotNewsWidget(){
        $data['limit'] = 0;
        return $data;
    }

    public static function getNews($option=array()){
        $where['status']=1;
        $where['delete']=0;
        $w=Website_model::first();
        $query=News_model::query();
        $page=$w->pagesize;

        if(isset($option['pagesize']) && $option['pagesize']) {
            $page=$option['pagesize'];
        }
        if(isset($option['status'])) {
            $where['status']=$option['status'];
        }

        $orders='orders ASC,id DESC';
        $query->where($where);
        if(isset($option['name']) && $option['name']) {
            $query->where('name','like','%'.$option['name'].'%');
        }
        if(!isset($option['admin'])) {
           $query->where('public_at','<=',time());
        }
        if(isset($option['id_category']) && $option['id_category']) {
            $query->whereRaw("MATCH (id_category_track) AGAINST ('".$option['id_category']."' IN BOOLEAN MODE)", self::fullTextWildcards($option['id_category']));
        }
        $products = $query->orderByRaw($orders)->paginate($page);
        return $products;
    }

    public static function getAllCategoryTrack($id){
        $cat=$id;
        $cat_tem=0;
        $category=NewsCategory_model::find($id);
        if($category){
            $cat_tem=$category->id_parent;
        }
        while ($cat_tem) {
           $category=NewsCategory_model::find($cat_tem);
           if($category){
            $cat.=' '.$category->id;
             $cat_tem=$category->id_parent;
           }
        }
       
        return $cat;

    }

    public static function fullTextWildcards($term)
    {
        // removing symbols used by MySQL
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);
 
        $words = explode(' ', $term);
 
        foreach ($words as $key => $word) {
            /*
             * applying + operator (required word) only big words
             * because smaller ones are not indexed by mysql
             */
            if (strlen($word) >= 2) {
                $words[$key] = '+' . $word . '*';
            }
        }
 
        $searchTerm = implode(' ', $words);
 
        return $searchTerm;
    }
}
