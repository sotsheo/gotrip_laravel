<?php


namespace App\Http\Controllers\backend;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Http\Model\menu\Category_menu_model;
use App\Http\Model\mews\Category_news_model;
use App\Http\Model\product\Category_product_model;
use App\Http\Model\Widget_model;
use App\Http\Model\menu\Type_widget_model;
use App\Http\Model\menu\Menu_model;
use App\Http\Model\news\News_model;
use App\Http\Model\product\Product_model;
use App\Http\Model\support\Support_model;
use App\Http\Model\menu\Type_support_model;
use App\Http\Model\banner\Banner_model;
use App\Http\Model\banner\Category_banner_model;
use App\Http\Model\product\Manufacturer_model;
use App\Http\Model\site\Html_model;
use App\Http\Model\Website_model;

class Widget_controller extends Controller
{
 
    public $types=array(
        'categorynewsishome',
        'categoryproduct',
        'newsIncategory',
        'newsletter',
        'hotnews',
        'menu',
        'html',
        'banner',
        'pagecontent',
        'introduce',
        'videohot',
        'productcategoryishome',
        'productscorrelate',
        'productgroup',
        'productviewed',
        'productrating',
        'pagesize',
        'sort',
        'fillterprice',
        'productall',
        'albumcategoryishome',
        'albumhot',
        'support',
        'searchbox',
        'cart',
        'star',
        'combocategoryishot',
        'searchCombo',
        'comboSort',
        'comboSortPrice',
        'hotelFilterStar',
        // 'hotelStar',
    );

    function index(){
        $messages= Session::get('messages');
        $widget=Widget_model::orderByRaw("id DESC")->paginate(10);
        return view("admin.home.widget.index",["widget"=>$widget,'messages'=>$messages]);
    }
    function create(Request $request){

        $widget=Widget_model::all();
        if($request->isMethod('post')){
            $wedget=new Widget_model;
            $this->actionModel($wedget,$request);
            return redirect('admin/widget/');
        }
       
        return view("admin.home.widget.insert",['widget'=>$widget,'type'=>$this->types]);
    }
  
    function update($id,Request $request){
        $wedget= Widget_model::where('id',$id)->first();
        if($wedget){
            if($request->isMethod('post')){
                $wedget=Widget_model::where('id',$request->id)->first();
                if($wedget){
                    $this->actionModel($wedget,$request);
                    return redirect('admin/widget/');
                }
            }
            return view("admin.home.widget.update",['wedget'=>$wedget,'type'=>$this->types]);
        }
        return redirect('admin/widget/');
    }

    function delete($id){
        $wedget=Widget_model::where('id',$id)->first();
        if($wedget){
            $name=$wedget->name;
            if($wedget->delete()){
                 Session::flash('messages', 'Đã xoá thành công danh widget '.$name);
            }
        }
        return redirect('admin/widget/');
    }


    function actionModel($wedget,$request){
                $wedget->name='';
                if($request->name){
                     $wedget->name=$request->name;
                }
                $wedget->type=0;
                if($request->type){
                     $wedget->type=$request->type;
                }
                $wedget->number_type=0;
                if($request->number_type){
                     $wedget->number_type=$request->number_type;
                }
                $wedget->text_head='';
                if($request->text_head){
                    $wedget->text_head=$request->text_head;
                }
                $wedget->id_category=0;
                if($request->id_category){
                     $wedget->id_category=$request->id_category;
                }
                $wedget->limit=0;
                if($request->limit){
                     $wedget->limit=$request->limit;
                }
                if($request->limit_category){
                 $wedget->limit_category=$request->limit_category;
                }
                $wedget->show_name=0;
                if($request->get('show_name')){
                    $wedget->show_name=$request->get('show_name');
                }
                if($wedget->save()){
                    Session::flash('messages', 'Đã sửa thành công danh widget '.$wedget->name);
                }
    }
    

}
