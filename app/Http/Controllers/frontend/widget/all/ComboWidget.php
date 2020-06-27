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


use App\Http\Model\combo\ComboCategory_model;
use App\Http\Model\combo\Combo_model;
use Illuminate\Support\Facades\Input;
class ComboWidget extends Controller{

	// combo pice
	public static function comboSortPrice($view_v,$view,$number_type,$widget){
		$price=[
			'0_2000000'=>'Dưới 2.000.000đ',
			'2000000_4000000'=>'2.000.000đ - 4.000.000đ',
			'4000000_6000000'=>'4.000.000đ - 6.000.000đ',
			'6000000_8000000'=>'6.000.000đ - 8.000.000đ',
			'8000000_0'=>'Trên 8.000.000đ',
		];
		$data=[];
		foreach ($price as $key => $value) {
			$tem=[];
			$price_ex=explode('_', $key);

			$tem['name']=$value;
			$tem['checked']=checkParam(['p_mi','p_ma'],[$price_ex[0],$price_ex[1]]);
			if(!$tem['checked']){
				$tem['link']=createParam(['p_mi','p_ma'],[$price_ex[0],$price_ex[1]]);
			}else{
				$tem['link']=createParam(['p_mi','p_ma'],[-1,-1]);
			}

			$data[]=$tem;
		}
		$view_v.='comboSortPrice.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}     
		return view($view_v,["widget"=>$widget,"data"=>$data]);
	}

	public static function comboSort($view_v,$view,$number_type,$widget){
		$view_v.='comboSort.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		return view($view_v,["widget"=>$widget]);
	}

	public static function searchCombo($view_v,$view,$number_type,$widget){
		$view_v.='searchCombo.';
		if(view()->exists($view_v.$view)){
			$view_v=$view_v.$view;
		}
		$time_to=date('yy-m-d', strtotime("+15 days"));
		$time_from=date('yy-m-d',time());
		$inputs = Input::all();
		
		if(isset($inputs['t-start'])){
			$time_from=$inputs['t-start'];
		}
		if(isset($inputs['t-end'])){
			$time_to=$inputs['t-end'];
		}

		$data_month_now=Combo_model::getAllNotOptions(0,['time'=>0,'limit'=>100000]);
                    // sắp xếp lại
		$data=[];
		if($data_month_now){
			foreach ($data_month_now as $key => $value) {
				if($value['time']){
					foreach ($value['time'] as $keys => $vl2) {
						$data[date('Y-m-d',$vl2['time_start'])]=$value['name'];
					}
				}
			}
		}
		
		return view($view_v,[
			"widget"=>$widget,
			'time_from'=>$time_from,
			'time_to'=>$time_to,
			'data_month_now'=>json_encode($data)
		]);
	}

	public static function combocategoryishot($view_v,$view,$number_type,$widget){
		$view_v.='combocategoryishot.';
                    if(view()->exists($view_v.$view)){
                        $view_v=$view_v.$view;
                    }
                    $data=Combo_model::getComboInCateIsHome([
                        'limit'=>$widget->limit_category,
                        'limit_item'=>$widget->limit
                    ]);
                return view($view_v,["widget"=>$widget,'data'=>$data]);
	}
}

