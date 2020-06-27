<?php


namespace App\Http\Controllers\frontend;

use App\Http\Controllers\frontend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\site\Websites_model;
use App\Http\Model\cart\Cart_model;
use App\Http\Model\cart\CartItem_model;
use App\Http\Model\product\Product_model;
use Mail;
use Illuminate\Support\Facades\Input;
use App\Http\Model\site\Website_model;
class Cart_controller extends Controller
{

	function index(Request $request){
		$orders=(array)Product_model::getCookie('orders');
		$products=$this->getProducts($orders);
		if ($request->isMethod('post')) {
			// update dữ liệu
			print_r($request->all());
			// die();
		}
		return view("view.cart.view",['products'=>$products]);
	}

	function add($id,Request $request){
		$product=Product_model::find($id);
		$qty=$request->get('qty',1);
		if($product && $qty){
			$orders=Product_model::getCookie('orders');
			// nếu chưa có sản phẩm nào
			$item=[];
			if(!$orders){
				$item[$id]=(int)$qty;
			}else{
				// tìm kiếm xem có sản phẩm đó chưa 
				$item= (array)$orders;
				$check=1;
				$items=[];
				foreach($item as $key=>$val){
					$items[$key]=$val;
					if($key==$id){
						$items[$key]+=(int)$qty;
						$check=0;
					}
				}
				$item=$items;
				if($check){
					$item[$id]=(int)$qty;
				}
			}
			$time=60*60*24*30;
			Product_model::setCookie('orders',json_encode($item),$time);
		}
		return redirect('/gio-hang.html');
	}

	function delete($id){
		$orders=(array)Product_model::getCookie('orders');
		if($orders){
			foreach($orders as $key=>$val){
				if($id==$key){
					unset($orders[$key]);
					break;
				}
			}
			$time=60*60*24*30;
			Product_model::setCookie('orders',json_encode($orders),$time);
		}
		return redirect()->back();
	}

	function update($id,$qty,Request $request){

		if($id && $qty){
			$product=Product_model::find($id);
			if($product){
				$orders=(array)Product_model::getCookie('orders');
				if($orders){
					foreach($orders as $key=>$val){
						if($id==$key){
							$orders[$key]=$qty;
							$time=60*60*24*30;
							Product_model::setCookie('orders',json_encode($orders),$time);
							break;
						}
					}
				}
				
			}
			// kiểm tra có sản pham do k
		
		}
		return redirect('/gio-hang.html');
	}

	function order(Request $request){
		$orders=(array)Product_model::getCookie('orders');
		$products=$this->getProducts($orders);
		$model=new Cart_model();
		if($products){
			if($request->isMethod('post')){
				$inputs = Input::all();
				$validate=$model->validate($request);
                if(!$model->validate($request)){                
                    if($model=$model->create($inputs)){
                    	$cart=Cart_model::orderByRaw('id DESC')->first();
                    	foreach($products as $key=>$val){
                    		$tem=new CartItem_model();
                    		$tem->product_id=$val['id'];
                    		$tem->price=$val['price'];
                    		$tem->qty=$val['qty'];
                    		$cart->sum_price+=$tem->price;
                    		$cart->price_ship+=$val['price_ship'];
                    		if($cart){
                    			$tem->cart_id=$cart->id;

                    			$tem->save();
                    		}
                    	}
                    	$cart->save();
                    	 \Cookie::queue(\Cookie::forget('orders'));
                    }
                    $model->fill($inputs);
                   	$this->sendEmail('view.mail.view',['model'=>$model]);
                    return redirect('/dat-hang.html/'.$model->id);
                }
                $model->fill($inputs);
                return view("view.cart.view_2",['products'=>$products,'model'=>$model,'validate'=>$validate]);
			}
			return view("view.cart.view_2",['products'=>$products,'model'=>$model]);
		}
		return redirect('/index');
	}

	function updateProduct($id,$qty){
		if($id && $qty){
			$orders=(array)Product_model::getCookie('orders');
			$list_id=array_keys($orders);
			if($list_id){
				print_r($orders[$id]);
				die();
			}
		}
	}

	function getProducts($orders){
		$products=[];
		$list_id=[];
		if($orders){
			$list_id=array_keys($orders);
			$product=Product_model::whereIn('id',$list_id)->get();
			if($product){
				foreach ($product as $p) {
					$tem=[];
					$tem['id']=$p->id;
					$tem['name']=$p->name;
					$tem['img_name']=$p->img_name;
					$tem['img_path']=$p->img_path;
					$tem['price']=$p->price;
					$tem['link']=$p->link;
					$tem['price_ship']=$p->price_ship;
					foreach($orders as $key=>$v){
						if($key==$p->id){
							$tem['qty']=$v;
							break;
						}
					}
					$products[]=$tem;
				}
				
			}
		}
		return $products;
	}

	function endorder(Cart_model $model){
		if($model){
			$items=[];
			$cart=CartItem_model::where(['cart_id'=>$model->id])->get();
			if($cart){
				foreach($cart as $c){
					$product=Product_model::find($c->product_id);
					if($product){
						$tem=[];
						$tem['name']=$product->name;
						$tem['price']=$c->price;
						$tem['qty']=$c->qty;
						$tem['price_ship']=$product->price_ship;
						$tem['img_name']=$product->img_name;
						$tem['img_path']=$product->img_path;
						$tem['link']=$product->link;
						$items[]=$tem;
					}
					
				}
			}
			return view("view.cart.end",['model'=>$model,'items'=>$items]);
		}
	}

	protected function sendEmail($view,$data){
		$w = Website_model::find(1);
		if($w->email){
			$email=explode(',',$w->email);
			if($email){
				foreach ($email as $val) {
					Mail::send($view,$data, function($message) use ($val){
						$message->to($val, 'Đơn hàng mới')->subject('Đơn hàng');
					});
					
				}
			}
		}
	}
	
}
