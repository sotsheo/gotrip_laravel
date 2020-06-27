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
use App\Http\Model\banner\Banner_model;
use App\Http\Model\banner\BannerCategory_model;

use Illuminate\Support\Facades\Input;
class BannerWidget extends Controller{

	// combo pice
	public static function banner($view_v,$view,$number_type,$widget){
		$view_v.='banner.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		$category=BannerCategory_model::find($widget->id_category);
		$data=Banner_model::where('id_category',$widget->id_category)->limit($widget->limit)->get();
		return view($view_v,["widget"=>$widget,'banner'=>$data,'category'=>$category]);
	}

	
}

