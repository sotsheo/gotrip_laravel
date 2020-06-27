<?php

namespace App\Http\Model\banner;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Validator;
class BannerCategory_model extends Model
{
    protected $table = 'banner_category';
    public $timestamps = false;
     protected $fillable = [
        'name',
        'short_description',
        'img',
        'status',
        'created_at',
        'updated_at',
        'delete',
        'delete_at'
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
   
    public static function validate($request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:5|max:255'

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
     public static function get_category_banner(){
        $where['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        $category=BannerCategory_model::where($where)->get();
        $data['limit']=0;
        $data['category']=$category;
        return $data;
    }
}
