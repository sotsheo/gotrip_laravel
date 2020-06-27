<?php

namespace App\Http\Model\flight;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use App\Cl\ClCategory;
use  App\Http\Model\album\AlbumImg_model;
class Flight_model extends Model
{
    const DIRECTER_GO=1;
    const DIRECTER_BACK=2;
    protected $table = 'flight';
    public $timestamps=false;
    protected $fillable = [
        'type',
        //'url_seo',
        //'link',
        'province_id_from',
        'province_id_to',
        'address_from_text',
        'address_to_text',
        'airline_id',
        'time_from',
        'time_to',
        'price',
        'price_children',
        'status',
        'delete',
        'delete_at',
        'meta_description',
        'meta_keywords',
        'meta_title'
        
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
            if($model->time_from){
                $model->time_from=strtotime(str_replace('/', '-', $model->time_from));
            }
             if($model->time_to){
                $model->time_to=strtotime(str_replace('/', '-', $model->time_to));
            }
            // $model->url_seo=createUrlpage($model->name);
            // $model->link = "/" . $model->url_seo . "-fl-" .$model->id . '.html';
        });
        self::updating(function($model){
            if($model->price){
                $model->price=(int)str_replace(',','',$model->price);
            }
            if($model->price_children){
                $model->price_children=(int)str_replace(',','',$model->price_children);
            }
            if($model->time_from){
                $model->time_from=strtotime(str_replace('/', '-', $model->time_from));
            }
             if($model->time_to){
                $model->time_to=strtotime(str_replace('/', '-', $model->time_to));
            }
            // $model->url_seo=createUrlpage($model->name);
            // $model->link = "/" . $model->url_seo . "-fl-" .$model->id . '.html';
        });
    }
   

    public static function validate($request){
        $validate = Validator::make(
            $request->all(),
            [
                'type' => 'required',
                'province_id_from'=>'required',
                'province_id_to'=>'required',
                'address_from_text'=>'required',
                'address_to_text'=>'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'integer' => ':attribute chỉ được nhập số',
            ],

            [
                'type' => 'Loại vé',
                'province_id_from' => 'Địa điểm đi',
                'province_id_to' => 'Địa điểm đến',
                'address_from_text' => 'Địa điểm đi chi tiết',
                'address_to_text' => 'Địa điểm đến chi tiết',
            ]

        );
        if ($validate->fails()) {
            return  $validate->messages();
        }
        return false;
    }

    public static function getType(){
        return [
            self::DIRECTER_GO=>'Chuyến đi',
            self::DIRECTER_BACK=>'Chuyến về',
        ];
    }

    public static function getAllType($key){
        $where['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        $where['type']=$key;
        $data=Flight_model::where($where)->get();
        $cat=[0=>'Chuyến bay...'];
        if($data){
            foreach ($data as $key => $value) {
                $cat[$value->id]=$value['address_from_text'].' - '.$value['address_to_text'].'('.date('H:s d/m/Y',$value['time_from']).')';
            }
        }
        return $cat;
    }

    public static function getDirector($d){
       switch ($d) {
            case self::DIRECTER_GO:
                return 'Chiều đi';
               break;
            case self::DIRECTER_BACK:
               return 'Chiều về';
               break;
           
           default:
               return '';
               break;
       }
    }
    
}
