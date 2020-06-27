<?php

namespace App\Http\Model\combo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use  App\Http\Model\album\AlbumImg_model;
class Combo_model extends Model
{
    protected $table = 'combo';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'category_id',
        'combo_id',
        'delete',
        'price_not_included',
        'policy',
        'condition',
        'url_seo',
        'status',
        'number_point',
        'viewed',
        'view',
        'img',
        'img_path',
        'img_name',
        'img_root',
        'short_description',
        'description',
        'ishot',
        'created_at',
        'updated_at',
        'orders',
        'meta_keywords',
        'meta_description',
        'meta_title',
        'link',
        'delete',
        'delete_at'
    ];
    public static function boot(){
        parent::boot(); 
        
    }

    
}
