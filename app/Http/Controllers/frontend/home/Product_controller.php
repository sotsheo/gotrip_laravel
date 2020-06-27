<?php


namespace App\Http\Controllers\frontend\home;

use App\Http\Controllers\frontend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\product\Product_model;
use App\Http\Model\product\ProductRating_model;
use App\Http\Model\product\ProductImages_model;
use App\Http\Model\site\Website_model;
use App\Http\Model\product\ProductCategory_model;
use App\Http\Model\product\Manufacturer_model;
use Mail;
use Illuminate\Support\Facades\Input;
class Product_controller extends Controller{

    public static function index(){
        $this->writeHistory();
    }
  
    public static function category($url_seo,ProductCategory_model $model){
        $this->writeHistory();
        $wb = Website_model::find(self::WEB);
       
        Product_controller::shareLinkSort();
        if ($model) {
            $breadcrumb[] = ['name' => $model->name, 'link' => url($model->link)];
            $products=Product_model::getProducts([
                'name'=>Input::get('name'),
                'price_min'=>Input::get('price_min',0),
                'price_max'=>Input::get('price_max',0),
                'id_category'=>$model->id,
                'pagesize'=>Input::get('pagesize',0),
                'star'=>Input::get('star',0),
            ]);
            // 
            shareBreadcrumb($breadcrumb);
            //$products=Product_controller::sortAll($request,$category_id);
            $data['type']='website';
            $data['url']="http://{$_SERVER['HTTP_HOST']}";
            $data['image']=url($model->img_path.$category->img_name);
            shareSEO('og',$data);
            if ($model->view_detail) {
                $view = "view.view.product." . $model->view_detail;
                return view($view, ['category' => $model, 'product' => $product]);
            } else {
                return view("view.product.category", ['category' => $model, 'products' => $products]);
            }
        }
    }

    public  function detail($url_seo,Product_model $model){
        $wb = Website_model::find(self::WEB);
        $page = $wb->page_size;
        if ( $model) {
            // lấy tin tức thuộc danh mục trên
            $images = ProductImages_model::orderByRaw('orders ASC,id DESC')->where('id_product', $model->id)->get();
            $category=ProductCategory_model::find($model->id_category);
            if ($model->id_manufacturer) {
                $model->id_manufacturer = $request->id_manufacturer;
            }
            $model->id_manufacturer = Manufacturer_model::find($model->id_manufacturer);
            // // kiểm tra xem no có layout khác k
            $breadcrumb[] = ['name' => $category->name, 'link' => url($category->link)];
            shareBreadcrumb($breadcrumb);
            // tạo cookie sản phảm đã xem 
            $product_viewed=Product_model::getCookie('product_viewed');
            if(!$product_viewed){
                $product_viewed=[];
                 $product_viewed[$model->id]=$model->id;
            }else{
                $product_viewed= (array)$product_viewed;
                $product_viewed[$model->id]=$model->id;
            }
            // update viewed
            $viewed=Product_model::getCookie('product_'.$model->id);
            if(!$viewed){
                $viewed=[];
                $model->viewed++;
                $model->update();
                $viewed[$model->id]=[$model->id];
                Product_model::setCookie('product_'.$model->id,json_encode($viewed),5);
            }
            
            $data['type']='website';
            $data['url']="http://{$_SERVER['HTTP_HOST']}";
            $data['image']=url($model->img_path.$model->img_name);
            shareSEO('og',$data);
            // $product_viewed[$product->id]=$product->id;
            Product_model::setCookie('product_viewed',json_encode($product_viewed));
            $product_viewed=Product_model::getCookie('product_viewed');
            // print_r($product_viewed);
            // die();
            if (view()->exists($category->view_detail)) {
                $view = "view.view.product" . $category->view_detail;
                return view($view, ['category' => $category, 'product' => $model,'images'=>$images]);
            } else {
                return view("view.product.detail", ['category' => $category, 'product' => $model,'images'=>$images]);
            }
        }
    }


    public static function productall(Request $request){
        $w=Website_model::first();
        $breadcrumb[] = ['name' =>'sản phẩm', 'link' => url('/san-phamall.html')];
        shareBreadcrumb($breadcrumb);
         $products=Product_controller::sortAll($request);
         if($request->page){
           return \Request::fullUrl();
         }
        return view("view.view.product.index", ['products' => $products,  'breadcrumb' => $breadcrumb]);
    }

    public static function productviewed(){
        $w=Website_model::first();
        $breadcrumb[] = ['name' =>'Sản phẩm đã xem', 'link' => url('/product_viewed.html')];
        $products=Product_model::getCookie('product_viewed');
        $products=array_keys((array)$products);
        $products=Product_model::getProductInArray($products);
        return view("view.product.product_viewed", ['products' => $products,  'breadcrumb' => $breadcrumb]);
    }

    public static function shareLinkSort(){
        $url=url()->current();
        $sort='';
        $star='';
        $sortmanufacturer='';
        $price_min='';
        $price_max='';
        $pagesize='';
        $page='?';
        $param=[];
        if(\Request::get('sort')){
           $param['sort']=\Request::get('sort');
        }
        if(\Request::get('sortmanufacturer')){
            $param['sortmanufacturer']=\Request::get('sortmanufacturer');
        }
        if(\Request::get('price_min') && \Request::get('price_max')){
            $param['price_min']=\Request::get('price_min');
            $param['price_max']=\Request::get('price_max');
        }
        if(\Request::get('pagesize') && \Request::get('pagesize')){
            $param['pagesize']=\Request::get('pagesize');
        }
         if(\Request::get('star')){
            $param['star']=\Request::get('star');
        }
        $url=url($url) . '?' . http_build_query($param);
        view()->share('sort',$url);
        view()->share('star',$url);
        view()->share('pagesize',$url);
        view()->share('sortprice',$url.$page.$sort.$sortmanufacturer.$pagesize.$star);
        view()->share('sortmanufacturer',$url.$page.$sort.$pagesize.$price_min.$price_max.$star);
        return true;
    }

    function productRating(Product_model $model,Request $request){
        if($request->isMethod('post') && $model){
            $inputs = Input::all();
            $model_rating=new ProductRating_model;
            $request['id_product']=$model->id;
            $validate=$model_rating->validate($request);
            if(!$validate){     
                $inputs['id_product']=$model->id;
                if($model_rating->create($inputs)){
                    Session::flash('messages', 'Cám ơn bạn đã đánh giá sản phẩm của chúng tôi!');
                }
            }
            $model_rating->fill($inputs);
            Session::flash('validateRatting', $validate);
            Session::flash('productRating', $model_rating);
        }
        return redirect()->back();
    }
}
