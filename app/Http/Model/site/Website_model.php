<?php

namespace App\Http\Model\site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
class Website_model extends Model
{
    const WEB=1;
    protected $table = 'website';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'icon',
        'icon_root',
        'logo',
        'logo_root',
        'phone',
        'address',
        'phone_admin',
        'email_admin',
        'page_size',
        'email',
        'default',
        'map',
        'type_website',
        'icon_shortcut',
        'icon_shortcut_root',
        'page_admin',
        'product_together',
        'product_qrcode'
    ];
     public static function boot(){
        parent::boot();
        self::creating(function($model){
            if($model->logo){
                $time=time();
                $file = $model->logo;
                $destinationPath = 'upload/website/';
                $model->logo_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                $file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                $model->logo='';
            }
            if($model->icon){
                $time=time()+1;
                $file = $model->icon;
                $destinationPath = 'upload/website/';
                $model->icon_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                $file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                $model->icon='';
            }
            if($model->icon_shortcut){
                $time=time()+2;
                $file = $model->icon_shortcut;
                $destinationPath = 'upload/website/';
                $model->icon_shortcut_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                $file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                $model->icon_shortcut='';
            }
            
        });
        
        self::updating(function($model){
            if($model->logo){
                $time=time();
                $file = $model->logo;
                $destinationPath = 'upload/website/';
                $model->logo_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                $file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                $model->logo='';
            }

            if($model->icon){
                $time=time()+1;
                $file = $model->icon;
                $destinationPath = 'upload/website/';
                $model->icon_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                $file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                $model->icon='';
            }
            if($model->icon_shortcut){
                $time=time()+2;
                $file = $model->icon_shortcut;
                $destinationPath = 'upload/website/';
                $model->icon_shortcut_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                $file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                $model->icon_shortcut='';
            }
        });
        
    }
    

    public static function validate($request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2|max:255',
                'email,email_admin'=>'email'

            ],
            [
                'required' => ':attribute Không được để trống',
                'email' => ':attribute phải đúng dạng email'
            ],

            [
                'name' => 'Tiêu đề',
                'email,email_admin'=>'Email',
            ]

        );
        if ($validate->fails()) {
            return $validate->messages();
        }
        return false;
    }
}
