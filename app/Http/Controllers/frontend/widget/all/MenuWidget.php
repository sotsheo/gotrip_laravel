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
use App\Http\Model\menu\MenuCategory_model;
use App\Http\Model\menu\Menu_model;
use App\Http\Model\menu\Type_support_model;

use Illuminate\Support\Facades\Input;
class MenuWidget extends Controller{

	// combo pice
	public static function menu($view_v,$view,$number_type,$widget){
		$view_v.='menu.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		$category=MenuCategory_model::find($widget->id_category);
		$data=Menu_model::where('id_category',$widget->id_category)->get();
		$tem=new ClMenu();
		$data=$tem->createMenu($data,0);
                    // $data= create_menu($data);
		return view($view_v,["widget"=>$widget,'data'=>$data,'category'=>$category]);
	}

	
}

