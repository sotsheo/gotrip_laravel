<?php


namespace App\Http\Controllers\frontend;

use App\Http\Controllers\frontend\Controller;
use Illuminate\Http\Request;
use App\Http\Model\product\Product_model;
use App\Http\model\Users_model;
use App\Http\Model\site\HistoryUsers_model;
use Illuminate\Support\Facades\Input;
use Mail;
use Illuminate\Support\Facades\Auth;
class Login_controller extends Controller{
   
    function login(Request $request){
    	$model=new Users_model;
    	$inputs = Input::all();
    	if($request->isMethod('post')) {
    		$model->fill($inputs);
	    	if (Auth::guard('users')->attempt(['email'=>$model['email'],'password'=>$model['password']])) {
		        return redirect('/');
		    }
		}
	   
        return view("view.login.login",['model'=>$model]);
    }

    function signup(Request $request){

    	if(Auth::guard('users')->check()){
    		return redirect('/');
    	}
    	$model=new Users_model;
    	$inputs = Input::all();
    	if($request->isMethod('post')) {
    		$validate=$model->validation($request);
    		if(!$validate){
    			$tempassword=$inputs['password'];
	            $inputs['password']=bcrypt($inputs['password']);

	            $model->create($inputs);
	            if (Auth::guard('users')->attempt(['email'=>$inputs['email'],'password'=>$tempassword])) {
	            	return redirect('/');
	            }
    		}
    		$model->fill($inputs);
    		return view("view.login.signup",['model'=>$model,'errors' =>$validate]);
    	}
        return view("view.login.signup",['model'=>$model]);
    }

    function logout(Request $request){
    	Auth::guard('users')->logout();
         return redirect('/');
    }

    function loginAjax(Request $request){
        if($request->ajax()){
            $user=[];
            $inputs = Input::all();
            $errors=[];
            if($request->data){
                foreach ($request->data as  $value) {
                    $user[$value['name']]=$value['value'];
                }
            }
            if(!isset($user['email']) || !$user['email']){
                $errors['email']='Email không được trống!';
            }
             if(!isset($user['password']) || !$user['password']){
                $errors['password']='Mật khẩu không được trống!';
            }
            if($errors){
                return ['code'=>400,'errors'=>json_encode($errors),'messages'=>''];
            }
            if (Auth::guard('users')->attempt($user)) {
                return ['code'=>200,'errors'=>$errors];
            }
           
        }
        return ['code'=>400,'messages'=>'Đăng nhập không thành công!'];
    }

    function signupAjax(Request $request){
        if($request->ajax()){
            $user=new Users_model;
            $inputs = Input::all();
            $errors=[];
            $check=[];
            if($request->data){
                foreach ($request->data as  $value) {
                    $user[$value['name']]=$check[$value['name']]=$value['value'];
                }
            }
            
            $validate=$user->validationAjax($check);
            if($validate){
                return ['code'=>400,'errors'=>json_encode($validate),'messages'=>''];
            }
            if(!$validate){
                $tempassword=$check['password'];
                $check['password']=bcrypt($check['password']);
                $user->create($check);
                if (Auth::guard('users')->attempt(['email'=>$check['email'],'password'=>$tempassword])) {
                   return ['code'=>200,'errors'=>$validate];
                }
            }

           
        }
        return ['code'=>400,'messages'=>'Đăng nhập không thành công!'];
    }

    function getPosition(Request $request){
        if($request->ajax()){
            $inputs = Input::all();
            $time=Product_model::getCookie('time_location');
            $history=HistoryUsers_model::where(['time'=>$time])->first();
            if($history){
                $history->latitude=$inputs['latitude'];
                $history->longitude=$inputs['longitude'];
                if($history->save()){
                    return['code'=>200];
                }
            }
        }
        return['code'=>400];
    }
}