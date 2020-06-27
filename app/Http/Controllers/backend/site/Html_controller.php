<?php


namespace App\Http\Controllers\backend\site;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\site\Html_model;
use App\Http\Model\Websites_model;
use Illuminate\Support\Facades\Input;
use App\Http\Model\history\History_model;
use App\Http\Model\site\Website_model;
class Html_controller extends Controller
{

    function index(){
        $w = Website_model::find(self::WEB);
        $messages= Session::get('messages');
        $html=Html_model::where(['delete'=>0])->paginate($w->pagesize);
        return view("admin.home.site.html.index",["html"=>$html,'messages'=>$messages]);
    }
    function create(Request $request){
        $model=new Html_model;
        if($request->isMethod('post')){
            $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){              
                $tem=$model->create($inputs);
                History_model::updateChange(History_model::ACTION_CREATE,'html',$tem->id);
                return redirect('admin/html/');
            }
            $model->fill($inputs);
            return view('admin.home.site.html.insert',[
                'errors'=>$validate,
                'model'=>$model]);
        }
        return view("admin.home.site.html.insert",['model'=>$model]);
    }
   

    function update(Html_model $model,Request $request){

        // $html= Html_model::where("id",$id)->first();
        if($model){
            if($request->isMethod('post')){
                $inputs = Input::all();
                $validate=$model->validate($request);
                if(!$model->validate($request)){              
                    $model_old=$model;  
                    if(History_model::updateChange(History_model::ACTION_UPDATE,'html',$model->id,$model_old,$inputs)){
                        $model->update($inputs);
                        return redirect('admin/html/');
                    }  
                    
                }
                $model->fill($inputs);
                return view('admin.home.site.html.insert',[
                    'errors'=>$validate,
                    'model'=>$model]);
            }
            return view("admin.home.site.html.update",["model"=>$model]);
        }   
        return redirect('admin/html/');
    }


    function delete(Html_model $model){
        // $html= Html_model::where("id",$id)->first();
        if ($model) {
            $model->delete=1;
            $model->delete_at=time();
            if ($model->save()) {
                History_model::updateChange(History_model::ACTION_DELETE,'html',$model->id);
                Session::flash('messages', 'Đã xóa  nội dung tĩnh');
                return redirect('admin/html/');
            }
        }
        return redirect('admin/html/');
    }

   public static function get_html(){;
        $category=Html_model::all();
        $data['category']=$category;
        return $data;
    }
   
}
