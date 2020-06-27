<?php


namespace App\Http\Controllers\frontend\widget\all;

use App\Http\Controllers\frontend\Controller;
use App\Cl\ClMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

use App\Http\Model\Widget_model;

use App\Http\Model\site\Website_model;
use App\Http\Model\site\Html_model;
use App\Http\Model\product\Product_model;
use App\Http\Model\product\ProductCategory_model;
use App\Http\Model\product\Manufacturer_model;
use App\Http\Model\product\List_group_product_model;
use App\Http\Model\product\ProductRating_model;
use Illuminate\Support\Facades\Input;
class ProductWidget extends Controller{

	// combo pice
	public static function productcategoryishome($view_v,$view,$number_type,$widget){
		$view_v.='productcategoryishome.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		$data=ProductCategory_model::productcategoryishome($widget->limit_category,$widget->limit);
		return view($view_v,["widget"=>$widget,'category'=>$data]);
	}

	public static function categoryproduct($view_v,$view,$number_type,$widget){
		$view_v.='categoryproduct.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		$data=ProductCategory_model::getCategory();
		$data=create_menu($data);
		return view($view_v,["widget"=>$widget,'category'=>$data]);
	}

	public static function productall($view_v,$view,$number_type,$widget){
		$view_v.='productall.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		$data=Product_model::productall($widget->limit);
		return view($view_v,["widget"=>$widget,'products'=>$data]);
	}

	public static function productrating($view_v,$view,$number_type,$widget){
		$view_v.='productrating.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		$model_rating=new ProductRating_model;
		$url_news = explode('-', url()->current());
		$id=getID($url_news,'pd');
		return view($view_v,["widget"=>$widget,'productrating'=>$model_rating,'id'=>$id]);
	}


	public static function productviewed($view_v,$view,$number_type,$widget){
		$view_v.='productviewed.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		$data=Product_model::getCookie('product_viewed');
		$data=array_keys((array)$data);
		$data=Product_model::getProductInArray($data);
		return view($view_v,["widget"=>$widget,'products'=>$data]);
	}

	public static function productgroup($view_v,$view,$number_type,$widget){
		$view_v.='productgroup.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		$data=List_group_product_model::getProductInGroup($widget->limit,$widget->id_category);
		$group=List_group_product_model::getGroup($widget->id_category);
		return view($view_v,["widget"=>$widget,'data'=>$data,'group'=>$group]);
	}

	public static function productscorrelate($view_v,$view,$number_type,$widget){
		$view_v.='productscorrelate.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		$data=Product_model::getproductscorrelatedata($widget->limit);
		return view($view_v,["widget"=>$widget,'products'=>$data]);
	}

	public static function pagesize($view_v,$view,$number_type,$widget){
		$view_v.='pagesize.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		return view($view_v,["widget"=>$widget]);
	}

	public static function fillterprice($view_v,$view,$number_type,$widget){
		$view_v.='fillterprice.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		return view($view_v,["widget"=>$widget]);
	}

	public static function sort($view_v,$view,$number_type,$widget){
		$view_v.='sort.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		return view($view_v,["widget"=>$widget]);
	}

	public static function star($view_v,$view,$number_type,$widget){
		$view_v.='star.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		return view($view_v,["widget"=>$widget]);
	}
	
}

