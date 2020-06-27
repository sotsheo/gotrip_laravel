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

use Illuminate\Support\Facades\Input;
class HtmlWidget extends Controller{

	// combo pice
	public static function html($view_v,$view,$number_type,$widget){
		$view_v.='html.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		$data=Html_model::find($widget->id_category) ;
		return view($view_v,["widget"=>$widget,'html'=>$data]);
	}

	
}

