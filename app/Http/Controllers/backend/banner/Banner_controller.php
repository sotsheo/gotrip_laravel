<?php


namespace App\Http\Controllers\backend\banner;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\banner\Banner_model;
use App\Http\Model\banner\BannerCategory_model;
use App\Http\Model\Websites_model;
use Illuminate\Support\Facades\Input;
use App\Http\Model\history\History_model;
use App\Http\Model\site\Website_model;
class Banner_controller extends Controller{
//https://www.freemysqlhosting.net/account/?msg=943
    function index(){
         $w = Website_model::find(self::WEB);
        $messages= Session::get('messages');
        $banner=Banner_model::where(['status'=>1,'delete'=>0])->orderByRaw('orders ASC,id DESC')->paginate($w->pagesize);
        $category=BannerCategory_model::where(['status'=>1,'delete'=>0])->get();
        return view("admin.home.banner.banner.index",["banner"=>$banner,'category'=>$category,'messages'=>$messages]);
    }
    function create(Request $request){
        $model=new Banner_model;
        $category=BannerCategory_model::where(['status'=>1,'delete'=>0])->get();
        $model->created_at = time();
        $tem=[''=>'Danh mục '];
        if($category){
            foreach($category as $cate){
                $tem[$cate['id']]=$cate['name'];
            }
        }
        if($request->isMethod('post')){
            $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){                
                $tem=$model->create($inputs);
                History_model::updateChange(History_model::ACTION_CREATE,'banner',$tem->id);
                return redirect('admin/banner/');
            }
            $model->fill($inputs);
            return view('admin.home.banner.banner.insert',[
                'errors' =>$validate,
                'model' => $model,
                'category'=>$tem
            ]);
            
        }
    	return view("admin.home.banner.banner.insert",['category'=>$tem,'model'=> $model]);
    }
  
    function update(Banner_model $model,Request $request){
        if($model){
            $category=BannerCategory_model::where(['status'=>1,'delete'=>0])->get();
            $tem=[''=>'Danh mục '];
            if($category){
                foreach($category as $cate){
                    $tem[$cate['id']]=$cate['name'];
                }
            }
            if($request->isMethod('post')){
                $inputs = Input::all();
                $validate=$model->validate($request);
                if(!$model->validate($request)){                
                    $model_old=$model;  
                    if(History_model::updateChange(History_model::ACTION_UPDATE,'banner',$model->id,$model_old,$inputs)){
                        $model->update($inputs);
                        return redirect('admin/banner/');
                    }  
                }
                $model->fill($inputs);
                return view('admin.home.banner.banner.update',[
                    'errors' =>$validate,
                    'model' => $model,
                    'category'=>$tem
                ]);
            }
        return view("admin.home.banner.banner.update",['model'=>$model,'category'=>$tem]);
        }
        return redirect('admin/banner/');
    }


    function delete(Banner_model $model){
        if($model){
            $model->delete=1;
            $model->delete_at=time();
            if($model->save()){
                History_model::updateChange(History_model::ACTION_DELETE,'banner',$model->id);
                Session::flash('messages', 'Đã xóa thành công banner'.$model->name);
                return redirect('admin/banner/');
            }
        }
        return redirect('admin/banner/');

    }



 // controller danh cho view

    static function getCategory($id){
        $category=Category_banner_model::find($id);
        return $category;
    }
}
