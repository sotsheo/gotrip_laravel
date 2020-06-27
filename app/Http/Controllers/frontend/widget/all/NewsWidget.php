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
use App\Http\Model\news\News_model;
use App\Http\Model\news\NewsCategory_model;
use Illuminate\Support\Facades\Input;
use App\Http\Model\site\Introduce_model;
class NewsWidget extends Controller{

	// combo pice
	public static function newsIncategory($view_v,$view,$number_type,$widget){
		$view_v.='newsIncategory.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		$data=News_model::where('id_category',$widget->id_category)->limit($widget->limit)->get();
		$category=NewsCategory_model::find($widget->id_category);
		return view($view_v,["widget"=>$widget,'news'=>$data,'category'=>$category]);
	}

	public static function hotnews($view_v,$view,$number_type,$widget){
		$view_v.='hotnews.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		$data=News_model::getHotNews($widget->limit);
		return view($view_v,["widget"=>$widget,'data'=>$data]);
	}

	public static function categorynewsishome($view_v,$view,$number_type,$widget){
		$view_v.='categorynewsishome.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		$data=NewsCategory_model::categoryishome($widget->limit_category,$widget->limit);
		return view($view_v,["widget"=>$widget,'category'=>$data]);
	}

	public static function newsletter($view_v,$view,$number_type,$widget){
		$view_v.='newsletter.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}

		return view($view_v,["widget"=>$widget]);
	}

	public static function searchbox($view_v,$view,$number_type,$widget){
		$view_v.='searchbox.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		return view($view_v,["widget"=>$widget]);
	}	

	public static function cart($view_v,$view,$number_type,$widget){
		 $view_v.='cart.';
                    if(view()->exists($view_v.$view)){
                        $view_v=$view_v.$view;
                    }
                    $data=Product_model::getCookie('product_cart');
                    $data=[];
                    if((array)$data){
                        $data=array_keys((array)$data);
                    }
                return view($view_v,["widget"=>$widget,'data'=>$data]);
	}

	public static function cart($view_v,$view,$number_type,$widget){
		$view_v.='introduce.';
                    if(view()->exists($view_v.$view)){
                        $view_v=$view_v.$view;
                    }
                    $data=Introduce_model::getIntroduce();
                return view($view_v,["widget"=>$widget,'data'=>$data]);
	}
	
}

