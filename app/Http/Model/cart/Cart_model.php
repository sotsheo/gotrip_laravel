<?php

namespace App\Http\Model\cart;

use Illuminate\Database\Eloquent\Model;
use Validator;
class Cart_model extends Model
{

    // trạng thái của đặt hàng
    const PROCESS_V1=0;//đơn hàng mới
    const PROCESS_V2=1;// kiểm tra đơn hàng
    const PROCESS_V3=2;// đơn hàng đã giao
    const PROCESS_SUCCESS=10;// đơn hàng giao thành công
    const PROCESS_CANE=101;// đơn hàng đã hủy
    const METHOD_SHIP=1;// gửi hàng qua (Phí ship bt)
    const METHOD_SHIP2=2;// gửi hàng grap(dựa vào grap)
    protected $table = 'cart';
    protected $fillable = [
        'name',
        'code',
        'sum_price',
        'address',
        'phone',
        'email',
        'method_pay',
        'method_ship',
        'note',
        'process',
        'status',
        'code',
        'price_ship',
        'created_at',
        'ip'
    ];
    public $timestamps=false;
    //
        public static function boot(){
        parent::boot();
        self::creating(function($model){
            $model->ip=self::get_client_ip();
            $model->created_at=time();
        });
    }
    static function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    function validate($request){
         $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:5|max:255',
                'phone'=>'integer',
                'email'=>'required',
                'address'=>'required',
                'phone'=>'required',
            ],
            [
                'required' => ':attribute Không được để trống',
                'integer' => ':attribute Chỉ được nhập số',
            ],

            [
                'name' => 'Tiêu đề',
                'email'=>'required',
                'address'=>'required',
                'phone'=>'required',
            ]

        );
        if ($validate->fails()) {
            return  $validate->messages();
        }
        return false;
    }


    public static function getProcess(){
        return [
            self::PROCESS_V1=>'Đơn hàng mới',
            self::PROCESS_V2=>'Kiểm tra đơn hàng',
            self::PROCESS_V3=>'Đơn hàng đã được giao',
            self::PROCESS_SUCCESS =>'Đơn hàng giao thành công',
            self::PROCESS_CANE =>'Đơn hàng đã bị hủy',
        ];
    }
    public static function getMethod(){
        return [
            self::METHOD_SHIP=>'Giao hàng và trả tiền',
            self::METHOD_SHIP2=>'Ship hàng qua grap',
            
        ];
    }

    static function  getOrder(){
        return Cart_model::where(['status'=>1,'process'=>0])->get();
    }

    static function getMethodIn($process){
        $name='Đơn hàng mới';
        if($process==self::PROCESS_V2){
             $name='Kiểm tra đơn hàng';
        }
         if($process==self::PROCESS_V3){
             $name='Đơn hàng đã được giao';
        }
         if($process==self::PROCESS_SUCCESS){
             $name='Đơn hàng giao thành công';
        }
         if($process==self::PROCESS_CANE){
             $name='Đơn hàng đã bị hủy';
        }
        return $name;
    }
}
