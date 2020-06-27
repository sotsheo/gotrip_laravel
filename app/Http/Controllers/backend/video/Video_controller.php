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
class Video_controller extends Controller
{

	function index(){
		 $w = Website_model::find(self::WEB);
		$messages= Session::get('messages');
		$model=Video_model::where(['status'=>1,'delete'=>0])->paginate($w->pagesize);
		$category=VideoCategory_model::where(['status'=>1,'delete'=>0])->get();
		return view("admin.home.video.video.index",["category"=>$category,"model"=>$model,'messages'=>$messages]);
	}

// create
	function create(Request $request){
		$model=new Video_model;
		$model->date_create = strtotime(date('d-m-Y'));
		$model->orders = 0;
		$category=VideoCategory_model::where(['status'=>1,'delete'=>0])->get();
		$tem=[''=>'Danh mục '];
        foreach($category as $cate){
            $tem[$cate['id']]=$cate['name'];
        }
		if ($request->isMethod('post')) {
			$inputs = Input::all();
	            $validate=$model->validate($request);
	            if(!$model->validate($request)){   
	                // $model->public_at=strtotime($model->public_at);             
	                $tem=$model->create($inputs);
                	History_model::updateChange(History_model::ACTION_CREATE,'news',$tem->id);
	                return redirect('admin/video/');
	            }
	            $model->fill($inputs);
	            // $model->public_at=strtotime($model->public_at);
	            return view('admin.home.video.video.insert', [
	                'errors' =>$validate,
	                'model' => $model,
	                "category" =>$tem]);

		}
		return view("admin.home.video.video.insert",["model"=>$model,'category'=>$tem]);
	}


	function update(Video_model $model,Request $request){
		// $model = Video_model::find($id);
		
		if($model){
			$category=VideoCategory_model::where(['status'=>1,'delete'=>0])->get();
			$tem=[''=>'Danh mục '];
	        foreach($category as $cate){
	            $tem[$cate['id']]=$cate['name'];
	        }
			if ($request->isMethod('post')) {
				$inputs = Input::all();
	            $validate=$model->validate($request);
	            if(!$model->validate($request)){   
	                // $model->public_at=strtotime($model->public_at);             
	                $model_old=$model;  
                    if(History_model::updateChange(History_model::ACTION_UPDATE,'video',$model->id,$model_old,$inputs)){
                        $model->update($inputs);
                        return redirect('admin/news/');
                    }  
	                return redirect('admin/video/');
	            }
	            $model->fill($inputs);
	            
	            return view('admin.home.news.insert', [
	                'errors' =>$validate,
	                'model' => $model,
	                "category" =>$tem]);

			}
			return view("admin.home.video.video.update",["model"=>$model,'category'=>$tem]);
		}
		 return redirect('admin/video/');
	}


	function delete($id){
		$model = Video_model::find($id);
		if($model){
			$model->delete=1;
			$model->delete_at=time();
			if($model->save()){
				History_model::updateChange(History_model::ACTION_DELETE,'video',$model->id);
				return redirect('admin/video/');
				}
			}
		return redirect('admin/video/');
	}
}
