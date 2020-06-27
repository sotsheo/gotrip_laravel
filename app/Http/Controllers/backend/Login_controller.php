<?php


namespace App\Http\Controllers\backend;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Model\site\Website_model;
use Illuminate\Support\Facades\Input;
class Login_controller extends Controller{

    function index(Request $request){
        $model=new User();
        if($request->isMethod('post')){
            $name=$request->name;
            $password=$request->password;
            $inputs = Input::all();
            // $user=new User();
            // $user->name=$name;
            // $user->authorities=0;
            // $user->au_list=1;
            // $user->password=bcrypt($password);
            // $user->save();
            $model->fill($inputs);
            if($name && $password){

                if(Auth::attempt(['name'=>$name,"password"=>$password])){
                    $w = Website_model::find(1);
                    if($w->type_website==1){
                        return redirect('admin/news/');
                    }
                    if($w->type_website==2){
                        return redirect('admin/product/');
                    }
                }
                return view("admin.home.login",['model'=>$model,'alert'=>'Đăng nhập không thành công!']);
            }     
            $validate=$model->validate_login($request);
            if($validate){
                return view("admin.home.login",['model'=>$model,'validate'=>$validate]);
            }
            
        }
        return view("admin.home.login",['model'=>$model]);
       //return view("admin.home.login");
    }
    function register(){
     return view("admin.home.register");
 }
 function registers(Request $request){
    if($request->isMethod('post')){
        $user=new User();
        if(!$request->name){
            $check['name']='Không được để trống tên';
        }
        if(!$request->password){
            $check['password']='Không được để trống mật khẩu';
        }
        if(!$request->email){
            $check['email']='Không được để trống email';
        }
        if($request->password!=$request->passwordv2){
            $check['passwordv2']='Nhập lại mật khẩu sai';
        }
        if(isset($check) && count($check)>0){
            return view("admin.home.register",['check'=>$check]);
        }
        else{
            $user->name=trim($request->name);
            $user->email=trim($request->email);
            $user->authorities=0;
            $user->password=bcrypt(trim($request->password));
            $user->save();
        }

    }
    return view("admin.home.login"); 
}
function login(Request $request){
        // die();
    $w = Website_model::find(1);
    if($request->isMethod('post')){
        $name=$request->name;
        $password=$request->password;
            // $user=new User();
            // $user->name=$name;
            // $user->authorities=0;
            // $user->au_list=1;
            // $user->password=bcrypt($password);
            // $user->save();
        if($name && $password){
            if(Auth::attempt(['name'=>$name,"password"=>$password])){
                if($w->type_website==1){
                    return redirect('admin/news/');
                }
                if($w->type_website==2){
                    return redirect('admin/product/');
                }
            }

        }     
    }
    return view("admin.home.login");
}
function logout(Request $request){
    Auth::logout();
    return redirect('admin');
}
}
