<?php

namespace App\Http\Controllers\frontend\home;

use App\Http\Controllers\frontend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\combo\ComboOrder_model;
use App\Http\Model\combo\ComboOrderItems_model;
use App\Http\Model\combo\Combo_model;
use App\Http\Model\combo\ComboTime_model;
use App\Http\Model\hotel\Hotel_model;
use App\Http\Model\hotel\HotelRoom_model;
use App\Http\Model\flight\Flight_model;
use App\Http\Model\product\Product_model;
use App\Http\Model\code\Code_model;
use App\Http\Model\code\CodeItem_model;
use Mail;
use App\Http\Model\site\Website_model;
use Illuminate\Support\Facades\Input;
/**
 * ProductController implements the CRUD actions for Product model.
 */
class ComboOrder_Controller extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

   

    public function order(Combo_model $model,ComboTime_model $cbtime,Request $request){
        
        // tạo order cho item đó 

        $qty=$request->get('qty',1);
        $time=60*60*24*30;
		
       
        $people=(Product_model::getCookie('people'))?Product_model::getCookie('people'):2;
        $child=(Product_model::getCookie('child'))?Product_model::getCookie('child'):0;
        
        if($cbtime){
            $data=[];
            $order=[];
            $order['people']=$people;
            $order['hotel_room_id']=$cbtime->hotel_room_id;
            $order['planes_from_id']=$cbtime->planes_from_id;
            $order['planes_to_id']=$cbtime->planes_to_id;
            // $order['number_of_people']=$session['count'];
            $order['children']=$child;
            $order['combo_time']=$cbtime['id'];
            $order['order_bed']=$request->get('bed',0);
            // $order['time']=$request->get('bed',0);
            if($request->get('room')){
                // kiểm tra xem room này có thuộc khách sạn này k 
                $hotel_room=HotelRoom_model::where(['id'=>$request->get('room'),'hotel_id'=>$time->hotel_id])->first();
                if($hotel_room){
                    $order['hotel_room_id']=$hotel_room->id;
                }
            }
            $data[$model->id]=$order;  
            //}
            Product_model::setCookie(Combo_model::ORDER,json_encode($data),$time);
            $data=Product_model::getCookie(Combo_model::ORDER);
            if($data){
                return redirect('/order.html');
            }
        }  
        return redirect('/');
    }

   

    public function index(Request $request){

        $combos=[];
        $price=0;
        $price_market=0;
        $data=Product_model::getCookie(Combo_model::ORDER);
        $price_children=0;
        $price_bed=0;
        $price_breakfast=0;
        $price_sale_children=0;
        $price_total=0;
        if(!$data){
            return redirect('/');
        }
        if($data){

            foreach($data as $key=>$val){
                $tem=[];
                $combo=Combo_model::find($key);
                if($combo){
                    $combo_time=ComboTime_model::find($val->combo_time);
                    $tem['time']=$combo_time;
                    $tem['people']=$val->people;
                    $tem['children']=$val->children;
                    $tem['time']=$combo_time;
                    $tem['combo']=$combo;
                    $tem['price']=$combo_time->price_sum;
                    $tem['price']+=($combo_time->price_type==Combo_model::TYPE_1)?$combo_time->price_sale_1:$combo_time->price_sale;
                    $hotel_room=HotelRoom_model::find($val->hotel_room_id);
                    $hotel=Hotel_model::find($hotel_room->hotel_id);
                    $tem['hotel_room']=$hotel_room;
                    $tem['hotel']=$hotel;
                    $price_children=$combo_time->price_children;
                    $price_sale_children=$combo_time->price_sale_2;
                    if($combo_time->type_combo==Combo_model::TYPE_2){
                        $price_children=0;
                        if($combo_time->hotel_room_id!=$val->hotel_room_id){
                            $room_tem=HotelRoom_model::find($combo_time->hotel_room_id);
                            if($room_tem){
                                $tem['price']-=$room_tem->price/2;
                                $tem['price']+=$hotel_room->price/2;
                            }
                        }
                        if($combo_time->planes_from_id){

                            $planes_from_id=Flight_model::find($combo_time->planes_from_id);
                            $planes_from_id->province_id_from=Province::getNamebyId($planes_from_id->province_id_from);
                            $planes_from_id->province_id_to=Province::getNamebyId($planes_from_id->province_id_to);
                            $tem['planes_from']= $planes_from_id;
                           
                        }
                        if($combo_time->planes_to_id){
                            $planes_to_id=Flight_model::find($combo_time->planes_to_id);
                            $planes_to_id->province_id_from=Province::getNamebyId($planes_to_id->province_id_from);
                            $planes_to_id->province_id_to=Province::getNamebyId($planes_to_id->province_id_to);
                            $tem['planes_to']= $planes_to_id;                        
                        }
                        //print_r($hotel_room);
                        $price_children+=$hotel_room->price_children;
                        if($combo_time->planes_to_id){
                            $price_children+=$planes_to_id->price_children;
                        }
                        if($combo_time->planes_from_id){
                            $price_children+=$planes_from_id->price_children;
                        }
                    }
                    $price=$tem['price'];
                    $price_sale=$combo_time->price_sale;
                    // tính giám giảm khi đây là tính %
                    $price_total=$price;
                    // $price_sale_root=$combo->price_sale;
                    // print_r($combo->id);
                    if($combo_time->type_combo==Combo_model::TYPE_2){
                        if($val->order_bed && $hotel_room->extra_bed){
                            $price_bed+=$hotel_room->price_extra_bed;
                            $price_total+=$price_bed;
                        }
                        if( $hotel_room->breakfast){
                            $price_breakfast+=$hotel_room->price_breakfast;
                            if($val->people){
                               $price_breakfast*=(int)$val->people;
                            }
                            if($val->children){
                                $price_breakfast+=$hotel_room->price_breakfast_children*(int)$val->children;
                            }
                           // $price_children+=$hotel_room->price_breakfast_children;
                        }
                    }
                    if($val->people){
                        $price_total=$price_total*(int)$val->people;
                    }
                    if($val->children){
                        $price_total+=$price_children*(int)$val->children;
                    }
                    // print_r($price_total);
                    if($combo_time->price_type==Combo_model::TYPE_1){
                        $price_sale=(($price_total*$combo_time->price_sale)/100);
                        $price_sale_children=0;
                        // $price_sale_root=$combo->price_sale_1;
                    }else{
                        $price_sale*=(int)$val->people;
                        $price_sale_children*=(int)$val->children;
                        $price_sale+=$price_sale_children;
                    }
                    $price_total+=$price_breakfast;
                    $price_total=$price_total-$price_sale;
  
                }
                $combos=$tem;
            }
        }
        $model=new ComboOrder_model();

        if($request->isMethod('post')){
            $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$validate){
                $inputs['combo_id']=$combos['combo']['id'];
                $tem=$model->create($inputs);

                if($tem->id){
                    $item=new ComboOrderItems_model;
                    $item->hotel_id=$combos['hotel']['id'];
                    $item->price_breakfast=$price_breakfast;
                    $item->hotel_room_id=$combos['hotel_room']['id'];
                    $item->number_of_people=$combos['people'];
                    $item->number_of_people_children=$combos['children'];
                    $item->order_id=$tem->id;
                    $item->price_room_hotel=$combos['hotel_room']['price'];
                    $item->price_room_hotel_children=$combos['hotel_room']['price_children'];
                    if($combo_time->type_combo==Combo_model::TYPE_2){
                        if($combo_time->planes_from_id){
                            
                            $item->price_plances_from=$combos['planes_from']['price'];
                            $item->price_plances_from_children=$combos['planes_from']['price_children'];
                        }
                        if($combo_time->planes_to_id){
                            $item->price_plances_to=$combos['planes_to']['price'];
                            $item->price_plances_to_children=$combos['planes_to']['price_children'];
                        }
                    }
                    $item->price_sale=$price_sale;
                    $item->price_children=$price_children;
                    $item->price_people=$combos['combo']['price_sum']*$combos['people'];
                    $item->type_combo=$combos['combo']['type_combo'];
                    $item->price_sale_children=$price_sale_children;
                    $item->combo_time=$combos['time']['id'];
                    $item->combo_id=$combos['combo']['id'];
                    $tem->price_all=$price_total;
                    $tem->code_order=$tem->id.$this->generateRandomString(5);
                    $tem->ip=getIP();
                    if(Product_model::getCookie('codecombo')){
                       
                        $tem->code=Product_model::getCookie('codecombo')->key;
                        $code=CodeItem_model::where(['key'=>$tem->code])
                        ->first();
                        $code->use_time=time();
                        $code->save();
                        Product_model::setCookie('codecombo','');
                    }
                    if($item->save() &&  $tem->save()){
                         return redirect('/order_'.$tem->code_order.'.html');
                    }
                }
            }
            $model->fill($inputs);
            return view('view.combo.order',[
                'combo'=>$combos,
                'price_total'=>$price_total,
                'price_bed'=>$price_bed,
                'price_breakfast'=>$price_breakfast,
                'model'=>$model,
                'errors'=>$validate
            ]);
        }
        return view('view.combo.order',[
            'combo'=>$combos,
            'price_total'=>$price_total,
            'price_bed'=>$price_bed,
            'price_breakfast'=>$price_breakfast,
            'model'=>$model
        ]);
        
    }

    function end(ComboOrder_model $code_order){
       
       
        $combo_item=ComboOrderItems_model::where(['order_id'=>$code_order->id])->first();
        
        $combos=[];
        $price=0;
        $price_market=0;
        if($combo_item && $code_order){
            $combo=Combo_model::find($combo_item->combo_id);
            $combo_time=ComboTime_model::find($combo_item->combo_time);
            $combos=[];
            $tem['combo']=$combo;
            $tem['time']=$combo_time;
            $price=$combo_item->price_people/$combo_item->number_of_people;
            $price_children=0;
            if($combo_item->number_of_people_children){
                $price_children=$combo_item->price_children/$combo_item->number_of_people_children;
            }
            $price_sale=$combo_item->price_sale;
            $count=$combo_item->number_of_people;
            $count_children=$combo_item->number_of_people_children;
            $price_total=$code_order->price_all;
            $price_bed=$combo_item->price_bed;
            $price_breakfast=$combo_item->price_breakfast;
            $hotel_room=HotelRoom_model::find($combo_item->hotel_room_id);
            $hotel=Hotel_model::find($combo_item->hotel_id);
            $tem['hotel_room']=$hotel_room;
            $tem['hotel']=$hotel;
            $tem['people']=$combo_item->number_of_people;
            $tem['hotel']=$combo_item->number_of_people_children;
            $combos=$tem;
            
        }
        Product_model::setCookie(Combo_model::ORDER,'');
        // print_r($combos);
        // die();
        $price_sale_code=0;
        if($code_order->code){
            $codeitem=CodeItem_model::where(['key'=>$code_order->code])->first();
            $code=Code_model::find($codeitem->code_id);
            if($codeitem && $code){
                // khuyeesn ma tien
               
                if($code->type==Code_model::TYPE_1){
                    $price_sale_code=$code->price;
                }
                if($code->type==Code_model::TYPE_2){
                    $price_sale_code=($price_total*$code->price)%100;
                }
            }
            
        }
        $price_total-=$price_sale_code;
        return view('view.combo.end',[
            'combo'=>$combos,
            'combo_time'=>$combo_time,
            'price'=>$price,
            'price_children'=>$price_children,
            'price_sale'=>$price_sale,
            'count'=>$count,
            'count_children'=>$count_children,
            'price_total'=>$price_total,
            'price_bed'=>$price_bed,
            'price_breakfast'=>$price_breakfast,
            'price_sale_code'=>$price_sale_code,
            'code_order'=>$code_order
        ]);
       
        
    }

    protected function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

   public static function checkCode(Request $request){
        if($request->ajax()){
           
            $key=$request->code;
            if($key){
                $tem=CodeItem_model::where(['key'=>$key])->first();
                if($tem && !Product_model::getCookie('codecombo')){
                    $code=Code_model::where(['id'=>$tem->code_id])
                    ->where('time_end','>',time())
                    ->first();
                    $time=60*60*24*30;
                    if($code){
                        Product_model::setcookie('codecombo',json_encode(['key'=>$key]),$time);
                        return ['code'=>200,'messages'=>'Bạn đã xử dụng code thành công'];
                    }
                    return ['code'=>200,'messages'=>'Mã code của bạn đã hết hạn sử dụng'];
                }
            }
        }
        return ['code'=>400,'messages'=>'Code của bạn không chính xác'];
   }
    
}
