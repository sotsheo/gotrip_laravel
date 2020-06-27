<?php


namespace App\Http\Controllers\backend\video;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\video\Video_model;
use  App\Http\Model\video\VideoCategory_model;
use Illuminate\Support\Facades\Input;
use App\Http\Model\history\History_model;
use App\Http\Model\site\Website_model;
class VideoCategory_controller extends Controller
{

    function index(){
      $w = Website_model::find(self::WEB);
        $messages= Session::get('messages');
        $category=VideoCategory_model::where(['status'=>1,'delete'=>0])->paginate($w->pagesize);
        return view("admin.home.video.category_video.index",["category"=>$category,'messages'=>$messages]);
    }
    function create(Request $request){
    	$model=new VideoCategory_model;
      $model->date_create = strtotime(date('d-m-Y'));
      $model->orders = 0;
        if ($request->isMethod('post')) {
          $inputs = Input::all();
          $validate=$model->validate($request);
          if(!$model->validate($request)){             
            $tem=$model->create($inputs);
            History_model::updateChange(History_model::ACTION_CREATE,'video_dategory',$tem->id);
            return redirect('admin/category_video/');
          }
          $model->fill($inputs);
          // $model->public_at=strtotime($model->public_at);
          return view('admin.home.video.category_video.insert', [
            'errors' =>$validate,
            'model' => $model,
            "category" =>$tem]);
        }
       return view("admin.home.video.category_video.insert",["model"=>$model]);
   }



    // edit
  function update(VideoCategory_model $model,Request $request){
    if($model){
      if ($request->isMethod('post')) {
          $inputs = Input::all();
          $validate=$model->validate($request);
          if(!$model->validate($request)){              
            $model_old=$model;  
            if(History_model::updateChange(History_model::ACTION_UPDATE,'video_category',$model->id,$model_old,$inputs)){
              $model->update($inputs);
              return redirect('admin/category_video/');
            }  
          }
          $model->fill($inputs);
          // $model->public_at=strtotime($model->public_at);
          return view('admin.home.video.category_video.update', [
            'errors' =>$validate,
            'model' => $model,
            "category" =>$tem]);
        }
      return view("admin.home.video.category_video.update",["model"=>$model]);
    }
    return redirect('admin/category_video/');
  }


  function delete(VideoCategory_model $model){
      if($model){
        $model->delete=1;
        $model->delete_at=time();
        if($model->save()){
          History_model::updateChange(History_model::ACTION_DELETE,'video_category',$model->id);
          return redirect('admin/category_video/');
        }
      }
    return redirect('admin/category_video/');
  }

}
