<?php

namespace App\Http\Model\history;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Model\menu\MenuCategory_model;
use App\Http\Model\news\News_model;
use App\Http\Model\news\PageContent_model;
use App\Http\Model\news\NewsCategory_model;
use App\Http\Model\product\Product_model;
use App\Http\Model\product\ProductCategory_model;
use App\Http\Model\Websites_model;
use App\Http\Model\album\AlbumCategory_model;
class HistoryItem_model extends Model
{
    protected $table = 'history_item';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'value_old',
        'value_new',
        'history_id',
    ];

}
