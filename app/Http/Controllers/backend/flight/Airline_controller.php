<?php


namespace App\Http\Controllers\backend\flight;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Model\flight\Airline_model;
use App\Http\Model\history\History_model;
use App\Http\Model\flight\Flight_model;
use App\Http\Model\flight\FlightCategory_model;
use App\Http\Model\site\Website_model;
use Mail;

class Airline_controller extends Controller
{
    function index(){
    	$w = Website_model::find(self::WEB);
        $model = Airline_model::where(['delete'=>self::NOT_ACTIVE])
        ->orderByRaw('id DESC')
        ->paginate($w->pagesize);
        $messages = Session::get('messages');
        return view("admin.home.flight.airline.index", ['model' => $model]);
    }


    function create(Request $request){
    	$model=new Airline_model;
        $model->created_at = strtotime(date('d-m-Y'));
        if($request->isMethod('post')){
            $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){                
                $tem=$model->create($inputs);
                History_model::updateChange(History_model::ACTION_CREATE,'airline',$tem->id);
                return redirect('admin/flight/airline');
            }
            $model->fill($inputs);
            return view('admin.home.flight.airline.insert',[
                'errors' =>$validate,
                'model' => $model,
            ]);
            
        }
    	return view("admin.home.flight.airline.insert",['model'=> $model]);
    }

    function update(Request $request,Airline_model $model){
        if($request->isMethod('post')){
            $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){                
                $tem=$model->update($inputs);
                History_model::updateChange(History_model::ACTION_UPDATE,'airline',$model->id);
                return redirect('admin/flight/airline');
            }
            $model->fill($inputs);
            return view('admin.home.flight.airline.update',[
                'errors' =>$validate,
                'model' => $model,
            ]);
            
        }
    	return view("admin.home.flight.airline.update",['model'=> $model]);
    }
 	
     function delete(Airline_model $model){
        if($model){
            $model->delete=!self::NOT_ACTIVE;
            $model->delete_at=time();
            if($model->save()){
                History_model::updateChange(History_model::ACTION_DELETE,'airline',$model->id);
                Session::flash('messages', 'Đã xóa thành công banner'.$model->name);
               
            }
        }
        return redirect('admin/banner/airline');

    }
}   
