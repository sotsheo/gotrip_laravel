<?php


namespace App\Http\Controllers\backend\Product;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\product\Product_model;
use App\Http\Model\product\ProductCategory_model;
use App\Http\Model\product\Manufacturer_model;
use App\Http\Model\product\ProductImages_model;
use App\Http\Model\product\ProductTogether_model;
use App\Http\Model\product\NewsTogether_model;
use App\Http\Model\news\News_model;
use Illuminate\Support\Facades\Input;
use App\Http\Model\site\Website_model;
class Product_controller extends Controller
{

    function index(Request $request){
        $where=[];
        if($request->input('name')){
            $where['name']=$request->input('name');
        }
        if($request->input('id_category')){
            $where['id_category']=$request->input('id_category');
        }
        if($request->input('status')!=-1){
            $where['status']=$request->input('status');
        }
        $messages = Session::get('messages');
        $setting = Website_model::find(Website_model::WEB);
        $product=Product_model::getProducts($where);
        $category = ProductCategory_model::all();
        return view("admin.home.product.product.index", [
            'product' => $product, 
            'category' => $category,
            'messages' => $messages,
            'where' => $where
        ]);
    }

    function product(Request $request) {
        $messages = Session::get('messages');
        $product = Product_model::where(['status'=>1,'delete'=>0])->orderByRaw('orders ASC,id DESC')->paginate(10);
        $category = ProductCategory_model::where(['status'=>1,'delete'=>0])->get();

        $name = '';
        $id_category = 0;
        $state = -1;
        $id_manufacturer = 0;
        if ($request->isMethod('post')) {
            if ($request->name) {
                $name = strtolower($request->name);
            }
            if ($request->id_category) {
                $id_category = $request->id_category;
            }
            if ($request->state != -1) {
                $state = $request->state;
            }

            $product = Product_model::where(['status'=>1,'delete'=>0])->orderByRaw('orders ASC,id DESC')->where("name", 'like', '%' . $name . '%')->paginate(10);
            $where = array();
            if ($id_category) {
                $where['id_category'] = $id_category;
            }
            if ($state != -1 && isset($state)) {
                $where['state'] = $state;
            }

            if (count($where) > 0) {
                $product = Product_model::orderByRaw('orders ASC,id DESC')->where("name", 'like', '%' . $name . '%')->where($where)->paginate(10);
            }

        }
        return view("admin.home.product.product.index", ['product' => $product, 'category' => $category, 'messages' => $messages, 'name' => $name, 'where' => $where]);
    }

    function create(Request $request){
        $w=Website_model::find(Website_model::WEB);
        $manufacturer = Manufacturer_model::where(['status'=>1,'delete'=>0])->get();
        $category = ProductCategory_model::where(['status'=>1,'delete'=>0])->get();
        $model = new Product_model;
        $model->orders=0;
        $model->public_at = time();
        $tem_c=[0=>'Danh mục '];
        if($category){
            foreach($category as $cate){
                $tem_c[$cate['id']]=$cate['name'];
            }
        }
        $tem_m=[0=>'Hãng sản xuất'];
        if($manufacturer){
            foreach($manufacturer as $cate){
                $tem_m[$cate['id']]=$cate['name'];
            }
        }
        $product_root=Product_model::getProductOption();
        if ($request->isMethod('post')) {
           
            
            $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){   
                $inputs['ishot']=isset($inputs['ishot'])?self::ACTIVE:self::NOT_ACTIVE; 
                $inputs['isselling']=isset($inputs['isselling'])?self::ACTIVE:self::NOT_ACTIVE;          
                $tem=$model->create($inputs);
                History_model::updateChange(History_model::ACTION_CREATE,'product',$tem->id);
                return redirect('admin/product/');
            }
            $model->fill($inputs);
            // $model->public_at=strtotime($model->public_at);
            $model->price=number_format($model->price);
            $model->price_market=number_format($model->price_market);
            return view('admin.home.product.product.insert', [
                'errors' =>$validate,
                'model' => $model,
                'category' => $tem_c, 
                'manufacturer' => $tem_m,
                'product_root'=>$product_root,
            ]);
        }
        return view("admin.home.product.insert", ['model'=> $model,'category' => $tem_c, 'manufacturer' => $tem_m,'product_root'=>$product_root,]);
    }

    

    function update(Product_model $model,Request $request)
    {
        // $model = Product_model::where('id', $id)->first();
        
        if ($model) {
            $setting=Website_model::find(Website_model::WEB);
            $images=ProductImages_model::orderByRaw('orders ASC,id DESC')->where('id_product',$model->id)->get();
            $cat = ProductCategory_model::where('id', $model->id_category)->first();
            $category = ProductCategory_model::where(['status'=>1,'delete'=>0])->get();
            $manufacturer = Manufacturer_model::where(['status'=>1,'delete'=>0])->get();
            // Ssản phẩm liên quan
            $product_out=ProductTogether_model::getProductOutID($model->id);
            $product_int=ProductTogether_model::getProductInID($model->id);
            $news_out=NewsTogether_model::getNewsOutID($model->id);
            $news_int=NewsTogether_model::getNewsInID($model->id);
            $tem_c=[0=>'Danh mục '];
            $product_root=Product_model::getProductOption([],$model->id);
            if($category){
                foreach($category as $cate){
                    $tem_c[$cate['id']]=$cate['name'];
                }
            }
            $tem_m=[0=>'Hãng sản xuất'];
            if($manufacturer){
                foreach($manufacturer as $cate){
                    $tem_m[$cate['id']]=$cate['name'];
                }
            }
            if ($request->isMethod('post')) {
                $inputs = Input::all();
                $validate=$model->validate($request);
                if(!$model->validate($request)){     
                    $inputs['ishot']=isset($inputs['ishot'])?self::ACTIVE:self::NOT_ACTIVE; 
                    $inputs['isselling']=isset($inputs['isselling'])?self::ACTIVE:self::NOT_ACTIVE;         
                    $model_old=$model;  
                    if(History_model::updateChange(History_model::ACTION_UPDATE,'product',$model->id,$model_old,$inputs)){
                        $model->update($inputs);
                        return redirect('admin/product/');
                    }  
                }
                $model->fill($inputs);
                // $model->public_at=strtotime($model->public_at);
                return view('admin.home.product.update', [
                    'errors' =>$validate,
                    'product' => $model,
                    'cat' => $cat,
                    'category' => $tem_c,
                    'manufacturer' => $tem_m,
                    'model'=> $product,
                    'images'=>$images,
                    'product_out'=>$product_out,
                    'product_int'=>$product_int,
                    'news_out'=>$news_out,
                    'news_int'=>$news_int,
                    'product_root'=>$product_root,
                    'setting'=>$setting,
                    ]);
            }
            $model->price=number_format($model->price);
            $model->price_market=number_format($model->price_market);
            return view("admin.home.product.product.update", [
                'product' => $model,
                'cat' => $cat,
                'category' => $tem_c,
                'manufacturer' => $tem_m,
                 'model'=> $model,
                'images'=>$images,
                'product_out'=>$product_out,
                'product_int'=>$product_int,
                'news_out'=>$news_out,
                'news_int'=>$news_int,
                'product_root'=>$product_root,
                'setting'=>$setting,
            ]);
        }
         return redirect('admin/product/');
    }


// Thực hiện thêm sản phẩm mua cùng
    function addproductTogether(Request $request){
        if($request->isMethod('post')){
            // get product
            if($request->id_product){
                $product=Product_model::find($request->id_product);
                if($product){
                    $pr=new ProductTogether_model();
                    $pr->id_product=$request->id;
                    $pr->id_product_g=$request->id_product;
                    $data=ProductTogether_model::actionModel($pr,$request);
                    return $data;
                }
            }
        }
        return false;
    }

    // Thực hiện tin tức liên quan
     function addnewsTogether(Request $request){
        if($request->isMethod('post')){
            // get product
            if($request->id_news){
                $product=News_model::find($request->id_news);
                if($product){
                    $pr=new NewsTogether_model();
                    $pr->id_product=$request->id;
                    $pr->id_news=$request->id_news;
                    $data=NewsTogether_model::actionModel($pr,$request);
                    return $data;
                }
            }
        }
        return false;
    }

    function coppy(Product_model $model,Request $request){
          if ($model) {
            $images=ProductImages_model::orderByRaw('orders ASC,id DESC')->where('id_product',$model->idid)->get();
            $cat = ProductCategory_model::where('id', $model->id_category)->first();
            $category = ProductCategory_model::all();
            $manufacturer = Manufacturer_model::all();
            // Ssản phẩm liên quan
            $product_out=ProductTogether_model::getProductOutID($model->id);
            $product_int=ProductTogether_model::getProductInID($model->id);
            $news_out=NewsTogether_model::getNewsOutID($model->id);
            $news_int=NewsTogether_model::getNewsInID($model->id);
            $tem_c=[0=>'Danh mục '];
            $product_root=Product_model::getProductOption([],$model->id);
            if($category){
                foreach($category as $cate){
                    $tem_c[$cate['id']]=$cate['name'];
                }
            }
            $tem_m=[0=>'Hãng sản xuất'];
            if($manufacturer){
                foreach($manufacturer as $cate){
                    $tem_m[$cate['id']]=$cate['name'];
                }
            }
            if ($request->isMethod('post')) {
                $inputs = Input::all();
                $validate=$model->validate($request);
                if(!$model->validate($request)){             
                    $model->create($inputs);
                    return redirect('admin/product/');
                }
                $model->fill($inputs);
                // $model->public_at=strtotime($model->public_at);
                return view('admin.home.product.product.insert', [
                    'errors' =>$validate,
                    'product' => $model,
                    'cat' => $cat,
                    'category' => $tem_c,
                    'manufacturer' => $tem_m,
                    'model'=> $product,
                    'images'=>$images,
                    'product_out'=>$product_out,
                    'product_int'=>$product_int,
                    'news_out'=>$news_out,
                    'news_int'=>$news_int,
                    'product_root'=>$product_root
                ]);
            }
            $model->price=number_format($model->price);
            $model->price_market=number_format($model->price_market);
            return view("admin.home.product.product.update", [
                'product' => $model,
                'cat' => $cat,
                'category' => $tem_c,
                'manufacturer' => $tem_m,
                 'model'=> $model,
                'images'=>$images,
                'product_out'=>$product_out,
                'product_int'=>$product_int,
                'news_out'=>$news_out,
                'news_int'=>$news_int,
                'product_root'=>$product_root
            ]);
        }
         return redirect('admin/product/');
    }

    function coppy_product(Request $request)
    {

        if ($request->isMethod('post')) {
            $product = new Product_model();
            if ($request->id_category) {

                $category = ProductCategory_model::find($request->id_category);
                if (!$category) {
                    $check = 1;
                }
            }
            if ($product) {
                $order= $request->order;
                $time = strtotime(date("d-m-Y h:i:s"));

                //$check=Product_model::actionModel($product, $request,$order);
                if ($check=='true') {
                    return redirect('admin/product/');
                }

                $category = ProductCategory_model::all();
                $manufacturer = Manufacturer_model::all();
                return view('admin.home.product.product.coppy',[
                    'errors'=>$check['validation'],
                    'model'=>$check['model'],
                    "category" => $category,
                    "manufacturer" => $manufacturer]);
            }
        }
        return redirect('admin/product/');
    }

    function delete($id)
    {
        $product = Product_model::where('id', $id)->first();
        if ($product) {
            $name = $product->name;
            $product->delete=1;
            $model->delete_at=time();
            if ($product->save()) {
                History_model::updateChange(History_model::ACTION_DELETE,'product',$model->id);
                Session::flash('messages', 'Đã xóa thành công sản phẩm' . $name);
            }
            return redirect('admin/product/');
        }
        return redirect('admin/product/');
    }



    // get all manufaturer in category
    static function get_manufaturer($urls)
    {
        $data = [];
        $url = explode('-cp-', $urls);
        if (isset($url[1])) {
            $category = ProductCategory_model::find($url[1]);
            if ($category) {
                $data = Manufacturer_model::join('product', 'product.id_manufacturer', '=', 'manufacturer.id')->where('product.id_category', '=', $category->id)->select('manufacturer.id', 'manufacturer.name')->distinct()->get();
            }
        }
        return $data;
    }

    // get product category
    static function get($id, $limit)
    {
        $products = Product_model::where('id_category', $id)->limit($limit)->get();
        return $products;
    }

     public static function uploadFileImages(Request $request){
         if($request->isMethod('post')) {
            $id=$request->input('id');
             for($i=0;$i<$request->input('count');$i++){
                 $file=$request->file('file'.$i);
                 $time = strtotime(date("d-m-Y h:i:s"));
                 $image=new ProductImages_model;
                 $image->id_product=0;
                 $image->img_path=url('upload/');
                 if($id){
                     $image->id_product=$id;
                 }
                 $image->img_name=$time.".".$file->getClientOriginalExtension();
                 $images[]=ProductImages_model::actionModel($image,$file,$time);
             }
             return json_encode($images);
         }
         return  1;
     }

    public static function removeImg(Request $request){
        if($request->isMethod('post')) {
            $id=$request->input('id');
            if(ProductImages_model::actionRemove($id)){
                return $id;
            }
        }
        return  false;
    }

    public function getProductTogether(Request $request){
        if($request->isMethod('post')) {
            $name=$request->input('name');
            if($name){
                $products=Product_model::getProducts(['name'=>$name]);
                if($products){
                    $html=view("admin.home.product.product.view_search",['products'=> $products])->render();
                    return [
                        'code'=>200,
                        'messages'=>$html
                    ];
                }
            }
             return [
                'code'=>200,
                'messages'=>'Không tìm được sản phẩm nào...'
            ];
           
        }
    }
}
