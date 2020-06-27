<?php
namespace App\Http\Controllers\backend\flight;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Model\flight\Airline_model;
use App\Http\Model\flight\Flight_model;
use App\Http\Model\history\History_model;
use App\Http\Model\flight\FlightCategory_model;
use Mail;
use App\Http\Model\site\Website_model;
class Flight_controller extends Controller{


    function index(){
        $w = Website_model::find(self::WEB);
        $model = Flight_model::where(['status'=>self::ACTIVE,'delete'=>self::NOT_ACTIVE])
        ->orderByRaw('id DESC')
        ->paginate($w->pagesize);
        $messages = Session::get('messages');
        return view("admin.home.flight.flight.index", ['model' => $model]);
    }

    function create(Request $request){
    	
    	$model=new Flight_model;
        $model->created_at = time();
        $model->time_from = time();
        $model->time_to = time();
        if($request->isMethod('post')){
            $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){                
                $tem=$model->create($inputs);
                History_model::updateChange(History_model::ACTION_CREATE,'flight',$tem->id);
                return redirect('admin/flight');
            }
            if($model->time_from){
                $model->time_from=strtotime(str_replace('/', '-', $model->time_from));
            }
            if($model->time_to){
                $model->time_to=strtotime(str_replace('/', '-', $model->timtime_toe_from));
            }
            $model->fill($inputs);
            return view('admin.home.flight.flight.insert',[
                'errors' =>$validate,
                'model' => $model,
            ]);
            
        }
    	return view("admin.home.flight.flight.insert",['model'=> $model]);
    }

    function update(Request $request,Flight_model $model){
    	$model->price=number_format($model->price);
    	$model->price_children=number_format($model->price_children);
        if($request->isMethod('post')){
            $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){                
                $tem=$model->update($inputs);
                History_model::updateChange(History_model::ACTION_UPDATE,'flight',$tem->id);
                return redirect('admin/flight/airline');
            }
            $model->fill($inputs);
            return view('admin.home.flight.flight.update',[
                'errors' =>$validate,
                'model' => $model,
            ]);
            
        }
    	return view("admin.home.flight.flight.update",['model'=> $model]);
    }

    function delete(Flight_model $model){
     	
        if($model){
            $model->delete=!self::NOT_ACTIVE;
            $model->delete_at=time();
            if($model->save()){
                History_model::updateChange(History_model::ACTION_DELETE,'flight',$model->id);
                Session::flash('messages', 'Đã xóa thành công banner'.$model->name);
               
            }
        }
        return redirect('admin/flight');

    }
 	
}   
