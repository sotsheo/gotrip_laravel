<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
class User extends Authenticatable
{
    protected $table = 'user_admin';
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
                'name' => 'required|min:5|max:255',
                'password'=> 'required|min:5|max:255',
                'au_list'=>'required',
                'au_list'=>'integer',
            ],
            [
                'required' => ':attribute Không được để trống',
                'integer' => ':attribute Chỉ được nhập số',
            ],

            [
                'name' => 'Tên',
                'password' => 'Mật khẩu',
                'au_list'=>'Quyền'
            ]

        );
        if ($validate->fails()) {
            return  $validate->messages();
        }
        return false;
    }
   
}
