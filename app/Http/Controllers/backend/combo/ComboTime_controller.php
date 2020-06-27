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
use App\Http\Model\history\History_model;
use App\Http\Model\hotel\HotelRoom_model;
use App\Http\Model\flight\Flight_model;
use App\Http\Model\flight\FlightCategory_model;
use Mail;

class ComboTime_controller extends Controller
{

	function create(Request $request,Combo_model $model){
		$combotime=new ComboTime_model;
		$combotime->time_start = time();
		$hotel_room=HotelRoom_model::getRoom($model->hotel_id);
		if($request->isMethod('post')){
			$inputs = Input::all();
			$request['combo_id']=$model->id;
			$validate=$combotime->validate($request);
			// var_dump($model);
			// die();
			if(!$combotime->validate($request)){     
				$inputs['combo_id']=$model->id;           
				$tem=$combotime->create($inputs);
				History_model::updateChange(History_model::ACTION_CREATE,'combo_time',$tem->id);
				return redirect('admin/combo/update'.'/'.$model->id);
			}
			$combotime->time_start=strtotime($combotime->time_start);
			$combotime->fill($inputs);
			$combotime->time_start=strtotime($combotime->time_start);
			$combotime->category_id=explode(' ',$combotime->category_id);
			$combotime->price=number_format($combotime->price);
			$combotime->price_sale=number_format($combotime->price_sale);
			$combotime->price_children=number_format($combotime->price_children);
			$combotime->price_sale_v2=number_format($combotime->price_sale_v2);
			return view('admin.home.combo.combotime.insert',[
				'errors' =>$validate,
				'model' => $combotime,
				'hotel_room' => $hotel_room,
			]);

		}
		$combotime->category_id=explode(' ',$combotime->category_id);
		$combotime->price=number_format($combotime->price);
		$combotime->price_sale=number_format($combotime->price_sale);
		$combotime->price_children=number_format($combotime->price_children);
		$combotime->price_sale_2=number_format($combotime->price_sale_2);
		return view("admin.home.combo.combotime.insert",['model'=> $combotime,'hotel_room' => $hotel_room,]);
	}

	function update(Request $request,ComboTime_model $model){
		$hotel_room=HotelRoom_model::getRoom( $model->hotel_id);
		if($request->isMethod('post')){
			$inputs = Input::all();
			$request['combo_id']= $model->combo_id; 
			$validate=$model->validate($request);
			if(!$model->validate($request)){       
				$tem=$model->update($inputs);
				History_model::updateChange(History_model::ACTION_UPDATE,'combo_time',$model->id);
				return redirect('admin/combo/update'.'/'.$model->combo_id);
			}
			$model->fill($inputs);
			$model->time_start=strtotime($model->time_start);
			return view('admin.home.combo.combotime.update',[
				'errors' =>$validate,
				'model' => $model,
				'hotel_room' => $hotel_room,
			]);

		}
		$model->category_id=explode(' ',$model->category_id);
		$model->price=number_format($model->price);
		$model->price_sale=number_format($model->price_sale);
		$model->price_children=number_format($model->price_children);
		$model->price_sale_2=number_format($model->price_sale_2);
		return view("admin.home.combo.combotime.update",['model'=> $model,'hotel_room'=> $hotel_room]);
	}

	function delete(combo_time $model){
		if($model){
			$model->delete=!self::NOT_ACTIVE;
			$model->delete_at=time();
			if($model->save()){
				History_model::updateChange(History_model::ACTION_DELETE,'combo_time',$model->id);
				Session::flash('messages', 'Đã xóa thành công banner'.$model->name);

			}
		}
		return redirect('admin/combo/time');
	}


}   
