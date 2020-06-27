<?php


namespace App\Http\Controllers\backend\hotel;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Model\hotel\Hotel_model;
use App\Http\Model\history\History_model;
use App\Http\Model\hotel\HotelItem_model;
use App\Http\Model\hotel\HotelImages_model;
use App\Http\Model\hotel\HotelAddress_model;
use Mail;
use App\Http\Model\site\Website_model;
class Hotel_controller extends Controller{
    
    function index(){
    	 $w = Website_model::find(self::WEB);
        $model = Hotel_model::where(['delete'=>self::NOT_ACTIVE])
        ->orderByRaw('id DESC')
        ->paginate($w->pagesize);
        $messages = Session::get('messages');
        return view("admin.home.hotel.hotel.index", ['model' => $model]);
    }


    function create(Request $request){
    	$model=new Hotel_model;
        $model->created_at = strtotime(date('d-m-Y'));
        $item=HotelItem_model::getAll();
        if($request->isMethod('post')){
            $inputs = Input::all();
           
            $validate=$model->validate($request);
            if(!$model->validate($request)){                
                $tem=$model->create($inputs);
                History_model::updateChange(History_model::ACTION_CREATE,'combo',$tem->id);
                return redirect('admin/hotel/');
            }
            $model->fill($inputs);
            $model->category_id=explode(' ',$model->category_id);
            return view('admin.home.hotel.hotel.insert',[
                'errors' =>$validate,
                'model' => $model,
                'item' => $item,
            ]);
            
        }
    	return view("admin.home.hotel.hotel.insert",['model'=> $model,'item' => $item]);
    }

    function update(Request $request,Hotel_model $model){
        $item=HotelItem_model::getAll();
        $images=HotelImages_model::getAll($model->id);
        if($request->isMethod('post')){
            $inputs = Input::all();
            if(isset($inputs['item'])){
                $item=$inputs['item'];
                if($item){
                    $items='';
                    foreach ($item as $key => $value) {
                        $items.=' '.$value;
                    }
                    $model->hotel_item_list=trim($items);
                }
            }else{
               $model->hotel_item_list='';
            }
            $validate=$model->validate($request);
            $from=$request->input('from');
            $to=$request->input('to');
            $km=$request->input('km');
            $name=$request->input('name_address');
            if($from && $to && $km){
                    for($i=0;$i<count($from);$i++){
                        if(isset($name[$i]) && isset($from[$i]) && isset($to[$i]) && isset($km[$i])){
                            // tìm kiếm xem đã có dữ liệu của nó chưa 
                        $tem=HotelAddress_model::where([
                                'name'=>$name[$i],
                                'hotel_id'=>$model->id,
                            ])->first();
                        $tem_old=$tem;
                        if(!$tem){
                            $tem=new HotelAddress_model();
                            $tem->name=$name[$i];
                            $tem->hotel_id=$model->id;
                            $tem_old=[];
                        }
                        $tem->address_from=$from[$i];
                        $tem->address_to=$to[$i];
                        $tem->number_km=str_replace('km', '', $km[$i]);

                        $tem->save();
                      
                       
                    }
                }
                
            }
            if(!$model->validate($request)){    
               
                $tem=$model->update($inputs);
                
                History_model::updateChange(History_model::ACTION_UPDATE,'hotel',$model->id);
                return redirect('admin/hotel');
            }
            $model->hotel_item_list=explode(' ', $model->hotel_item_list);
            $model->fill($inputs);
            return view('admin.home.hotel.hotel.update',[
                'errors' =>$validate,
                'model' => $model,
                'item' => $item,
                'images' => $images,
            ]);
            
        }
        $model->category_id=explode(' ',$model->category_id);
    	return view("admin.home.hotel.hotel.update",['model'=> $model,'item' => $item, 'images' => $images]);
    }
 	
     function delete(Hotel_model $model){
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
                 $image=new HotelImages_model;
                 $image->hotel_id=0;
                 $image->path=url('upload/');
                 if($id){
                     $image->hotel_id=$id;
                 }
                 $image->name=$time.".".$file->getClientOriginalExtension();
                 $images[]=HotelImages_model::actionModel($image,$file,$time);
             }
             return json_encode($images);
         }
         return  1;
     }

    public static function removeImages(Request $request){
        if($request->isMethod('post')) {
            $id=$request->input('id');
            if(HotelImages_model::actionRemove($id)){
                return $id;
            }
        }
        return  false;
    }

    public function removeKm(Request $request) {
        if($request->isMethod('GET')) {
            $id = $request->input('id');
            $image = HotelAddress_model::find($id);
            if ($image->delete()) {
                return ['code' => 200];
            }
        }
    }
    public function getKm(Request $request) {
        if($request->isMethod('GET')) {
            $to = $request->input('to');
            $from = $request->input('from');
            if($to && $from){
                $k=$this->getDistance($from.',Viet Nam',$to.',Viet Nam','K');
                if($k){
                    return [
                        'code' => 200,
                        'messages' => $k
                    ];
                }
            }

            return [
                'code' => 400,
                'messages' => ''
            ];
        }

    }

    function getDistance($addressFrom, $addressTo, $unit = ''){
        // Google API key
        $apiKey = 'AIzaSyCKvjzNMRjHBxc3itgqBfsldV8mg6Ixv5c';
        
        // Change address format
        $formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
        $formattedAddrTo     = str_replace(' ', '+', $addressTo);
        
        // Geocoding API request with start address
        $geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false&key='.$apiKey);
        $outputFrom = json_decode($geocodeFrom);
        if(!empty($outputFrom->error_message)){
            return $outputFrom->error_message;
        }
        
        // Geocoding API request with end address
        $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false&key='.$apiKey);
        $outputTo = json_decode($geocodeTo);
        if(!empty($outputTo->error_message)){
            return $outputTo->error_message;
        }
        
        // Get latitude and longitude from the geodata
        $latitudeFrom    = $outputFrom->results[0]->geometry->location->lat;
        $longitudeFrom    = $outputFrom->results[0]->geometry->location->lng;
        $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
        $longitudeTo    = $outputTo->results[0]->geometry->location->lng;
        
        // Calculate distance between latitude and longitude
        $theta    = $longitudeFrom - $longitudeTo;
        $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
        $dist    = acos($dist);
        $dist    = rad2deg($dist);
        $miles    = $dist * 60 * 1.1515;
        
        // Convert unit and return distance
        $unit = strtoupper($unit);
        if($unit == "K"){
            return round($miles * 1.609344, 2).' km';
        }elseif($unit == "M"){
            return round($miles * 1609.344, 2).' meters';
        }else{
            return round($miles, 2).' miles';
        }
    }
}   
