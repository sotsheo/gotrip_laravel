<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Restore_model extends Model{
	const TABLE=[
		''=>'Lựa chọn bảng...',
		'news'=>'Bài viết',
		'news_category'=>'Danh mục bài viết',
		'product'=>'Sản phẩm',
		'product_category'=>'Danh mục sản phẩm',
		'album'=>'Album',
		'album_category'=>'Danh mục album',
		'banner'=>'Banner',
		'banner_category'=>'Danh mục banner',
		'video'=>'Video',
		'video_category'=>'Danh mục video',
	];
    protected $table = 'news';
    public function __construct($table=''){
    	if($table){
			$this->table=$table;
    	}
    	
    }
    public static function getTables(){
    	return self::TABLE;
    }

   	public function getDate(){
   		$data=$this->where(['delete'=>1])->get();
   		$time=[];
   		if($data){
   			foreach ($data as $key ) {
   				$time[date('d/m/Y',$key->delete_at)]=date('d/m/Y',$key->delete_at);
   			}
   		}
   		return $time;
   	}
}
