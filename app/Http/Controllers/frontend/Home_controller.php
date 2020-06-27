<?php


namespace App\Http\Controllers\frontend;

use App\Http\Controllers\frontend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Model\news\News_model;
use App\Http\Model\news\NewsCategory_model;
use App\Http\Model\product\Product_model;
use App\Http\Model\product\ProductCategory_model;
use App\Http\Model\site\Website_model;
use App\Http\Model\site\Introduce_model;
// import
use App\Http\Controllers\frontend\home\News_controller;
use App\Http\Controllers\frontend\home\Album_controller;
use App\Http\Controllers\frontend\home\Product_controller;
use App\Http\Controllers\frontend\home\Combo_controller;
use App\Http\Controllers\frontend\home\Page_controller;
use App\Http\Controllers\frontend\home\Hotel_controller;
use App\Http\Controllers\frontend\home\Flight_controller;
use Mail;
class Home_controller extends Controller{
   
    
    function index(){
        $w = Website_model::find(self::WEB);
        $data['type']='website';
        $data['url']="http://{$_SERVER['HTTP_HOST']}";
        $data['image']=$data['url'].'/'.$w->logo;
        shareSEO('og',$data);
        $this->writeHistory();
        return view("view.home", ['meta_description' => "Home"]);
    }



    function search(Request $request){
        $this->writeHistory();
        $this->breadcrumb[0] = ['name' => 'home', 'link' => url('/')];
        $this->breadcrumb[] = ['name' => 'search', 'link' => ''];
        view()->share('breadcrumb', $this->breadcrumb);
        if ($request->t) {
            $data = [];
            if (strlen($request->t) >= 2) {
                $data = News_model::where('name', 'like', '%' . $request->t . '%')->paginate(10);
                $data->appends(['t' => $request->t]);

                if (count($data) > 0) {
                    return view("view.view.search.news", ['news' => $data, 't' => $request->t]);
                }

                $data = Product_model::where('name', 'like', '%' . $request->t . '%')->paginate(10);
                $data->appends(['t' => $request->t]);
                if (count($data) > 0) {
                    return view("view.view.search.product", ['product' => $data, 't' => $request->t]);
                }

                return view("view.view.search.news", ['news' => $data, 't' => $request->t]);
            } else {
                return view("view.view.search.news", ['t' => 'Tìm kiếm phải trên 2 kí tự', 'news' => $data]);
            }

        }
        return redirect('themes');
    }

    public  function page($category){
        $wb = Website_model::first();
        $request = new Request();
        $this->breadcrumb[0] = ['name' => 'Home', 'link' => url('/')];
        $url_news = explode('-', $category);
      
        $url_root=getUrl($url_news);
        if(in_array($url_root,Controller::URL_ROOTS)){
            switch ($url_root) {
                // tin tức 
                case 'cn':
                    return News_controller::category(getID($url_news),$wb);
                    break;

                case 'n':
                    return News_controller::detail(getID($url_news),$wb);
                    break;
                case 'page':
                    return Page_controller::detail(getID($url_news),$wb);
                    break;

                // sản phẩm
                case 'cpd':
                    return Product_controller::category(getID($url_news),$wb);
                    break;
                case 'pd':
                    return Product_controller::detail(getID($url_news),$wb);
                    break;

                // combo
                case 'ccb':
                    return Combo_controller::category(getID($url_news),$wb);
                    break;
                case 'cb':
                    return Combo_controller::detail(getID($url_news),$wb);
                    break;

                // video
                case 'cvd':
                    return Video_controller::category(getID($url_news),$wb);
                    break;
                case 'vd':
                    return Video_controller::detail(getID($url_news),$wb);
                    break;

                // album
                case 'cab':
                    return Album_controller::category(getID($url_news),$wb);
                    break;
                case 'ab':
                    return Video_controller::detail(getID($url_news),$wb);
                    break;

                default:
                    # code...
                    break;
            }
        }
       
       
        // if (getID($url_news,'cn')) {
        //     return News_controller::page_Category(getID($url_news,'cn'),$wb);
        // }
        // if (getID($url_news,'cp')) {
        //     return Product_controller::page_Category(getID($url_news,'cp'),$request,$wb);
            
        // }
        // if (getID($url_news,'pd')) {
        //      return Product_controller::page_Detail(getID($url_news,'pd'),$wb); 
        // }
        
        return redirect('/');
    }

    function url_page($category, $detail, Request $request){

        $this->breadcrumb[0] = ['name' => 'home', 'link' => url('/')];
        if($category){
            if ($detail) {
//            kiểm tra đang là tin tức hay danh mục
                $array_category = explode('-', $detail);
//            là tin tức
                if (isset($array_category[count($array_category) - 2]) && $array_category[count($array_category) - 2] == 'n') {
                    $category_find = NewsCategory_model::where('url_seo',$category)->first();
                    if ($category_find) {
                        $news = News_model::where('id_category', $category_find->id)->first();
                    }
                }
                if (isset($array_category[count($array_category) - 2]) && $array_category[count($array_category) - 2] == 'pd') {
                    $category_find = ProductCategory_model::where('url_seo',$category)->first();
                    if ($category_find) {
                        $product = Product_model::where('id_category', $category_find->id)->first();
                    }
                }
            }
        }

        // kiểm tra có phải tin tức k
        if (isset($news)) {
            // // kiểm tra xem no có layout khác k
            return News_controller::page_Detail( $category_find,$news);
        }
        // Check là sản phẩm
        if (isset($product)) {
           return Product_controller::page_Detail( $category_find,$product);

        }
        return redirect('/');
    }

    function urlRequire($url){

    }
    function demo($seo,$id){
        print_r(1);
    }
}