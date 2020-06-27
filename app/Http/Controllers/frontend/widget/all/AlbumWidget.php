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
use App\Http\Model\album\AlbumCategory_model;
use App\Http\Model\album\Album_model;
use Illuminate\Support\Facades\Input;
class AlbumWidget extends Controller{

	// combo pice
	public static function albumcategoryishome($view_v,$view,$number_type,$widget){
		$view_v.='albumcategoryishome.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		$data=AlbumCategory_model::getdatacategoryishome($widget->limit);
		return view($view_v,["widget"=>$widget,'products'=>$data]);
	}

	public static function albumhot($view_v,$view,$number_type,$widget){
		$view_v.='albumhot.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		$data=Album_model::getdataAlbumhot($widget->limit);
		return view($view_v,["widget"=>$widget,'album'=>$data]);
	}

	public static function albumhot($view_v,$view,$number_type,$widget){
		$view_v.='albumhot.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		$data=Album_model::getdataAlbumhot($widget->limit);
		return view($view_v,["widget"=>$widget,'album'=>$data]);
	}

	
	
}

