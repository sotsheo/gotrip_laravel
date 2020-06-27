<?php

namespace App\Http\Model\product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Model\product\ProductCategory_model;
use App\Http\Model\product\Product_model;
use App\Http\Model\product\Manufacturer_model;
use App\Http\Model\product\ProductImages_model;
use App\Http\Model\site\Website_model;
use App\Cl\ClCategory;
class ProductTogether_model extends Model
{
	protected $table = 'product_together';
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
			$product=ProductTogether_model::where("id_product_g",$request->id_product)->first();
			// return $product;
			if($product){
				$product->delete();
				return $product;
			}
			
		}
		
	}

	public static function getProductInID($id){
		$product=ProductTogether_model::where("id_product",$id)->get();
		$data=[];
		foreach($product as $p){
			$data[]=Product_model::find($p->id_product_g);
		}
		return $data;
	}

	public static function getProductOutID($id){
		$where['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
		$w=Website_model::first();
		$page=$w->pagesize;
        $query=Product_model::query();
        $query->where($where);
        $query->where('public_at','<=',time());
        $orders='orders ASC,id DESC';
		$products=$query->orderByRaw($orders)->paginate($page);
		$product=ProductTogether_model::where("id_product",$id)->get();
		$tem=[];
		if($product){
			foreach($product as $p){
				$tem[$p->id_product_g]=$p->id_product_g;
			}
		}
        $datas=Product_model::whereNotIn('id',$tem)->get();
		return $datas;
	}
}


