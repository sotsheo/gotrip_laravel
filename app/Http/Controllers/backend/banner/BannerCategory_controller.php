<?php


namespace App\Http\Controllers\backend\banner;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\banner\Banner_model;
use  App\Http\Model\banner\BannerCategory_model;
use App\Http\Model\Websites_model;
use Illuminate\Support\Facades\Input;
use App\Http\Model\history\History_model;
use App\Http\Model\site\Website_model;
class BannerCategory_controller extends Controller{
   
    function index(){
         $w = Website_model::find(self::WEB);
        $messages= Session::get('messages');
        $category=BannerCategory_model::where(['status'=>1,'delete'=>0])->paginate($w->pagesize);
        return view("admin.home.banner.category_banner.index",["category_banner"=>$category,'messages'=>$messages]);
    }

    function create(Request $request){
        $model=new BannerCategory_model;
         if($request->isMethod('post')){
             $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){                
                $tem=$model->create($inputs);
                History_model::updateChange(History_model::ACTION_CREATE,'category_banner',$tem->id);
                return redirect('admin/category_banner/');
            }
            $model->fill($inputs);
            $model->public_at=strtotime($model->public_at);
            return view('admin.home.banner.category_banner.insert',[
                'errors' =>$validate,
                'model' => $model]);
            
        }
    	return view("admin.home.banner.category_banner.insert",['model'=>$model]);

    }
    // function create_cat(Request $request){
       
    //     return redirect('admin/banner/');

    // }
    function update(BannerCategory_model $model,Request $request){
       if($model){
            if($request->isMethod('post')){
                $inputs = Input::all();
                $validate=$model->validate($request);
                if(!$model->validate($request)){                
                    $model_old=$model;  
                    if(History_model::updateChange(History_model::ACTION_UPDATE,'category_banner',$model->id,$model_old,$inputs)){
                        $model->update($inputs);
                        return redirect('admin/category_banner/');
                    }  
                   
                }
                $model->fill($inputs);
                $model->public_at=strtotime($model->public_at);
                return view('admin.home.banner.category_banner.update',[
                    'errors' =>$validate,
                    'model' => $model]);
            }
            return view("admin.home.banner.category_banner.update",['model'=>$model]);
       }
       return redirect('admin/category_banner/');
    }
   
    function delete($id){
        //  Check xem co tồn tại không

       $category=BannerCategory_model::where('id',$id)->first();
       
        if($category){
            $category->delete=1;
            $category->delete_at=time();
            if( $category->save()){
                History_model::updateChange(History_model::ACTION_DELETE,'banner_category',$category->id);
                Session::flash('messages', 'Đã xóa thành công danh mục banner '. $category->name);
                return redirect('admin/category_banner/');
            }
        }
        return redirect('admin/category_banner/');

    }

   // đệ quy vòng lặp lấy category
   function showCategories($categories, $parent_id = 0, $char = '') {
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

    public function getListbannerCategory($id_category){
        $category=BannerCategory_model::where('id',$id_category)->first();
        $banner=[];
        if($category){
             $banner=Banner_model::where("id_category",$category->id)->where("id_site",$w->id)->get();
            return $banner;
        }
       
        return $banner;

    }
   
}
