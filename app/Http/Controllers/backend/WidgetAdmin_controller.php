<?php


namespace App\Http\Controllers\backend;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Http\Model\news\Category_news_model;
use App\Http\Model\news\News_model;
use App\Http\Model\banner\BannerCategory_model;
use App\Http\Model\product\ProductCategory_model;
use App\Http\Model\product\Product_model;
use App\Http\Model\product\List_group_product_model;
use App\Http\Model\site\Introduce_model;
use App\Http\Controllers\backend\menu\Menu_controller;
use App\Http\Controllers\backend\site\Html_controller;
use App\Http\Controllers\backend\news\PageContent_controller;
use App\Http\Controllers\backend\news\News_controller;
use App\Http\Model\video\Video_model;
use App\Http\Model\album\AlbumCategory_model;
use App\Http\Model\album\Album_model;
use App\Http\Model\combo\ComboCategory_model;
class WidgetAdmin_controller extends Controller
{

	function getDataWidget(Request $request){
		if($request->isMethod('post')){
			$data;
			if($request->type){
				switch ($request->type) {
					// news
					case 'categorynewsishome':
						$data=NewsCategory_model::get_category();
					break;
					
					case 'newsIncategory':
						$data=NewsCategory_model::getnewsincategory();
						break;

					case 'hotnews':
						$data=News_model::getHotNewsWidget();
					break;

					case 'pagecontent':
						$data=PageContent_controller::get_page_content();
						break;

					case 'menu':
						$data=Menu_controller::menu_get();
						break;
					case 'html':
						$data=Html_controller::get_html();
						break;
					case 'banner':
						$data=BannerCategory_model::get_category_banner();
						break;
					
					case 'introduce':
						$data=Introduce_model::getIntroduce();
						break;
					case 'videohot':
						$data=Video_model::getVideohot();
						break;

					// product
					case 'productcategoryishome':
						$data=ProductCategory_model::getcateishome();
						break;
					case 'productscorrelate':
						$data=Product_model::getproductscorrelate();
						break;
					case 'productall':
						$data=Product_model::productwidgets();
						break;
					case 'productgroup':
						$data=List_group_product_model::getAllGroup();
						break;

					case 'albumcategoryishome':
						$data=AlbumCategory_model::categoryishome();
						break;

					case 'albumhot':
						$data=Album_model::getAlbumhot();
						break;

					case 'combocategoryishot':
						$data=ComboCategory_model::getcategoryishot();
						break;
					
					
					break;
					
				}
				return view("admin.home.widget.view",["data"=>$data]);
			}
		}
	}

}
