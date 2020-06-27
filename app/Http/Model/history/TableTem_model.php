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
use App\Http\Model\history\HistoryItem_model;
class TableTem_model extends Model
{
	
    protected $table = 'news';
    public $timestamps=false;
   	function __construct($name) {
        $this->table=$name;
    }
}
