<?php


namespace App\Http\Controllers\frontend\home;

use App\Http\Controllers\frontend\Controller;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\album\Album_model;
use App\Http\Model\album\AlbumCategory_model;
use App\Http\Model\combo\Combo_model;
use App\Http\Model\combo\ComboTime_model;
use App\Http\Model\combo\ComboImages_model;
use App\Http\Model\combo\ComboCategory_model;
use App\Http\Model\hotel\Hotel_model;
use App\Http\Model\hotel\HotelRoom_model;
use App\Http\Model\flight\Flight_model;
use Mail;
use App\Http\Model\site\Website_model;
use Request;
use Illuminate\Support\Facades\Input;
class Combo_controller extends Controller
{
    
   	public function index(){
      $title='Combo';
      // seo
      $breadcrumb[] = ['name' => 'Combo', 'link' =>\Request::path() ];
      shareBreadcrumb($breadcrumb);
      //$this->writeHistory();
      $wb = Website_model::find(self::WEB);
      $page = $wb->page_size;
      $options=['limit'=>$page];
      $inputs = Input::all();
      if(isset($inputs['t-start'])){
        $options['time']=strtotime(str_replace('/', '-', $inputs['t-start']));
      }
      if(isset($inputs['t-end'])){
        $options['time_end']=strtotime(str_replace('/', '-', $inputs['t-start']));
      }
      $combo=Combo_model::getComboInCate(0,$options);
      $options['page']=1;
      $combo_page=Combo_model::getComboInCate(0,$options);

   		return view("view.combo.index",['title'=>$title,'combo'=>$combo,'combo_page'=>$combo_page]); 
   	}

   	public  function detail($url_seo,Combo_model $model){
      $this->writeHistory();
   		// lấy tất cả combo time của combo
   		$combotime=ComboTime_model::getAllInCombo($model->id);
   		$hotel=[];
   		$combo_time=[];
   		$flight_from=[];
   		$flight_to=[];
      $time=Request::get('time', 0);
   		if(count($combotime)){
   			$hotel=Hotel_model::getHotel($combotime[0]['hotel_id']);
   			$combo_time=$combotime[0];
   		}
      // kiểm tra có thời gian
      if($time){
        $time=ComboTime_model::find($time);
        if($time){
          $combo_time=$time;
        }
      }
     
      // redirect về k khi combo time k cò thời gian nào lớn hơn thời gian hiện tại 
   		if(!$combotime){
   			return redirect("/");
   		}
   		if($combo_time['planes_from_id']){
   			$flight_from=Flight_model::find($combo_time['planes_from_id']);
   		}
   		if($combo_time['planes_from_id']){
   			$flight_to=Flight_model::find($combo_time['planes_to_id']);
   		}
   		$hotel_room=HotelRoom_model::getRom($combo_time['hotel_room_id']);
   		$images=ComboImages_model::where(['combo_id'=>$model->id])->get();
   		// print_r($images);
   		// die();
      $breadcrumb[] = ['name' => $model->name, 'link' => url($model->link)];
      shareBreadcrumb($breadcrumb);
      return view("view.combo.detail", [
       	'model' => $model,
       	'images' => $images,
       	'hotel'=>$hotel,
       	'combotime' => $combotime,
       	'combo_time' => $combo_time,
       	'flight_from' => $flight_from,
       	'flight_to' => $flight_to,
       	'hotel_room' => $hotel_room
      ]);
   	}

    // danh mục
    public  function category($url_seo,ComboCategory_model $model){
      $this->writeHistory();
      $wb = Website_model::find(self::WEB);
      $page = $wb->page_size;
      $combo=Combo_model::getComboInCate($model->id,['limit'=>$page]);
      
      return view("view.combo.category", [
        'model' => $model,
        'combo' => $combo,
      ]);
    }
}
