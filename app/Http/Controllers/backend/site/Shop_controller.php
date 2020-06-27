<?php


namespace App\Http\Controllers\backend\site;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\site\Shop\Shop_model;

use App\Http\Model\province\Province_model;
use App\Http\Model\province\District_model;
use App\Http\Model\site\Shop\ShopImages_model;
use App\Http\Model\site\Website_model;
class Shop_controller extends Controller
{

	function index(){
		 $w = Website_model::find(self::WEB);
		$messages= Session::get('messages');
		$model=Shop_model::paginate($w->pagesize);
		return view("admin.home.site.shop.index",["model"=>$model,'messages'=>$messages]);
	}

// create
	function create(){
		$model=new Shop_model;
		$province=Province_model::all();
		$model->date_create = strtotime(date('d-m-Y'));
		$model->orders = 0;
		return view("admin.home.site.shop.insert",["model"=>$model,'province'=>$province]);
	}

	function create_shop(Request $request){
		if ($request->isMethod('post')) {
			$model = new Shop_model;
			
			$check=Shop_model::actionModel($model, $request);
			if ($check=='true') {
				return redirect('admin/shop/');
			}
			$province=Province_model::all();
			return view('admin.home.site.shop.insert',[
				'errors'=>$check['validation'],
				'model'=>$check['model']]);	
		}
		return redirect('admin/shop/');
	}

	function update($id){
		$model = Shop_model::find($id);
		if($model){
			$province=Province_model::all();
			$district=District_model::where('provinceid',$model->province)->get();

			$images=ShopImages_model::orderByRaw('orders ASC,id DESC')->where('id_shop',$id)->get();
			return view("admin.home.site.shop.update",["model"=>$model, 'images'=>$images,'province'=>$province,'district'=>$district]);
		}
		
		return redirect('admin/shop/');
	}
	function update_shop(Request $request){
		if ($request->isMethod('post')) {
			$model =Shop_model::find($request->id);
			
			if ($model) {
				$check=Shop_model::actionModel($model, $request);
				$province=Province_model::all();
				$district=District_model::where('provinceid',$model->province)->get();
				$images=ShopImages_model::orderByRaw('orders ASC,id DESC')->where('id_shop',$model->id)->get();
				if ($check=='true') {
					return redirect('admin/shop/');
				}
				return view('admin.home.shop.shop.update',[
					'errors'=>$check['validation'],
					'model'=>$check['model'],'images'=>$images,'province'=>$province,'district'=>$district]);

			}
			return redirect('admin/shop/');
		}
	}
	function delete($id)
	{
		$product = Shop_model::where('id', $id)->first();
		if ($product) {
			$name = $product->name;
			if ($product->delete()) {
				$list_img=ShopImages_model::where('id_shop', $id)->get();
				if($list_img){
					foreach($list_img as $img){
						ShopImages_model::actionRemove($img->id);
					}
				}

				Session::flash('messages', 'Đã xóa thành công sản phẩm' . $name);

			}
			return redirect('admin/shop/');
		}
		return redirect('admin/shop/');
	}

	public static function uploadFileShop(Request $request){
		if($request->isMethod('post')) {
			$id=$request->input('id');
			for($i=0;$i<$request->input('count');$i++){
				$file=$request->file('file'.$i);
				$time = strtotime(date("d-m-Y h:i:s"));
				$image=new ShopImages_model;
				$image->id_shop=0;
				$image->img_path=url('upload/');

				if(isset($id) && $id!=0){
					$image->id_shop=$id;
				}

				$image->img_name=$time.".".$file->getClientOriginalExtension();
				$images[]=ShopImages_model::actionModel($image,$file,$time);
			}
			return json_encode($images);
		}
		return  1;
	}

	public static function removeFileShop(Request $request){
		if($request->isMethod('post')) {
			$id=$request->input('id');
			if(ShopImages_model::actionRemove($id)){
				return $id;
			}
		}
		return  false;
	}

	public static function getDistrictShop(Request $request){
		if($request->isMethod('post')) {
			$id=$request->provice;
			if(isset($id) && $id!=0){
				$district=District_model::where('provinceid',$id)->get();
				return $district;
			}
		}
		return false;
	}
}
