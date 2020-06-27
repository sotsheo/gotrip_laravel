<?php

namespace App\Http\Model\product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Model\product\ProductCategory_model;
use App\Http\Model\news\News_model;
use App\Http\Model\product\Manufacturer_model;
use App\Http\Model\product\ProductImages_model;
class NewsTogether_model extends Model
{
	protected $table = 'news_together';
	public $timestamps = false;

    //
	public static function actionModel($product,$request)
	{
		
		if($request->type=='add'){
			if ($product->save()) {			
				return 'true';
			}
		}
		if($request->type=='delete'){
			$product=NewsTogether_model::where("id_news",$request->id_news)->first();
			return $product;
			if($product){
				$product->delete();
				return $product;
			}
			
		}
		
	}

	public static function getNewsInID($id){
		$product=NewsTogether_model::where("id_product",$id)->get();
		$data=[];
		foreach($product as $p){
			$data[]=News_model::find($p->id_news);
		}
	
		return $data;
	}

	public static function getNewsOutID($id){
		$products=News_model::all();
		$newss=NewsTogether_model::where("id_product",$id)->get();
		$datas=[];
        $datas=News_model::whereNotIn('id',$newss)->get();
		return $datas;
	}
}


