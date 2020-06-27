<?php


namespace App\Http\Controllers\frontend\home;

use App\Http\Controllers\frontend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\site\Shop\Shop_model;
use App\Http\Model\province\Province_model;
use App\Http\Model\province\District_model;
use Mail;
use App\Http\Model\Site\Website_model;

class Shop_controller extends Controller
{
	

	public function index(Request $request){
		$this->writeHistory();
		$province=Province_model::all();
		$district=array();
		$shop=Shop_model::all();
		$where=array();
		if($request->province){
			$where['province']=$request->province;
			$district=District_model::where('provinceid',$request->province)->get();

		}
		if($request->district){
			$where['district']=$request->district;
		}
		if(count($where)){
			$shop=Shop_model::where($where)->get();
		}
		return view('view.shop.index',['province'=>$province,'district'=>$district,'shop'=>$shop]);
	}
	


}
