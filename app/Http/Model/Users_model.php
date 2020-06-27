<?php

namespace App\Http\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

class Users_model extends Authenticatable
{
    protected $table = 'users';
    // public $timestamps=false;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','email','address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
     public static function boot(){
        parent::boot();
        self::creating(function($model){
            $model->created_at=$model->updated_at=time();
        });    
    }
   
     public  static  function actionModel($model,$request){
        $model->name = $request->name;
        $model->password =  bcrypt($request->password);
        $model->authorities = 0;
        $model->au_list = $request->au_list;
        $validation=User::validation($request);
        if( $validation){
            $data['validation']=$validation;
            $data['model']=$model;
            return $data;
        }
        if ($model->save()) {
            return 'true';
        }
    }
    public static function validate_login($request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'password'=>'required'
            ],
            [
                'required' => ':attribute không được để trống'
            ],
            [
                'name' => 'Tài khoản',
                'password'=>'Mật khẩu'
            ]
        );
        if ($validate->fails()) {
            return $validate->messages();
        }
        return false;
    }

    public static function validation($request){
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'password'=> 'required|min:5|max:255',
                'phone'=> 'required',
                'email'=> 'required',
                'address'=> 'required',
            ],
            [
                'required' => ':attribute Không được để trống',
                'integer' => ':attribute Chỉ được nhập số',
            ],

            [
                'name' => 'Tên',
                'password' => 'Mật khẩu',
                'phone'=> 'Số điện thoại',
                'email'=> 'Email',
                'address'=> 'Địa chỉ',
            ]

        );
        
        
        if ($validate->fails()) {
            return  $validate->messages();
        }
        $email=Users_model::where(['email'=>$request['email']])->first();
        if($email){
           $validate->errors()->add('email', 'Email đã tồn tại');
           return  $validate->messages();
        }
        $phone=Users_model::where(['email'=>$request['phone']])->first();
        if($email){
           $validate->errors()->add('phone', 'Số điện thoại đã tồn tại');
           return  $validate->messages();
        }
        return false;
    }

    public static function validationAjax($request){
        $validate = Validator::make(
            $request,
            [
                'name' => 'required',
                'password'=> 'required|min:5|max:255',
                'phone'=> 'required',
                'email'=> 'required',
                'address'=> 'required',
            ],
            [
                'required' => ':attribute Không được để trống',
                'integer' => ':attribute Chỉ được nhập số',
                'min'=>':attribute không được dưới 5 ký tự'
            ],

            [
                'name' => 'Tên',
                'password' => 'Mật khẩu',
                'phone'=> 'Số điện thoại',
                'email'=> 'Email',
                'address'=> 'Địa chỉ',
            ]

        );
        
        
        if ($validate->fails()) {
            return  $validate->messages();
        }
        $email=Users_model::where(['email'=>$request['email']])->first();
        if($email){
           $validate->errors()->add('email', 'Email đã tồn tại');
           return  $validate->messages();
        }
        $phone=Users_model::where(['email'=>$request['phone']])->first();
        if($email){
           $validate->errors()->add('phone', 'Số điện thoại đã tồn tại');
           return  $validate->messages();
        }
        return false;
    }
   
}
