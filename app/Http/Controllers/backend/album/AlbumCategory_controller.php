<?php


namespace App\Http\Controllers\backend\album;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use  App\Http\Model\album\AlbumCategory_model;
use Illuminate\Support\Facades\Input;
use App\Http\Model\history\History_model;
use App\Http\Model\site\Website_model;
class AlbumCategory_controller extends Controller
{

    function index(){
         $w = Website_model::find(self::WEB);
        $messages= Session::get('messages');
        $category=AlbumCategory_model::where(['status'=>1,'delete'=>0])->paginate($w->pagesize);
        return view("admin.home.album.category.index",["category"=>$category,'messages'=>$messages]);
    }

// create
    function create(Request $request){
    	$model=new AlbumCategory_model;
       $model->date_create = strtotime(date('d-m-Y'));
       $model->orders = 0;
        if ($request->isMethod('post')) {
             $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){   
                // $model->public_at=strtotime($model->public_at);             
                $tem=$model->create($inputs);
                History_model::updateChange(History_model::ACTION_CREATE,'album_category',$tem->id);
                return redirect('admin/album_category/');
            }
            $model->fill($inputs);
            $model->public_at=strtotime($model->public_at);
            return view('admin.home.album.category.insert', [
                'errors' =>$validate,
                'model' => $model,
            ]);

        }
       return view("admin.home.album.category.insert",["model"=>$model]);
   }



    // edit
    function update(AlbumCategory_model $model,Request $request){
        if($model){
            if ($request->isMethod('post')) {
               
                 $inputs = Input::all();
                $validate=$model->validate($request);
                if(!$model->validate($request)){   
                    // $model->public_at=strtotime($model->public_at);             
                    $model_old=$model;  
                    if(History_model::updateChange(History_model::ACTION_UPDATE,'album_category',$model->id,$model_old,$inputs)){
                        $model->update($inputs);
                        return redirect('admin/album_category');
                    }  
                }
                $model->fill($inputs);
                $model->public_at=strtotime($model->public_at);
                return view('admin.home.album.category.edit', [
                    'errors' =>$validate,
                    'model' => $model
                ]);
            }
            return view("admin.home.album.category.edit",["model"=>$model]);
        }
        return redirect('/');
    }



    function delete(AlbumCategory_model $model){
        if($model){
            $model->delete=1;
            $model->delete_at=time();
            if($model->save()){
                 History_model::updateChange(History_model::ACTION_DELETE,'album_category',$model->id);
                return redirect('admin/album_category/');
            }
        }
        return redirect('/');
     }

}
