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

use App\Http\Model\hotel\Hotel_model;
use App\Http\Model\hotel\HotelRoom_model;
use Illuminate\Support\Facades\Input;
class HotelWidget extends Controller{

	// combo pice
	public static function hotelFilterStar($view_v,$view,$number_type,$widget){
		
		$star=[
			5=>'5',
			4=>'4',
			3=>'3',
			2=>'2',
			1=>'1'
		];
		$data=[];
		foreach ($star as $key => $value) {
			$tem=[];
			$tem['name']=$value;
			$tem['checked']=checkParam('ht_star',$value);
			if(!$tem['checked']){
				$tem['link']=createParam('ht_star',$value);
			}else{
				$tem['link']=createParam('ht_star',-1);
			}

			$data[]=$tem;
		}
		$view_v.='hotelFilterStar.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}     
		return view($view_v,["widget"=>$widget,'data'=>$data]);
	}


	
}

