<?php


namespace App\Http\Controllers\backend\hotel;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Model\hotel\Hotel_model;
use App\Http\Model\hotel\HotelItem_model;
use App\Http\Model\history\History_model;

use Mail;
use App\Http\Model\site\Website_model;
class HotelItems_controller extends Controller
{
	 function index(){
        $w = Website_model::find(self::WEB);
        $model = HotelItem_model::where(['delete'=>self::NOT_ACTIVE])
        ->orderByRaw('id DESC')
        ->paginate($w->pagesize);

        $messages = Session::get('messages');
        return view("admin.home.hotel.hotelitems.index", ['model' => $model]);
    }


    function create(Request $request){
    	$model=new HotelItem_model;
        $model->created_at = strtotime(date('d-m-Y'));
        if($request->isMethod('post')){
            $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){                
                $tem=$model->create($inputs);
                History_model::updateChange(History_model::ACTION_CREATE,'hotel_items',$tem->id);
                return redirect('admin/hotel/items');
            }
            $model->fill($inputs);
            $model->category_id=explode(' ',$model->category_id);
            return view('admin.home.hotel.hotelitems.insert',[
                'errors' =>$validate,
                'model' => $model,
            ]);
            
        }
    	return view("admin.home.combo.combo.insert",['model'=> $model]);
    }

    function update(Request $request,HotelItem_model $model){
        if($request->isMethod('post')){
            $inputs = Input::all();

            $validate=$model->validate($request);
            if(!$model->validate($request)){                
                $tem=$model->update($inputs);
                History_model::updateChange(History_model::ACTION_UPDATE,'hotel_items',$model->id);
                return redirect('admin/hotel/items');
            }
            $model->fill($inputs);
            return view('admin.home.hotel.hotelitems.update',[
                'errors' =>$validate,
                'model' => $model,
            ]);
            
        }
        $model->category_id=explode(' ',$model->category_id);
    	return view("admin.home.hotel.hotelitems.update",['model'=> $model]);
    }
 	
     function delete(HotelItem_model $model){
        if($model){
            $model->delete=!self::NOT_ACTIVE;
            $model->delete_at=time();
            if($model->save()){
                History_model::updateChange(History_model::ACTION_DELETE,'hotel_items',$model->id);
                Session::flash('messages', 'Đã xóa thành công banner'.$model->name);
               
            }
        }
        return redirect('admin/hotel/items');

    }
}   
