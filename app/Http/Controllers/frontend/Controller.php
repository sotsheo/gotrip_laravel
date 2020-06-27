<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Model\site\Website_model;
use App\Http\Model\product\Product_model;
use App\Http\Model\site\HistoryUsers_model;
// use Illuminate\Http\Request;
// import
use App\Http\Controllers\frontend\home\News_controller;
use App\Http\Controllers\frontend\home\Album_controller;
use App\Http\Controllers\frontend\home\Product_controller;
use App\Http\Controllers\frontend\home\Combo_controller;
use App\Http\Controllers\frontend\home\Page_controller;
use App\Http\Controllers\frontend\home\Hotel_controller;
use App\Http\Controllers\frontend\home\Flight_controller;
use Illuminate\Support\Facades\Auth;
class Controller extends BaseController{

    const WEB=1;
    

    function __construct(){

        $w = Website_model::find(self::WEB);
        if ($w) {
            view()->share('w', $w);
        } else {
            $w = new Website_model;
            view()->share('w', $w);
        }
    }

     function writeHistory(){
        $ur_c=\Request::url();
        $url_old=url()->previous();
        $action='';
        $model=new HistoryUsers_model;
        if(isset(request()->route()->getAction()['uses'])){
            $action=request()->route()->getAction()['uses'];
        }
        $model->url_back=$url_old;
        $model->url_current=$ur_c;
        $model->action=$action;
        $model->time=time();
        if(Auth::guard('users')->check()){
            $model->user_id=Auth::guard('users')->user()->id;
        }
        // lấy tất cả param
        $request=\Request::all();
        if($request){
            $model->param=json_encode($request);
        }
        $model->ip=HistoryUsers_model::get_client_ip();
        Product_model::setCookie('time_location', $model->time,30);

        $model->save();
    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
