<?php


namespace App\Http\Controllers\backend\album;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\album\Album_model;
use App\Http\Model\album\AlbumCategory_model;
use App\Http\Model\album\AlbumImg_model;
use Illuminate\Support\Facades\Input;
use App\Http\Model\history\History_model;
use App\Http\Model\site\Website_model;
class Album_controller extends Controller
{

	function index(){
		 $w = Website_model::find(self::WEB);
		$messages= Session::get('messages');
		$model=Album_model::where(['status'=>1,'delete'=>0])->paginate($w->pagesize);
		$category=AlbumCategory_model::get();
		return view("admin.home.album.album.index",["category"=>$category,"model"=>$model,'messages'=>$messages]);
	}

// create
	function create(Request $request){
		$model=new Album_model;
		$model->date_create = strtotime(date('d-m-Y'));
		$model->orders = 0;
		$category=AlbumCategory_model::get();
		$tem=[0=>'Danh mục '];
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
                return redirect('admin/album/');
            }
            $model->fill($inputs);
            $model->public_at=strtotime($model->public_at);
            return view('admin.home.album.album.insert', [
                'errors' =>$validate,
                'model' => $model,
                "category" =>$tem]);

			
		}
		return view("admin.home.album.album.insert",["model"=>$model,'category'=>$tem]);
	}

	

	function update(Album_model $model,Request $request){
		if($model){
			$category=AlbumCategory_model::get();
			$images=AlbumImg_model::orderByRaw('orders ASC,id DESC')->where('id_album',$model->id)->get();
			$tem=[0=>'Danh mục '];
	        foreach($category as $cate){
	            $tem[$cate['id']]=$cate['name'];
	        }
			if ($request->isMethod('post')) {
				$inputs = Input::all();
	            $validate=$model->validate($request);
	            if(!$model->validate($request)){   
	                // $model->public_at=strtotime($model->public_at);             
	                $model_old=$model;  
                    if(History_model::updateChange(History_model::ACTION_UPDATE,'album',$model->id,$model_old,$inputs)){
                        $model->update($inputs);
                        return redirect('admin/news/');
                    }  
	                return redirect('admin/album/');
	            }
	            $model->fill($inputs);
	            $model->public_at=strtotime($model->public_at);
	            return view('admin.home.album.album.update', [
	                'errors' =>$validate,
	                'model' => $model,
	                "category" =>$tem]);
			}
			return view("admin.home.album.album.update",["model"=>$model,'category'=>$tem, 'images'=>$images]);
		}
		return redirect('admin/album/');
	}

	function delete(Album_model $model){
		
		if ($model) {
			$name = $model->name;
			$model->delete=1;
			$model->delete_at=time();
			if ($model->save()) {
				 History_model::updateChange(History_model::ACTION_DELETE,'album',$model->id);
				$list_img=Album_model::where('id', $model->id)->get();
				if($list_img){
					foreach($list_img as $img){
						AlbumImg_model::actionRemove($img->id);
					}
				}
				
				Session::flash('messages', 'Đã xóa thành công sản phẩm' . $name);
				
			}
			return redirect('admin/album/');
		}
		return redirect('admin/album/');
	}

	public static function uploadFileAlbum(Request $request){
		if($request->isMethod('post')) {
			$id=$request->input('id');
			for($i=0;$i<$request->input('count');$i++){
				$file=$request->file('file'.$i);
				$time = strtotime(date("d-m-Y h:i:s"));
				$image=new AlbumImg_model;
				$image->id_album=0;
				$image->img_path=url('upload/');

				if(isset($id) && $id!=0){
					$image->id_album=$id;
				}

				$image->img_name=$time.".".$file->getClientOriginalExtension();
				$images[]=AlbumImg_model::actionModel($image,$file,$time);
			}
			return json_encode($images);
		}
		return  1;
	}

	public static function removeFileAlbum(Request $request){
		if($request->isMethod('post')) {
			$id=$request->input('id');
			if(AlbumImg_model::actionRemove($id)){
				return $id;
			}
		}
		return  false;
	}
}
