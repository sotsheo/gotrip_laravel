<?php


namespace App\Http\Controllers\backend\cart;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\cart\Cart_model;
use Illuminate\Support\Facades\Input;
use App\Http\Model\cart\CartItem_model;
use App\Http\Model\product\Product_model;
use Mail;

class Cart_controller extends Controller
{
    function index(){

        $carts = Cart_model::where(['status'=>1])->orderByRaw('id DESC')->paginate(10);
        $messages = Session::get('messages');
        return view("admin.home.cart.index", ['carts' => $carts]);
    }

 	function update(Cart_model $model){
 		if($model){
 			$products=[];
 			$item=CartItem_model::where(['cart_id'=>$model->id])->get();
 			$price_ship=0;
 			$method=Cart_model::getMethod();
 			$process=Cart_model::getProcess();
 			if($item){
 				foreach($item as $it){
 					$product=Product_model::find($it->product_id);
 					if($product){
 						$tem=[];
 						$tem['name']=$product->name;
 						$tem['price']=$it->price;
 						$tem['qty']=$it->qty;
 						$tem['link']=$product->link;
 						$price_ship+=$product->price_ship;
 						$products[]=$tem;
 					}
 				}
 			}
        	return view("admin.home.cart.update", [
        		'model' => $model,
        		'products' => $products,
        		'price_ship' => $price_ship,
        		'process' => $process
        	]);
 		}
        
    }

    function changeProcess(Request $request){
    	if($request->isMethod('post')){
    		$id=$request->id;
    		$process=$request->process;
    		$model=Cart_model::find($id);
    		if($model){
    			$model->process=$process;
    			$model->save();
    			return [
    				'code'=>200,
    				'messages'=>'Thay đổi trạng thái thành công!'
    			];
    		}

    	}
    	return [
    		'code'=>400,
    		'messages'=>'Lỗi không thay đổi được trạng thái!'
    	];
    }

    function delete(Cart_model $model){
    	if($model){
    		$model->status=0;
    		$model->save();
    	}
    	return redirect('admin/cart/');
    }
}   
