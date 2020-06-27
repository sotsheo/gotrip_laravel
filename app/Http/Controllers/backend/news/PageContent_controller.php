<?php


namespace App\Http\Controllers\backend\news;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\news\PageContent_model;
use App\Http\Model\Websites_model;
use Illuminate\Support\Facades\Input;
use App\Http\Model\history\History_model;
use App\Http\Model\site\Website_model;
class PageContent_controller extends Controller
{
   
   
    function index(){
        $w = Website_model::find(self::WEB);
        $news=PageContent_model::where(['status'=>1,'delete'=>0])->orderByRaw('orders ASC,id DESC')->paginate($w->pagesize);
        $messages= Session::get('messages');
    	return view("admin.home.page.index",['news'=>$news,'messages'=>$messages]);
    }
    
    function create(Request $request){
        $model=new PageContent_model;
        $model->public_at = strtotime(date('d/m/Y'));
        if($request->isMethod('post')){
            
            $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){                
                $model->create($inputs);
                History_model::updateChange(History_model::ACTION_CREATE,'pagecontent',$tem->id);
                return redirect('admin/pagecontent/');
            }
            $model->fill($inputs);
            $model->public_at=strtotime($model->public_at);
            return view('admin.home.page.insert',[
                'errors' =>$validate,
                'model' => $model]);
        }
        return view("admin.home.page.insert",['model'=>$model]);
    }
   

    function update(PageContent_model $model,Request $request){
        // $news=PageContent_model::where("id",$id)->first();
        if($model){
            if($request->isMethod('post')){
                    $inputs = Input::all();
                    $validate=$model->validate($request);
                    if(!$model->validate($request)){        
                        $model_old=$model;         
                        if(History_model::updateChange(History_model::ACTION_UPDATE,'news',$model->id,$model_old,$inputs)){
                            $model->update($inputs);
                            return redirect('admin/pagecontent/');
                        }  
                    }
                    $model->fill($inputs);
                    return view('admin.home.page.update',[
                        'errors' =>$validate,
                        'model' => $model]);
            }    
            return view("admin.home.page.update",['model'=>$model]);
        }
        return redirect('admin/pagecontent/');
    }
    

    function delete(PageContent_model $model){
        //  Check xem co tồn tại không
        if($model){
            $model->delete=1;
            $model->delete_at=time();
            if( $model->save()){
                History_model::updateChange(History_model::ACTION_DELETE,'pagecontent',$model->id);
                Session::flash('messages', 'Đã xóa  thành công bài viết');
                return redirect('admin/pagecontent/');
            }
        }
        return redirect('admin/pagecontent/');
    }
    // //  hàm tạo url

    public function get_page_content(){
        $category=PageContent_model::all();
        $data['category']=$category;
        return $category;
    }
}   
