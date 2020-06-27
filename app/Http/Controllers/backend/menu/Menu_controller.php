<?php


namespace App\Http\Controllers\backend\menu;

use App\Http\Controllers\backend\Controller;
use App\Cl\ClCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\menu\Menu_model;
use App\Http\Model\menu\MenuCategory_model;
use App\Http\Model\news\News_model;
use App\Http\Model\news\PageContent_model;
use App\Http\Model\news\NewsCategory_model;
use App\Http\Model\product\Product_model;
use App\Http\Model\product\ProductCategory_model;
use App\Http\Model\Websites_model;
use Illuminate\Support\Facades\Input;
use App\Http\Model\Album\AlbumCategory_model;
class Menu_controller extends Controller
{

    function index(){
       $messages= Session::get('messages');
       $category=MenuCategory_model::all();
       $menu=Menu_model::orderBy('orders')->get();
       $this->new_data=[];
       // lặp dữ liệu
       $data=[];
        foreach($category as $key){
            foreach($menu as $item){
                if($item->id_category==$key->id){
                       $data[$item->id_category][]= $item;
                }
            }
        }
        // print_r($data);
        // die();
        foreach($data as $key =>$items){
            $this->sortArrays($items);
            $this->new_data[$key]=$this->sorts;
        }

        return view("admin.home.menu.index",['category'=>$category,'menu'=>$this->new_data,'messages'=>$messages]);
       
    }
    function create_category(Request $request){
        $model=new MenuCategory_model;
        $model->date_create = time();
        if($request->isMethod('post')){
        	$inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){   
                // $model->public_at=strtotime($model->public_at);             
                $model->create($inputs);
                return redirect('admin/menu/');
            }
            $model->fill($inputs);
            return view('admin.home.menu.insert_category', [
                'errors' =>$validate,
                'model' => $model]);

        }
    	return view("admin.home.menu.insert_category",['model'=>$model]);

    }

    // Xoá phần category menu
    function delete_category(MenuCategory_model $model){
        if($model){
            // xoa nhung menu nam trong menu category
            $data=Menu_model::where('id_category',$model->id)->get();
            foreach ($data as $key => $menu) {
                // xoa du lieu
                $result=Menu_model::find($menu->id);
                if($result){
                    $result->delete();
                }
            }
            Session::flash('messages', 'Đã xóa thành công menu '.$model->name);
             $model->delete();
        }
         return redirect('admin/menu/');
        
    }

    function update_category(MenuCategory_model $model,Request $request){
        if($model){
        	if($request->isMethod('post')){
	        	$inputs = Input::all();
	            $validate=$model->validate($request);
	            if(!$model->validate($request)){   
	                // $model->public_at=strtotime($model->public_at);             
	                $model->update($inputs);
	                return redirect('admin/menu/');
	            }
	            $model->fill($inputs);
	            return view('admin.home.menu.update_category', [
	                'errors' =>$validate,
	                'model' => $model]);

        	}
            return view("admin.home.menu.update_category",['model'=>$model]);
        }
         return redirect('admin/menu/');
    }


    function update_category_p(Request $request){
         if($request->isMethod('post')){
             $category= MenuCategory_model::find($request->id);
             $check=MenuCategory_model::actionModel($category,$request);
             if ($check=='true') {
                 return redirect('admin/menu/');
             }
             if(isset($check['validation'])){
                 return view('admin.home.menu.update',[
                     'errors'=>$check['validation'],
                     'model'=>$check['model'],
                     "category" => $category]);
             }
        }
         return redirect('admin/menu/');
    }


     // Phần menu 
    function create_menu_id(MenuCategory_model $category,Request $request){
        //$category= MenuCategory_model::where('id',$id)->first();
        $menu= Menu_model::getAllMenu($category->id);
        $this->showCategories($menu);
        $tem=['0'=>'Danh mục cha '];
        $tem+=$this->categorys;
        // $menu=$tem->categorys;
        // Lấy tất cả du liệu về đường dẫn 
        $links=Menu_model::getLinkmenu();
        //  kiểm tra sự tồn tại của category
        $model=new Menu_model;
        $model->orders=0;
        $model->type=1;
        if($category){
            if($request->isMethod('post')){
                $inputs = Input::all();
                $inputs['id_category']=$category->id;
                $validate=$model->validate($request);
                if(!$model->validate($request)){    
                    $model->create($inputs);
                    return redirect('admin/menu/');
                }
                $model->fill($inputs);
                return view('admin.home.menu.insert_menu',[
                    'errors'=>$validate,
                    'model'=>$model,
                    'category'=>$tem,
                    'links'=>$links 
                ]);

            }
            return view("admin.home.menu.insert_menu",[
                'category'=>$tem,
                'model'=>$model,
                'links'=>$links
                 
            ]);
        }
        return redirect('admin/menu/');

    }
    function create_menu_id_cr(Request $request){
        
         return redirect('admin/menu/');
    }

    function update_menu(Menu_model $model,Request $request){
       //$menu=Menu_model::where('id',$id)->first();
        $menu= Menu_model::getAllMenu($model->id_category,$model->id);
        $this->showCategories($menu);
        $tem=['0'=>'Danh mục cha '];
        $tem+=$this->categorys;
        $links=Menu_model::getLinkmenu();
        if($model){
            if($request->isMethod('post')){
                $inputs = Input::all();
                $validate=$model->validate($request);
                if(!$model->validate($request)){   
                        // $model->public_at=strtotime($model->public_at);             
                    $model->update($inputs);
                    return redirect('admin/menu/');
                }
                $model->fill($inputs);
                return view('admin.home.menu.update_menu',[
                    'errors'=>$validate,
                    'model'=>$model,
                    'category'=>$tem,
                    'links'=>$links 
                ]);
            }
           return view('admin.home.menu.update_menu',[
                'model'=>$model,
                'category'=>$tem,
                'links'=>$links 
            ]);
        }
        return redirect('admin/menu/');
    }

    function update_menu_p(Request $request){
       if($request->isMethod('post')){
        $menu=Menu_model::where('id',$request->id)->first();
         $time=strtotime(date("d-m-Y h:i:s"));
         if($menu){
             $check=Menu_model::actionModel($menu,$request);
             if ($check=='true') {
                 return redirect('admin/menu/');
             }
              $links=Menu_model::getLinkmenu();
             if(isset($check['validation'])){
                 return view('admin.home.menu.insert_menu',[
                     'errors'=>$check['validation'],
                     'model'=>$check['model'],
                     'category'=>$menu,
                     'id_category'=>$request->id_category,
                     'links'=>$links
                 ]);
             }
         }
       }
        return redirect('admin/menu/');
    }
    

    function delete_menu($id){
        //  Check xem co tồn tại không

        $menu=Menu_model::where('id',$id)->first();
        if($menu){
            $category=Menu_model::where('id_parent',$menu->id)->get();
            if($category){
                 foreach ($category as $key => $item) {
                     $item->delete();
                 }
             }
              $category_p= MenuCategory_model::find($menu->id_category);
            if( $menu->delete()){
                Session::flash('messages', 'Đã chỉnh sửa thành công menu thuộc '.$category_p['name']);
                return redirect('admin/menu/');
            }
            
        }
       return redirect('admin/menu/');
    }

    
    public static function menu_get(){
        $category=MenuCategory_model::all();
        $data['category']=$category;
        return $data;
       
    }
   
  
}
