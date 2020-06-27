<?php


namespace App\Http\Controllers\backend\combo;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Model\combo\Combo_model;
use App\Http\Model\history\History_model;
use App\Http\Model\combo\ComboCategory_model;
use App\Http\Model\flight\FlightCategory_model;
use Mail;
use App\Cl\ClCategory;
use App\Http\Model\site\Website_model;
class ComboCategory_controller extends Controller
{
    function index(){
    	$w = Website_model::find(self::WEB);
        $model = ComboCategory_model::where(['delete'=>ClCategory::NOT_ACTIVE])
        ->orderByRaw('id DESC')
        ->paginate($w->pagesize);
        $this->sortArrays($model);
        $category=$this->sorts;
        $messages = Session::get('messages');
        return view("admin.home.combo.combocategory.index", ['model' => $model,'category' => $category]);
    }


    function create(Request $request){
    	$model=new ComboCategory_model;
        $model->created_at = time();
        $category=ComboCategory_model::getArrayCategory();
        $this->showCategories($category);
        $category=$this->categorys;
        $tem=['0'=>'Danh mục cha '];
        $tem+=$category;
        if($request->isMethod('post')){
            $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){                
                $tem=$model->create($inputs);
                History_model::updateChange(History_model::ACTION_CREATE,'combo_category',$tem->id);
                return redirect('admin/combo/category');
            }
            $model->fill($inputs);
            return view('admin.home.combo.combocategory.insert',[
                'errors' =>$validate,
                'model' => $model,
            ]);
        }
    	return view("admin.home.combo.combocategory.insert",['model'=> $model,'category'=> $tem]);
    }

    function update(Request $request,ComboCategory_model $model){
        $category=ComboCategory_model::getArrayCategory($model->id);
        $this->showCategories($category);
        $category=$this->categorys;
        $tem=['0'=>'Danh mục cha '];
        $tem+=$category;
        if($request->isMethod('post')){
            $inputs = Input::all();
            $validate=$model->validate($request);
           
            if(!$model->validate($request)){                
                $tem=$model->update($inputs);
                History_model::updateChange(History_model::ACTION_UPDATE,'combo_category',$model->id);
                return redirect('admin/combo/category');
            }
            $model->fill($inputs);
            return view('admin.home.combo.combocategory.update',[
                'errors' =>$validate,
                'model' => $model,
                'category'=> $tem
            ]);
            
        }
    	return view("admin.home.combo.combocategory.update",['model'=> $model,'category'=> $tem]);
    }
 	
     function delete(ComboCategory_model $model){
        if($model){
            $model->delete=!ClCategory::NOT_ACTIVE;
            $model->delete_at=time();
            if($model->save()){
                History_model::updateChange(History_model::ACTION_DELETE,'combo_category',$model->id);
                Session::flash('messages', 'Đã xóa thành công banner'.$model->name);
               
            }
        }
        return redirect('admin/combo/category');

    }
}   
