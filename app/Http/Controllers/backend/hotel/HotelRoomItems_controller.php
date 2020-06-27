<?php


namespace App\Http\Controllers\backend\hotel;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Model\hotel\Hotel_model;
use App\Http\Model\hotel\HotelRoomItem_model;
use App\Http\Model\history\History_model;

use Mail;
use App\Http\Model\site\Website_model;
class HotelRoomItems_controller extends Controller{
    
	 function index(){
        $w = Website_model::find(self::WEB);
        $model = HotelRoomItem_model::where(['delete'=>self::NOT_ACTIVE])
        ->orderByRaw('id DESC')
        ->paginate($w->pagesize);

        $messages = Session::get('messages');
        return view("admin.home.hotel.hotelroomitems.index", ['model' => $model]);
    }


    function create(Request $request){
    	$model=new HotelRoomItem_model;
        $model->created_at = time();
        if($request->isMethod('post')){
            $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){                
                $tem=$model->create($inputs);
                History_model::updateChange(History_model::ACTION_CREATE,'hotel_room_items',$tem->id);
                return redirect('admin/hotel/room/items');
            }
            $model->fill($inputs);
            $model->category_id=explode(' ',$model->category_id);
            return view('admin.home.hotel.hotelroomitems.insert',[
                'errors' =>$validate,
                'model' => $model,
            ]);
            
        }
    	return view("admin.home.hotel.hotelroomitems.insert",['model'=> $model]);
    }

    function update(Request $request,HotelRoomItem_model $model){
        if($request->isMethod('post')){
            $inputs = Input::all();

            $validate=$model->validate($request);
            if(!$model->validate($request)){                
                $tem=$model->update($inputs);
                History_model::updateChange(History_model::ACTION_UPDATE,'hotel_room_items',$model->id);
                 return redirect('admin/hotel/room/items');
            }
            $model->fill($inputs);
            return view('admin.home.hotel.hotelroomitems.update',[
                'errors' =>$validate,
                'model' => $model,
            ]);
            
        }
        $model->category_id=explode(' ',$model->category_id);
    	return view("admin.home.hotel.hotelroomitems.update",['model'=> $model]);
    }
 	
     function delete(HotelRoomItem_model $model){
        if($model){
            $model->delete=!self::NOT_ACTIVE;
            $model->delete_at=time();
            if($model->save()){
                History_model::updateChange(History_model::ACTION_DELETE,'hotel_room_items',$model->id);
                Session::flash('messages', 'Đã xóa thành công banner'.$model->name);
               
            }
        }
         return redirect('admin/hotel/room/items');

    }
}   
