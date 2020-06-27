<?php


namespace App\Http\Controllers\backend\news;

use App\Http\Controllers\backend\Controller;
use App\Http\Controllers\backend\ClCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\news\NewsCategory_model;
use App\Http\Model\news\News_model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Model\history\History_model;
use App\Http\Model\site\Website_model;

class NewsCategory_controller extends Controller
{
    var $categorys=[];
    public function __construct(){
        $category = NewsCategory_model::where(['delete'=>0])->groupBy("order");
        View::share('model.categorynews.index', $category);
    }

    

//    Index
    function index(){
        $w = Website_model::find(self::WEB);
        $messages = Session::get('messages');
        $category = NewsCategory_model::where(['delete'=>0])->paginate($w->pagesize);
        // tất cả danh mục bài viết
        $data=[];
        $i=0;
        $this->showCategories($category);
        $this->new_data=$this->categorys;
        if (count($category)) {
            // $this->showCategories($category);
            return view("admin.home.news.category_news.index", ["category_news" => $this->new_data,"category" => $category, 'messages' => $messages,'category'=>$category]);
        } else {
            return view("admin.home.news.category_news.index", ["category_news" => $this->new_data,"category_" => $category, 'messages' => $messages,'category'=>$category]);
        }
    }

    function create(Request $request){
        $model = new NewsCategory_model;
        $model->orders = 0;
        $model->date_create = time();
        $model->date_public = time();
        $category=NewsCategory_model::where(['status'=>1,'delete'=>0])->get();
        $tem=[0=>'Danh mục '];
        foreach($category as $cate){
            $tem[$cate['id']]=$cate['name'];
        }
        if ($request->isMethod('post')) {
            $inputs = Input::all();
            $validate=$model->validate($request);
            // $model->bind($inputs);
            if(!$model->validate($request)){
                $tem=$model->create($inputs);
                History_model::updateChange(History_model::ACTION_CREATE,'news_category',$tem->id);
                return redirect('admin/category_news/');
            }
            $model->fill($inputs);
            $model->created_at=strtotime(date('d/m/Y'));

            return view('admin.home.news.category_news.insert', [
                'errors' =>$validate,
                'model' => $model,
                "category" =>$tem]);
        }
        return view("admin.home.news.category_news.insert", ["category" =>$tem , 'model' => $model]);
    }

    

    function update(NewsCategory_model $model,Request $request){
        if ($model) {
            $list_category = NewsCategory_model::where('id', '!=', $model->id)->get();
             $tem=[0=>'Danh mục '];
            foreach($list_category as $cate){
                $tem[$cate['id']]=$cate['name'];
            }
            if ($request->isMethod('post')) {
                $inputs = Input::all();
                $validate=$model->validate($request);
                if(!$model->validate($request)){

                    $model_old=$model;  
                    if(History_model::updateChange(History_model::ACTION_UPDATE,'news_category',$model->id,$model_old,$inputs)){
                        $model->update($inputs);
                        
                    }  
                    return redirect('admin/category_news/');
                }
                $model->fill($inputs);
                return view('admin.home.news.category_news.update', [
                    'errors' =>$validate,
                    'model' => $model,
                    "category" =>$category]);
                
            }
            return view("admin.home.news.category_news.update", [
                'model' => $model,
                'category' => $tem
            ]);
        }
        return redirect('admin/category_news/');
    }

    

    function get_news_category(Request $request)
    {
        if ($request->isMethod('post')) {
            $category = NewsCategory_model::where(['status'=>1,'delete'=>0])->get();
            return $category;
        } else {
            return redirect('admin/menu/');
        }
    }

    function delete(NewsCategory_model $model)
    {

        if ($model) {
            $list_category = NewsCategory_model::where(['status'=>1,'delete'=>0])->get();
            // lấy các danh mục con nằm trong nó
            foreach ($list_category as $item) {
                if ($item["id_parent"] == $model['id']) {
                    $category_children = Category_news_model::find($item["id"]);
                    $category_children->delete=1;
                    $category_children->delete_at=time();
                    History_model::updateChange(History_model::ACTION_DELETE,'news_category',$category_children->id);
                    $category_children->save();
                }
            }
            $name = $model->name;
            $model->delete=1;
            $model->delete_at=time();
            if ($model->save()) {
                 History_model::updateChange(History_model::ACTION_DELETE,'news_category',$model->id);
                Session::flash('messages', 'Đã xóa thành công danh bài viết ' . $name);
                return redirect('admin/category_news/');
            }
        }
        return redirect('admin/category_news/');
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
}
