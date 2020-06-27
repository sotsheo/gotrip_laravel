<?php

namespace App\Http\Model\hotel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use App\Cl\ClCategory;
use  App\Http\Model\album\AlbumImg_model;
class HotelAddress_model extends Model
{
    protected $table = 'hotel_address';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'hotel_id',
        'address_from',
        'address_to',
        'number_km',
        'name',
        'delete',
        'deleted_at',
        
    ];
    public static function boot(){
        parent::boot();
       
        
    }
  
}
