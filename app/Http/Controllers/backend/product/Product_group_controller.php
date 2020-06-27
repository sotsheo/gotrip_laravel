<?php


namespace App\Http\Controllers\backend\product;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\product\Product_model;
use App\Http\Model\product\List_group_product_model;
use App\Http\Model\product\Category_product_model;
use App\Http\Model\product\Group_product_model;
use App\Http\Model\site\Websites_model;
class Product_group_controller extends Controller
{

    function index(){
         $w = Website_model::find(self::WEB);
        $messages= Session::get('messages');
        $group=List_group_product_model::where(['status'=>1,'delete'=>0])->paginate($w->pagesize);
        return view("admin.home.product.productgroup.index",["group"=>$group,'messages'=>$messages]);
    }
   
    function create(){
        return view("admin.home.product.productgroup.insert");
    }
    function create_list(Request $request){
         

        if($request->isMethod('post')){
           $group=new List_group_product_model;
        }
        return redirect('admin/product_group/');
    }

    function update($id){
        $product=Product_model::all();
        $list_group =List_group_product_model::where('id',$id)->first();
        $data_in_group=List_group_product_model::join('groupproduct', 'groupproduct.id_list_group', '=', 'listgroupproduct.id')->join('product', 'groupproduct.id_product', '=', 'product.id')->join('product_category', 'product.id_category', '=', 'product_category.id')->select('product.id','product.name','product_category.name as name_product')->where('groupproduct.id_list_group', $list_group->id)->get();
        $data_out_group=Group_product_model::join('product', 'groupproduct.id_product', '=', 'product.id', 'right outer')->select('product.id','product.name')->where('groupproduct.id_list_group', $list_group->id)->select('product.id')->get();
         $data_out_group=Product_model::join('product_category', 'product.id_category', '=', 'product_category.id')->whereNotIn('product.id',$data_out_group)->select('product.id','product.name','product_category.name as name_product')->get();
        return view("admin.home.product.productgroup.update",['list_group'=>$list_group,'data_in_group'=>$data_in_group,'data_out_group'=>$data_out_group]);
    }
    // add product and list group
    function add_ajax(Request $request){
        if($request->isMethod('post')){
            // get product
            if($request->id_product){
                $product=Product_model::find($request->id_product);
                if($product){
                    $data=List_group_product_model::addProduct($product,$request);
                        return $data;
                }
            }
        }
        return false;
    }
     function update_list(Request $request){
         
        if($request->isMethod('post')){
            $group=List_group_product_model::where('id',$request->id)->first();
            $check=List_group_product_model::actionModel($group, $request);
            if ($check=='true') {
                return redirect('admin/product_group/');
            }
            $data_in_group=List_group_product_model::join('groupproduct', 'groupproduct.id_list_group', '=', 'listgroupproduct.id')->join('product', 'groupproduct.id_product', '=', 'product.id')->join('product_category', 'product.id_category', '=', 'product_category.id')->select('product.id','product.name','product_category.name as name_product')->where('groupproduct.id_list_group', $group->id)->get();
            $data_out_group=Group_product_model::join('product', 'groupproduct.id_product', '=', 'product.id', 'right outer')->select('product.id','product.name')->where('groupproduct.id_list_group', $group->id)->select('product.id')->get();
            $data_out_group=Product_model::join('product_category', 'product.id_category', '=', 'product_category.id')->whereNotIn('product.id',$data_out_group)->select('product.id','product.name','product_category.name as name_product')->get();
            return view('admin.home.product.productgroup.update',[
                'errors'=>$check['validation'],
                'model'=>$check['model'],
                'list_group'=>$group,
                'data_in_group'=>$data_in_group,
                'data_out_group'=>$data_out_group]);
        }
        return redirect('admin/product_group/');
    }

     function delete($id){
        $list_group =List_group_product_model::find($id);
        if($list_group){
            $list_p=Group_product_model::where("id_list_group",$list_group->id)->get();
            foreach ($list_p as $key) {
                $pd=Group_product_model::find($key->id);
                if($pd){
                    $pd->delete=1;
                    if($pd->save()){
                        
                    }
                }
            }
            $name=$list_group->name;
            if($list_group->delete()){
                Session::flash('messages', 'Đã xóa sửa thành công nhóm sản phẩm '.$name);
            }
        }
        return redirect('admin/product_group/');
     }
}
