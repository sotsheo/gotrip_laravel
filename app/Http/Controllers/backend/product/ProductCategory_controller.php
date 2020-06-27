<?php


namespace App\Http\Controllers\backend\product;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\product\ProductCategory_model;
use App\Http\Model\product\Group_properties_model;
use Illuminate\Support\Facades\Input;
use App\Http\Model\history\History_model;
class ProductCategory_controller extends Controller
{

    function index()
    {

        $messages = Session::get('messages');
        $category = ProductCategory_model::where(['status'=>1,'delete'=>0])->paginate(10);
        if ($category) {
            // $this->showCategories($category);
            return view("admin.home.product.category_product.index", ["category" => $category, 'messages' => $messages]);
        } else {
            return view("admin.home.product.category_product.index", ["category" => $category, 'messages' => $messages]);
        }
    }

    // đệ quy vòng lặp lấy category
    function showCategories($categories, $parent_id = 0, $char = '')
    {
        foreach ($categories as $key => $item) {
            // Nếu là chuyên mục con thì hiển thị
            if ($item['id_parent'] == $parent_id) {
                $item['name'] = $char . $item['name'];

                $this->categorys[] = $item;
                // Xóa chuyên mục đã lặp
                unset($categories[$key]);
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                $this->showCategories($categories, $item['id'], $char . '|---');

            }
        }

    }

    function create(Request $request){
        $category_list = ProductCategory_model::where(['status'=>1,'delete'=>0])->get();
        $model = new ProductCategory_model;
        $model->orders=0;
        if ($request->isMethod('post')) {
            $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){     
                $inputs['ishome']=isset($inputs['ishome'])?self::ACTIVE:self::NOT_ACTIVE;               
                $tem=$model->create($inputs);
                History_model::updateChange(History_model::ACTION_CREATE,'news',$tem->id);
                return redirect('admin/category_product/');
            }
            $model->fill($inputs);
            // $model->public_at=strtotime($model->public_at);
            return view('admin.home.product.insert', [
                'errors' =>$validate,
                'model' => $model,
                'category' => $category_list, 

            ]);
        }
        return view("admin.home.product.category_product.insert", ['model' => $model, 'category' => $category_list]);
    }

   


    function update(ProductCategory_model $model,Request $request){
       
        if ($model) {
            $category_list = ProductCategory_model::where('id','!=',$model->id)->get();
            if ($request->isMethod('post')) {
                $inputs = Input::all();
                $validate=$model->validate($request);
                if(!$model->validate($request)){  
                    $inputs['ishome']=isset($inputs['ishome'])?self::ACTIVE:self::NOT_ACTIVE;                  
                    $model_old=$model;  
                    if(History_model::updateChange(History_model::ACTION_UPDATE,'product_category',$model->id,$model_old,$inputs)){
                        $model->update($inputs);
                        return redirect('admin/category_product/');
                    }  
                    
                }
                $model->fill($inputs);
                // $model->public_at=strtotime($model->public_at);
                return view('admin.home.product.insert', [
                    'errors' =>$validate,
                    'model' => $model,
                    'category' => $category_list, 

                ]);
            }
            return view("admin.home.product.category_product.update", ['model' => $model, 'category' => $category_list]);
        }
        return redirect('admin/category_product/');
    }


    function delete(ProductCategory_model $model){
        
        if ($model) {
            $list_category = ProductCategory_model::get()->toArray();
            // lấy các danh mục con nằm trong nó
            foreach ($list_category as $item) {
                if ($item["id_parent"] == $model['id']) {
                    $category_children = ProductCategory_model::where('id', $item["id"])->first();
                    $category_children->delete=1;
                    $category_children->delete_at=time();
                    History_model::updateChange(History_model::ACTION_DELETE,'product_category',$category_children->id);
                    $category_children->save();
                }
            }
            $model->delete=1;
            $model->delete_at=time();
            if ($model->save()) {
                History_model::updateChange(History_model::ACTION_DELETE,'product_category',$model->id);
                Session::flash('messages', 'Đã xóa thành công danh mục sản phẩm ' . $model->name);
                return redirect('admin/category_product/');
            }
        }
        return redirect('admin/category_product/');
    }

    function get_product_category(Request $request)
    {
        if ($request->isMethod('post')) {
            $category = ProductCategory_model::where(['status'=>1,'delete'=>0])->get();
            return $category;
        } else {
            return redirect('admin/menu/');
        }
    }

}
