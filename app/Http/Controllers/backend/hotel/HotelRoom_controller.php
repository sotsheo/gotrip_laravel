<?php


namespace App\Http\Controllers\backend\hotel;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Model\hotel\HotelRoom_model;
use App\Http\Model\history\History_model;
use App\Http\Model\hotel\HotelRoomItem_model;
use App\Http\Model\hotel\HotelRoomImages_model;
use Mail;
use App\Http\Model\site\Website_model;
class HotelRoom_controller extends Controller
{
	function index(){
		$w = Website_model::find(self::WEB);
		$model = HotelRoom_model::where(['delete'=>self::NOT_ACTIVE])
		->orderByRaw('id DESC')
		->paginate($w->pagesize);
		$messages = Session::get('messages');
		return view("admin.home.hotel.hotelroom.index", ['model' => $model]);
	}


	function create(Request $request){
		$model=new HotelRoom_model;
		$model->created_at = strtotime(date('d-m-Y'));
		$item=HotelRoomItem_model::getAll();
		if($request->isMethod('post')){
			$inputs = Input::all();

			$validate=$model->validate($request);
			if(!$model->validate($request)){                
				$tem=$model->create($inputs);
				History_model::updateChange(History_model::ACTION_CREATE,'combo',$tem->id);
				return redirect('admin/hotel/room');
			}
			$model->fill($inputs);

			return view('admin.home.hotel.hotelroom.insert',[
				'errors' =>$validate,
				'model' => $model,
				'item' => $item,
			]);

		}
		if($model->price){
			$model->price=(int)str_replace(',','',$model->price);
		}
		if($model->price_children){
			$model->price_children=(int)str_replace(',','',$model->price_children);
		}
		if($model->price_extra_bed){
			$model->price_extra_bed=(int)str_replace(',','',$model->price_extra_bed);
		}
		if($model->price_breakfast){
			$model->price_breakfast=(int)str_replace(',','',$model->price_breakfast);
		}
		if($model->price_breakfast_children){
			$model->price_breakfast_children=(int)str_replace(',','',$model->price_breakfast_children);
		}
		return view("admin.home.hotel.hotelroom.insert",['model'=> $model,'item' => $item]);
	}

	function update(Request $request,HotelRoom_model $model){
		$item=HotelRoomItem_model::getAll();
		$images=HotelRoomImages_model::getAll($model->id);
		if($request->isMethod('post')){
			$inputs = Input::all();
			if(isset($inputs['item'])){
				$item=$inputs['item'];
				if($item){
					$items='';
					foreach ($item as $key => $value) {
						$items.=' '.$value;
					}
					$model->room_item=trim($items);
				}
			}else{
				$model->room_item='';
			}
			$validate=$model->validate($request);
			if(!$model->validate($request)){                
				$tem=$model->update($inputs);
				History_model::updateChange(History_model::ACTION_UPDATE,'combo',$model->id);
				return redirect('admin/hotel/room');
			}
			$model->room_item=explode(' ', $model->room_item);

			$model->fill($inputs);
			return view('admin.home.hotel.hotelroom.update',[
				'errors' =>$validate,
				'model' => $model,
				'item' => $item,
				'images' => $images,
			]);

		}
		if($model->price){
			$model->price=number_format($model->price);
		}
		if($model->price_children){
			$model->price_children=number_format($model->price_children);
		}
		if($model->price_extra_bed){
			$model->price_extra_bed=number_format($model->price_extra_bed);
		}
		if($model->price_breakfast){
			$model->price_breakfast=number_format($model->price_breakfast);
		}
		if($model->price_breakfast_children){
			$model->price_breakfast_children=number_format($model->price_breakfast_children);
		}

		return view("admin.home.hotel.hotelroom.update",['model'=> $model,'item' => $item, 'images' => $images]);
	}

	function delete(HotelRoom_model $model){
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
				$image=new HotelRoomImages_model;
				$image->hotel_room_id=0;
				$image->path=url('upload/');
				if($id){
					$image->hotel_room_id=$id;
				}
				$image->name=$time.".".$file->getClientOriginalExtension();
				$images[]=HotelRoomImages_model::actionModel($image,$file,$time);
			}
			return json_encode($images);
		}
		return  1;
	}

	public static function removeImages(Request $request){
		if($request->isMethod('post')) {
			$id=$request->input('id');
			if(HotelRoomImages_model::actionRemove($id)){
				return $id;
			}
		}
		return  false;
	}

	public function getRoom(Request $request){
		if($request->isMethod('post')) {
			$id=$request->input('hotel_id');
			$data=HotelRoom_model::getRoom($id);
			return json_encode($data);
		}
		return  false;
	}
}   
