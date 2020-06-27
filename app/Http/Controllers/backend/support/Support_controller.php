<?php


namespace App\Http\Controllers\backend\support;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\support\Support_model;
use App\Http\Model\support\Type_support_model;

class Support_controller extends Controller
{
    function index(){
        $messages= Session::get('messages');
        $support=Support_model::all();
        $type_support=Type_support_model::all();
        return view("admin.home.site.support.index",["support"=>$support,'type_support'=>$type_support,'messages'=>$messages]);
    }
    function update_support(Request $request){
         if($request->isMethod('post')){
             $check=Support_model::actionModel($request);
             if ($check=='true') {
                 return redirect('admin/support/');
             }
             $support=Support_model::all();
             $type_support=Type_support_model::all();
             return view('admin.home.site.support.index',[
                 'errors'=>$check['validation'],
                 "support"=>$support,
                 'type_support'=>$type_support,]);
        }
        return redirect('admin/support/');

    }
    function delete($id){
        if($id){
            $supports=Support_model::find($id);
            if($supports){
                if($supports->delete()){
                    Session::flash('messages', 'Đã xoá công ');
                }
            }
        }
         return redirect('admin/support/');
       
    }
}
