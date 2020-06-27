<?php


namespace App\Http\Controllers\backend\flight;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\flight\Airline_model;
use App\Http\Model\flight\Flight_model;
use App\Http\Model\flight\FlightCategory_model;
use Illuminate\Support\Facades\Input;

use Mail;

class FlightCategory_controller extends Controller
{
    function index(){
    	$model = FlightCategory_model::where(['status'=>self::ACTIVE,'delete'=>self::NOT_ACTIVE])
        ->orderByRaw('id DESC')
        ->paginate(10);
        $messages = Session::get('messages');
        return view("admin.home.flight.flightcategory.index", ['model' => $model]);
    }

 	
}   
