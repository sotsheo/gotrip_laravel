<?php

namespace App\Http\Model\menu;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
class MenuCategory_model extends Model
{
    protected $table = 'menu_category';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'short_description',
        'created_at',
        'updated_at',
    ];
    public static function boot(){
        parent::boot();
        self::creating(function($model){
            
            $model->created_at=$model->updated_at=time();
            
        });
        self::updating(function($model){
            $model->updated_at=time();
 
        });
        
    }

    //
    // public  static  function  actionModel($model,$request){
    //     $model->name=$request->name;
    //     $model->short_description=$request->short_description;
    //     $model->date_create=strtotime(date('d-m-Y'));
    //     if($request->date_create){
    //         $model->date_create=strtotime($request->date_create);
    //     }
    //     $validation = MenuCategory_model::validation_category($request);
    //     if ($validation) {
    //         $data['validation'] = $validation;
    //         $data['model'] = $model;
    //         return $data;
    //     }
    //     if($model->save()){
    //         Session::flash('messages', 'Đã thêm thành công menu');

    //     }
    //     return 'true';
    // }

    public static function validate($request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2|max:255'
            ],
            [
                'required' => ':attribute Không được để trống'
            ],
            [
                'name' => 'Tiêu đề'
            ]
        );
        if ($validate->fails()) {
            return $validate->messages();
        }
        return false;
    }
}
