<?php

namespace App\Http\Controllers\backend\site;
use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Model\site\Introduce_model;
use App\Http\Model\Websites_model;

class Introduce_controller extends Controller
{
    function index(){
        $in=Introduce_model::first();

        //  neu chua ton tai thi tao
        if(!isset($in)){
            $introduce=new Introduce_model;
            $introduce->name="";
            $introduce->img="";
            $introduce->key="";
            $introduce->short_description="";
            $introduce->description="";
            $introduce->save(); 
        }
        $introduce=Introduce_model::first();     

        return view("admin.home.site.introduce.update",["model"=>$introduce]);
    }
    function update_introduce(Request $request){
        if($request->isMethod('post')){
            $in=Introduce_model::first();
            $check=Introduce_model::actionModel($in, $request);
            if ($check=='true') {
                return redirect('admin/introduce/');
            }

        }
        return redirect('admin/introduce/');
    }

    
}
