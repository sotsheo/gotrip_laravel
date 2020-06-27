<?php


namespace App\Http\Controllers\backend\admin\management\Product;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\manage\product\Product_model;
use App\Http\Model\manage\product\ProductCategory_model;

class Product_controller extends Controller
{

    function index()
    {
        $messages = Session::get('messages');
        $product = Product_model::orderByRaw('orders ASC,id DESC')->paginate(10);
        $category = ProductCategory_model::all();
        return view("admin.home.product.index", ['product' => $product, 'category' => $category, 'messages' => $messages]);
    }

    
    function create()
    {
        $manufacturer = Manufacturer_model::all();
        $category = ProductCategory_model::all();
        $model = new Product_model;
        $model->orders=0;
        $model->date_create = strtotime(date("d-m-Y"));
        $model->date_public = strtotime(date("d-m-Y"));

        return view("admin.home.product.insert", ['model'=> $model,'category' => $category, 'manufacturer' => $manufacturer]);
    }

    function create_product(Request $request)
    {
        if ($request->isMethod('post')) {
            $product = new Product_model;
            $check=Product_model::actionModel($product, $request);
            if ($check=='true') {
                return redirect('admin/product/');
            }
            $category = ProductCategory_model::all();
            $manufacturer = Manufacturer_model::all();
            return view('admin.home.product.insert',[
                'errors'=>$check['validation'],
                'model'=>$check['model'],
                "category" => $category,
                "manufacturer" => $manufacturer]);

        }
        return redirect('admin/product/');
    }

}
