<?php

namespace App\Http\Model\history;

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
use App\Http\Model\history\HistoryItem_model;
use App\Http\Model\history\TableTem_model;
class History_model extends Model
{
	const DEFAULT_ORDER = " id DESC ";
    const DELETE = 1;
    const ACTION_CREATE=1;
    const ACTION_UPDATE=2;
    const ACTION_DELETE=3;
    const TABLE=[
        'news'=>'Tin tức',
        'news_category'=>'Danh mục tin tức',
        'banner'=>'Banner',
        'banner_category'=>'Danh mục banner',
        'combo'=>'Combo',
        'combo_category'=>'Danh mục combo',
        'hotel'=>'Khách sạn',
        'hotel_images'=>'Hình ảnh khách sạn',
        'hotel_room'=>'Phòng khách sạn',
        'hotel_room_images'=>'Hình ảnh phòng khách sạn',
    ];
    const VALUE_CONTINUE=[
        'updated_at',
        'id'
    ];
    const VALUE_TIME=[
        'updated_at',
        'created_at',
        'public_at',
        'deleted_at'
    ];
    protected $table = 'history_user';
    public $timestamps=false;
    protected $fillable = [
        'colum_id',
        'name_table',
        'action',
        'user_id',
        'created_at'
    ];
    const ALL_COLUM = [
        'name'=>'Tên',
        'description'=>'Mô tả',
        'status'=>'Trạng thái',
        'short_description'=>'Mô tả ngắn',
        'public_at'=>'Ngày phát hành',
        'meta_keywords'=>'meta_keywords',
        'meta_description'=>'meta_description',
        'meta_title'=>'meta_title',
        'img_root'=>'Hình ảnh',
        'ishot'=>'Hot',
        'orders'=>'Thứ tự',
        'id_category'=>'Danh mục',
    ];
    const CATEGORY=[
        'news'=>'news_category',
        'banner'=>'banner_category',
        'product'=>'product_category',
        'video'=>'video_category'
    ];
    const TABLE_FIND=['id_category'];
    public static function boot(){
        parent::boot();
        self::creating(function($model){
        	$model->created_at=time();
        });
    }
    public static function updateChange($action,$table,$id,$oldAttributes=null,$newAttributes=null){
        $history=new History_model();
        $history->user_id=auth()->user()->id;
        $history->name_table=$table;
        $history->colum_id=$id;
        $history->ip=self::get_client_ip();
        $check=0;
        if($action==self::ACTION_CREATE){
            $history->action=self::ACTION_CREATE;
            $check=$history->save();
        }
        if($action==self::ACTION_UPDATE){
            $check=1;
            if($oldAttributes && $newAttributes){
            	$oldAttributes=$oldAttributes->toArray();
                $history->action=self::ACTION_UPDATE;
                foreach ($oldAttributes as $key => $value) {
                    if(isset($newAttributes[$key]) && $oldAttributes[$key]!=$newAttributes[$key]){
                        if(in_array($key, self::VALUE_CONTINUE)){
                            continue;
                        } 
                        if(in_array($key, self::VALUE_TIME)){
                            $newAttributes[$key]=strtotime(str_replace('/', '-', $newAttributes[$key]));
                           	if($oldAttributes[$key]==$newAttributes[$key]){
                           		continue;
                           	}
                        } 
                        if(!$history->id){
                            $history->save();
                        }
                        if($history->id){
                            $history_item=new HistoryItem_model();
                            $history_item->value_old=$oldAttributes[$key];
                            $history_item->value_new=$newAttributes[$key];
                            $history_item->history_id=$history->id;
                            $history_item->name=$key;
                            $history_item->save();
                        }
                    }
                }
            }
            
        }
        if($action==self::ACTION_DELETE){
            $history->action=self::ACTION_DELETE;
            $history->save();
        }
        if($check){
            return true;
        }
        return false;
    }

    static function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    static function getAction($action){
        $name='Thêm dữ liệu';
        if($action==self::ACTION_UPDATE){
            $name='Chỉnh sửa dữ liệu';
        }
        if($action==self::ACTION_DELETE){
            $name='Xóa dữ liệu';
        }
        return $name;
    }

    static function getTableName($table){
        return isset(self::TABLE[$table])?self::TABLE[$table]:'';
    }
    static function getColumName($colum){
        return isset(self::ALL_COLUM[$colum])?self::ALL_COLUM[$colum]:'';
    }

    static function getValue($table,$data){
        $tab=isset(self::CATEGORY[$table])?self::CATEGORY[$table]:'';
        if($tab && in_array($data->name, self::TABLE_FIND) ){
            $category=new TableTem_model($tab);
            $category=$category->find($data->value_new);
            if($category){
                $tab= $category->name;

            }
        }
        else{
            $tab= $data->value_new;
        }
        return $tab;
    }

}
