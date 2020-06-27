<?php


namespace App\Http\Controllers\frontend\home;

use App\Http\Controllers\frontend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\news\Newsletter_model;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Admin\Mail;

class Newsletter_controller extends Controller
{


    function send(Request $request){
        $this->writeHistory();
        if ($request->isMethod('post')) {
            $model = new Newsletter_model;
            $inputs = Input::all();
            $validate=$model->validate($request);
            //$check = Newsletter_model::actionModel($news, $request);
            if(!$model->validate($request)){    
                // if(isset($check['validation'])){
                //     Session::flash('error_email',$check['validation']->first('email'));
                // }        
                $model->create($inputs);
                Session::flash('success', 'Xin cảm ơn bản đã gửi thông tin cúng toi sẽ liên hệ vs bạn sớm nhất');
                return redirect()->back();
            }
            // var_dump($validate);
            // die();
            $model->fill($inputs);
            Session::flash('validateNewsLetter', $validate);
            Session::flash('newsLetter', $model);
        }
        return redirect()->back();
    }



}
