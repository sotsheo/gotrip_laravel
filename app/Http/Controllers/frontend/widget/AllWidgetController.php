<?php


namespace App\Http\Controllers\frontend\widget;

use App\Http\Controllers\frontend\Controller;
use App\Cl\ClMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

use App\Http\Model\Widget_model;


use App\Http\Model\product\Support_model;

use App\Http\Model\site\Website_model;

use App\Http\Controllers\frontend\widget\all\ComboWidget;
use App\Http\Controllers\frontend\widget\all\HotelWidget;
use App\Http\Controllers\frontend\widget\all\MenuWidget;
use App\Http\Controllers\frontend\widget\all\Bannerwidget;
use App\Http\Controllers\frontend\widget\all\Pagewidget;
use App\Http\Controllers\frontend\widget\all\HtmlWidget;
use App\Http\Controllers\frontend\widget\all\NewsWidget;
use App\Http\Controllers\frontend\widget\all\ProductWidget;
use App\Http\Controllers\frontend\widget\all\AlbumWidget;
use App\Http\Controllers\frontend\widget\all\VideoWidget;
use Illuminate\Support\Facades\Input;
class AllWidgetController extends Controller
{

    public $cate=[];

    public static function  getDataWidget($view,$number_type){
        $view_v='modules.';
        $widget=Widget_model::where('number_type',$number_type)->first();
        if($widget){
            switch ($widget->type){
                case 'menu':
                   return MenuWidget::menu($view_v,$view,$number_type,$widget);
                break;

                case 'banner':
                   return BannerWidget::banner($view_v,$view,$number_type,$widget);
                break;

                case 'pagecontent':
                   return Pagewidget::page($view_v,$view,$number_type,$widget);
                break;

                case 'html':
                    return HtmlWidget::html($view_v,$view,$number_type,$widget);
                break;

                case 'newsIncategory':
                    return NewsWidget::newsIncategory($view_v,$view,$number_type,$widget);
                break;

                case 'hotnews':
                    return NewsWidget::hotnews($view_v,$view,$number_type,$widget);
                break;

                case 'categorynewsishome':
                   return NewsWidget::categorynewsishome($view_v,$view,$number_type,$widget);
                break;

                case 'newsletter':
                   return NewsWidget::newsletter($view_v,$view,$number_type,$widget);
                break;

                case 'introduce':
                     return NewsWidget::introduce($view_v,$view,$number_type,$widget);
                break;

                case 'videohot':
                    return VideoWidget::introduce($view_v,$view,$number_type,$widget);
                break;
                // product 
                case 'productcategoryishome':
                    return ProductWidget::productcategoryishome($view_v,$view,$number_type,$widget);
                break;

                case 'categoryproduct':
                   return ProductWidget::categoryproduct($view_v,$view,$number_type,$widget);

                case 'productall':
                  return ProductWidget::productall($view_v,$view,$number_type,$widget);

                case 'productrating':
                   return ProductWidget::productrating($view_v,$view,$number_type,$widget);

                case 'productviewed':
                    return ProductWidget::productviewed($view_v,$view,$number_type,$widget);

                case 'productgroup':
                   return ProductWidget::productgroup($view_v,$view,$number_type,$widget);
                break;

                case 'productscorrelate':
                  return ProductWidget::productscorrelate($view_v,$view,$number_type,$widget);
                

                //  Bộ lọc
                case 'pagesize':
                   return ProductWidget::pagesize($view_v,$view,$number_type,$widget);

                case 'fillterprice':
                    return ProductWidget::fillterprice($view_v,$view,$number_type,$widget);

                case 'sort':
                   return ProductWidget::sort($view_v,$view,$number_type,$widget);

                case 'star':
                   return ProductWidget::star($view_v,$view,$number_type,$widget);

                case 'albumcategoryishome':
                   return AlbumWidget::albumcategoryishome($view_v,$view,$number_type,$widget);

                case 'albumhot':
                   return AlbumWidget::albumhot($view_v,$view,$number_type,$widget);

                case 'searchbox':
                   return NewsWidget::searchbox($view_v,$view,$number_type,$widget);

                case 'cart':
                   return NewsWidget::cart($view_v,$view,$number_type,$widget);
                break;

                case 'combocategoryishot':
                     return ComboWidget::combocategoryishot($view_v,$view,$number_type,$widget);

                case 'searchCombo':
                     return ComboWidget::searchCombo($view_v,$view,$number_type,$widget);
                

                case 'comboSort':
                    return ComboWidget::comboSort($view_v,$view,$number_type,$widget);
                

                case 'comboSortPrice':
                   return ComboWidget::comboSortPrice($view_v,$view,$number_type,$widget);

                case 'hotelFilterStar':
                   return HotelWidget::hotelFilterStar($view_v,$view,$number_type,$widget);
                

                
            }
        }

    }



}

