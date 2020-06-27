<?php


namespace App\Http\Controllers\backend\product;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\product\Manufacturer_model;
use Illuminate\Support\Facades\Input;
use App\Http\Model\history\History_model;
class Manufacturer_controller extends Controller
{

    function index(){

        $messages= Session::get('messages');
        $manufacturer=Manufacturer_model::where(['status'=>1,'delete'=>0])->paginate(10);
        return view("admin.home.manufacturer.index",['manufacturer'=>$manufacturer,'messages'=>$messages]);
    }


    function create(Request $request){
        $model=new Manufacturer_model;
        $model->date_create = strtotime(date('d-m-Y'));
        if ($request->isMethod('post')) {
            $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){              
                $tem=$model->create($inputs);
                History_model::updateChange(History_model::ACTION_CREATE,'manufacturer',$tem->id);
                return redirect('admin/manufacturer/');
            }
            $model->fill($inputs);
            // $model->public_at=strtotime($model->public_at);
            return view('admin.home.manufacturer.insert', [
                'errors' =>$validate,
                'model' => $model
            ]);
        }
        return view("admin.home.manufacturer.insert",['model'=>$model]);
    }


    function update(Manufacturer_model $model,Request $request){
        if($model){
            if ($request->isMethod('post')) {
                $inputs = Input::all();
                $validate=$model->validate($request);
                if(!$model->validate($request)){              
                    $model_old=$model;  
                    if(History_model::updateChange(History_model::ACTION_UPDATE,'manufacturer',$model->id,$model_old,$inputs)){
                        $model->update($inputs);
                        return redirect('admin/manufacturer/');
                    }  
                }
                $model->fill($inputs);
                // $model->public_at=strtotime($model->public_at);
                return view('admin.home.manufacturer.insert', [
                    'errors' =>$validate,
                    'model' => $model
                ]);
            }
            return view("admin.home.manufacturer.update",['model'=>$model]);
        }
        return redirect('admin/manufacturer/');
    }

 

    function delete(Manufacturer_model $model){
        if($model){
            $name=$model->name;
            $model->delete=1;
            if($model->save()){
                History_model::updateChange(History_model::ACTION_DELETE,'manufacturer',$model->id);
                Session::flash('messages', 'Đã chỉnh sửa thành công thành công hãng sản xuất'.$name);
            }
            return redirect('admin/manufacturer/');
        }
        return redirect('admin/manufacturer/');
    }
    static function get_Manufacturer(){

        $model=Manufacturer_model::all();
        return $model;
    }
}
