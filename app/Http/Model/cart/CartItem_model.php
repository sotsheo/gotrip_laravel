<?php

namespace App\Http\Model\cart;

use Illuminate\Database\Eloquent\Model;

class CartItem_model extends Model
{
    protected $table = 'cart_item';
    protected $fillable = [
        'product_id',
        'price',
        'qty',
        'cart_id',
    ];
    public $timestamps=false;
    //
}
