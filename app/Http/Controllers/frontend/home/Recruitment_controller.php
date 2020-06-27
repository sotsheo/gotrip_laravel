<?php


namespace App\Http\Controllers\frontend\Home;

use App\Http\Controllers\frontend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\Recruitment_model;
use App\Http\Model\site\Website_model;
class Recruitment_controller extends Controller
{
    
    function index($page){
        $this->writeHistory();
        $title='Tuyển dụng';
        $breadcrumb[]= ['name' =>'Tuyển dụng', 'link' => url('/recruitment/index')];
        $array_category = explode('-', $page);
        if ($array_category[count($array_category) - 2] == 'rm') {
            $id = explode('.', $array_category[count($array_category) - 1]);
            $category_find = Recruitment_model::find($id[0]);
            if ($category_find) {
                $breadcrumb[]= ['name' =>$category_find->name, 'link' => url($category_find->link)];
                shareBreadcrumb($breadcrumb);
                return view("view.view.recruitment.detail",["recruitment"=>$category_find]);
            }
        }
        shareBreadcrumb($breadcrumb);
        $recruitment=Recruitment_model::paginate(10);
        return view("view.view.recruitment.index",["recruitment"=>$recruitment,'title'=>$title]);
    }
}
