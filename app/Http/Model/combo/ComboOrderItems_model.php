<?php

namespace App\Http\Model\combo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use  App\Http\Model\album\AlbumImg_model;
class ComboOrderItems_model extends Model
{
    protected $table = 'combo_order_items';
    public $timestamps=false;
    protected $fillable = [
        'hotel_id',// khách sạn
        'hotel_room_id',// phòng
        'number_of_people',// số lượng người lớn
        'number_of_people_children',// số lượng trẻ em 
        'order_id',// 
        'combo_id',// combo nào 
        'price_room_hotel',// giá khách sạn
        'price_room_hotel_children',// giá khách sạn đối vs trẻ em 
        'price_planes_from',// giá máy bay (vé đi)
        'price_planes_from_children',// giá máy bay trẻ em (vé đi)
        'price_planes_to_children',// giá máy bay trẻ em (vé về)
        'price_planes_to',// giá máy bay (vé về)
        'price_tour',// giá tour
        'price_sale',// giảm giá 
        'price_children',// giá trẻ em 
        'price_sale_children',// giảm giá trẻ em 
        'price_people',// giá 
        'price_bed',// giá giường 
        'price_breakfast',// giá ăn sáng 
        'type_combo',// loại combo
        'combo_time'// thời gian khởi hàng
    ]; 
    
}
