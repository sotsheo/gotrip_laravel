<?php


namespace App\Http\Controllers\backend\site;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Model\site\Website_model;
use Illuminate\Support\Facades\Input;
class Setting_controller extends Controller
{

    function index(Request $request){
        $website=Website_model::get();
        //  neu chua ton tai thi tao
        if(!isset($website) || count($website)==0){
            $website=new Website_model;
            $website->name="";
            $website->icon="";
            $website->logo="";
            $website->phone="";
            $website->address="";
            $website->email="";
            $website->map="";
            $website->phone_admin='';
            $website->email_admin='';
            $website->save(); 
        }
        $website=Website_model::find(Website_model::WEB);
        if($request->isMethod('post')){
            $model=Website_model::find(Website_model::WEB);
            $inputs = Input::all();
            $validate=$model->validate($request);
            //$check=Website_model::actionModel($request,$website);
            if(!$model->validate($request)){   
                // $model->public_at=strtotime($model->public_at);    
                $inputs['default']=isset($inputs['default'])?self::ACTIVE:self::NOT_ACTIVE;
                $inputs['product_together']=isset($inputs['product_together'])?self::ACTIVE:self::NOT_ACTIVE;
                $inputs['product_qrcode']=isset($inputs['product_qrcode'])?self::ACTIVE:self::NOT_ACTIVE;
                $model->update($inputs);
                //return redirect('admin/news/');
                $website=Website_model::find(1);
            }
          
        }   
        return view("admin.home.site.setting.update",["model"=>$website]);
    }
    function update(Request $request){
        if($request->isMethod('post')){
            $website=Website_model::find(1);
            $check=Website_model::actionModel($request,$website);
            if ($check=='true') {
                return redirect('admin/news/');
            }
            return view('admin.home.site.setting.update',[
                'errors'=>$check['validation'],
                'model'=>$check['model']]);
          
        }
        return redirect('admin/setting/');
    }

    
}
