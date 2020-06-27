<?php


namespace App\Http\Controllers\backend\combo;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Model\combo\Combo_model;
use App\Http\Model\combo\ComboTime_model;
use App\Http\Model\combo\ComboImages_model;
use App\Http\Model\combo\ComboCategory_model;
use App\Http\Model\history\History_model;
use App\Http\Model\flight\Flight_model;
use App\Http\Model\flight\FlightCategory_model;
use Mail;
use App\Http\Model\site\Website_model;
class Combo_controller extends Controller
{
    function index(){
    	$w = Website_model::find(self::WEB);
        $model = Combo_model::where(['delete'=>self::NOT_ACTIVE])
        ->orderByRaw('id DESC')
        ->paginate($w->pagesize);

        $messages = Session::get('messages');
        return view("admin.home.combo.combo.index", ['model' => $model]);
    }


    function create(Request $request){
    	$model=new Combo_model;
        $category=ComboCategory_model::getArrayCategory();
        $this->showCategories($category);
        $category=$this->categorys;
        $tem=['0'=>'Danh mục combo '];
        $tem+=$category;
        if($request->isMethod('post')){
            $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){                
                $tem=$model->create($inputs);
                History_model::updateChange(History_model::ACTION_CREATE,'combo',$tem->id);
                return redirect('admin/combo');
            }
            $model->fill($inputs);
            $model->category_id=explode(' ',$model->category_id);
            return view('admin.home.combo.combo.insert',[
                'errors' =>$validate,
                'model' => $model,
                'category' => $category,
            ]);
            
        }
        return view("admin.home.combo.combo.insert",[
            'model'=> $model,
            'category'=> $category
        ]);
    }

    function update(Request $request,Combo_model $model){
        $combotime=ComboTime_model::getAll($model->id);
        $images=ComboImages_model::getAll($model->id);
        if($request->isMethod('post')){
            $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){                
                $tem=$model->update($inputs);
                History_model::updateChange(History_model::ACTION_UPDATE,'combo',$model->id);
                return redirect('admin/combo');
            }
            $model->fill($inputs);
            return view('admin.home.combo.combo.update',[
                'errors' =>$validate,
                'model' => $model,
                'combotime' => $combotime,
                'images' => $images,
            ]);
            
        }
        $category=ComboCategory_model::getArrayCategory();
        $this->showCategories($category);
        $category=$this->categorys;
        $tem=['0'=>'Danh mục combo '];
        $tem+=$category;
        $model->category_id=explode(' ',$model->category_id);
        return view("admin.home.combo.combo.update",[
            'model'=> $model, 
            'combotime' => $combotime,
            'images' => $images,
            'category' => $category
        ]);
    }

    function delete(Combo_model $model){
        if($model){
            $model->delete=!self::NOT_ACTIVE;
            $model->delete_at=time();
            if($model->save()){
                History_model::updateChange(History_model::ACTION_DELETE,'combo',$model->id);
                Session::flash('messages', 'Đã xóa thành công banner'.$model->name);

            }
        }
        return redirect('admin/combo');

    }

    public static function uploadImages(Request $request){
       if($request->isMethod('post')) {
            $id=$request->input('id');
                for($i=0;$i<$request->input('count');$i++){
                   $file=$request->file('file'.$i);
                   $time = time();
                   $image=new ComboImages_model;
                   $image->combo_id=0;
                   $image->path=url('upload/');
                   if($id){
                       $image->combo_id=$id;
                   }
                   $image->name=$time.".".$file->getClientOriginalExtension();
                   $images[]=ComboImages_model::actionModel($image,$file,$time);
                }
                return json_encode($images);
        }
         return  1;
    }

        public static function removeImages(Request $request){
            if($request->isMethod('post')) {
                $id=$request->input('id');
                if(ComboImages_model::actionRemove($id)){
                    return $id;
                }
            }
            return  false;
        }

        
}   
