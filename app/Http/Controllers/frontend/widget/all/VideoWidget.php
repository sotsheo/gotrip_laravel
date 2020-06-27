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
use App\Http\Model\video\Video_model;
class VideoWidget extends Controller{

	// combo pice
	public static function newsIncategory($view_v,$view,$number_type,$widget){
		$view_v.='videohot.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		$data=Video_model::getdataVideohot($widget->limit);
		return view($view_v,["widget"=>$widget,'data'=>$data]);
	}

	
}

