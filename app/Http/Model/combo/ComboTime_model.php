<?php

namespace App\Http\Model\combo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use  App\Http\Model\album\AlbumImg_model;
use App\Http\Model\hotel\HotelRoom_model;
use App\Http\Model\flight\Flight_model;
use App\Http\Model\flight\FlightCategory_model;
use App\Cl\ClCategory;
class ComboTime_model extends Model
{
    const ORDER= 'combo_order';
    const TYPE_1=1;// LOẠI COMBO BO FIX GIÁ SẴN
    const TYPE_2=2;// LOẠI COMBO DỰA VÀO MB + GP + T - GKM
    protected $table = 'combo_time';
    public $timestamps=false;
    protected $fillable = [
        'combo_id',
        'hotel_id',
        'hotel_room_id',
        'planes_from_id',
        'planes_to_id',
        'province_from',
        'province_to',
        'time_start',
        'number_order',
        'type_combo',
        'price',
        'price_market',
        'price_sum',
        'price_type',
        'price_children',
        'number_sale',
        'price_sale',
        'price_sale_1',
        'price_sale_2',
        'time_day',
        'time_night',
        'order',
        'status',
        'updated_at',
        'delete',
        'delete_at',
    ];
    public static function boot(){
        parent::boot();
        self::creating(function($model){
            if($model->price){
                $model->price=(int)str_replace(',','',$model->price);
            }
            if($model->price_children){
                $model->price_children=(int)str_replace(',','',$model->price_children);
            }
            if($model->price_sale){
                $model->price_sale=(int)str_replace(',','',$model->price_sale);
            }
             if($model->price_children){
                $model->price_children=(int)str_replace(',','',$model->price_children);
            }
             if($model->price_sale_2){
                $model->price_sale_2=(int)str_replace(',','',$model->price_sale_2);
            }
            $model->created_at=$model->updated_at=time();
             $model->time_start=strtotime(str_replace('/', '-', $model->time_start));
            $model=ComboTime_model::calculates($model);
            
        });
       
        self::updating(function($model){
             if($model->price){
                $model->price=(int)str_replace(',','',$model->price);
            }
            if($model->price_children){
                $model->price_children=(int)str_replace(',','',$model->price_children);
            }
            if($model->price_sale){
                $model->price_sale=(int)str_replace(',','',$model->price_sale);
            }
             if($model->price_children){
                $model->price_children=(int)str_replace(',','',$model->price_children);
            }
             if($model->price_sale_2){
                $model->price_sale_2=(int)str_replace(',','',$model->price_sale_2);
            }
            $model->updated_at=time();
            $model->time_start=strtotime(str_replace('/', '-', $model->time_start));
            
             $model=ComboTime_model::calculates($model);
            //  print_r($model->public_at);
            // die();
        });
       
    }
   

    public static function validate($request){
        $validate = Validator::make(
            $request->all(),
            [
                'combo_id' => 'required|integer',
                'hotel_id' => 'required|integer',
                'hotel_room_id' => 'required|integer',
            ],
            [
                'required' => ':attribute không được để trống',
                'integer' => ':attribute chỉ được nhập số',
            ],

            [
                'combo_id' => 'Combo',
                'hotel_id' => 'Khách sạn',
                'hotel_room_id' => 'Phòng trong khách sạn',
            ]

        );
        if ($validate->fails()) {
            return  $validate->messages();
        }
        return false;
    }

     public static function getAll($id){
        return ComboTime_model::where(['status'=>1,'combo_id'=>$id])->get();
    }

    // lấy tất cả combotime năm trong combo 
    public static function getAllInCombo($id,$options=[]){
        $where['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        $where['combo_id']=$id;
        $limit=ClCategory::LIMIT_DEFAULT;
        $query=ComboTime_model::query();
        if(isset($options['limit']) && $options['limit']){
            $limit=$options['limit'];
        }
        return $query->where($where)->where('time_start','>',time())->limit($limit)->get();
    }

   public static function calculates($combo){
        $price=0;
        // loại 1 là giá luôn
        if($combo->type_combo==ComboTime_model::TYPE_1){
            $price=(int)str_replace(',','',$combo->price);
        }else{
            // loại 2 sẽ cộng vs giá máy bay , giá phòng /2
            if($combo->planes_from_id){
                $planes=Flight_model::find($combo->planes_from_id);
                if($planes){
                    $price+=$planes->price;
                }
            }
            if($combo->planes_to_id){
                $planes=Flight_model::find($combo->planes_to_id);
                if($planes){
                    $price+=$planes->price;

                }
            }
            if($combo->hotel_room_id){
                $planes=HotelRoom_model::find($combo->hotel_room_id);
                if($planes){
                    $price+=$planes->price/2;
                }
            }
                // $price=(int)($price);
        }
        // tính tiền khuyến mãi
        $combo->price_sale_1 =ComboTime_model::calculate_type2($price,$combo->price_sale,$combo->price_type)['sale'];
        $price=ComboTime_model::calculate_type2($price,$combo->price_sale,$combo->price_type)['total'];
        // if($combo->price_type==ComboTime_model::TYPE_2){
        //     $price-=(int)str_replace(',','',$combo->price_sale_2);
        // }
        $combo->price_sum =(int)($price);
        return $combo;
    }

    public static function calculate_type2($total,$km,$type=1){
        $price_km=(int)str_replace(',','',$km);
        $total=(int)str_replace(',','',$total);
        // nếu là khuyến mãi loại 1 tính %
        if($type==ComboTime_model::TYPE_1){
            $price_km=(int)($price_km*$total)/100;
        }
        $data=[];
        $data['sale']=$price_km;
        $data['total']=($total) - $price_km;
        return $data;
    }


}
