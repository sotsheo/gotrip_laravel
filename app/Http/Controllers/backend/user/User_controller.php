<?php


namespace App\Http\Controllers\backend\user;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\Controller;
use App\Http\Model\au\Au_model;
use App\Http\Model\au\Group_au_model;
use App\Http\Model\au\Au_user_model;
use App\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Model\site\Website_model;
class User_controller extends Controller
{

    function index(){
         $w = Website_model::find(self::WEB);
        $user = User::where("authorities","!=",1)->paginate($w->pagesize);
       return view("admin.home.user.index",['user'=>$user]);
    }

    function create(Request $request){
    	$model = new User();
    	$au = Au_user_model::all();
        if ($request->isMethod('post')) {
            $au =  Au_user_model::all();
            $model = new User();
            $check=User::actionModel($model, $request);
            if ($check=='true') {
                return redirect('admin/user/');
                }
            return view('admin.home.user.insert',[
                'errors'=>$check['validation'],
                'model'=>$check['model'],
                'au'=>$au]
                );
        }
    	return view("admin.home.user.insert",['model'=>$model,'au'=>$au]);
    }
   
     function update(User $model,Request $request){
    	$model=User::find($id);
    	$au =  Au_user_model::all();
        if ($request->isMethod('post')) {
            $au =  Au_user_model::all();
            $model = User::find($request->id);
            $check=User::actionModel($model, $request);
            if ($check=='true') {
                return redirect('admin/user/');
                }
            return view('admin.home.user.update',[
                'errors'=>$check['validation'],
                'model'=>$check['model'],
                'au'=>$au]
                );
        }
    	return view("admin.home.user.update",['model'=>$model,'au'=>$au]);
    }


    function delete($id){
        $model=User::find($id);
        if($model){
           if ($model->delete()) {
                return redirect('admin/user/');
            }
        }
    }
}
