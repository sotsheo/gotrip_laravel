<?php


namespace App\Http\Controllers\frontend\home;

use App\Http\Controllers\frontend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\News\News_model;
use App\Http\Model\Site\Website_model;
use App\Http\Model\News\NewsCategory_model;
use Mail;

class News_controller extends Controller
{
   
   public static function category($url_seo,NewsCategory_model $model){
      $this->writeHistory();
      $wb = Website_model::find(self::WEB);
      $page = $wb->page_size;
      if ($model) {
           // lấy tin tức thuộc danh mục trên
           $news = News_model::where('id_category', $model->id)->paginate($page);
           // // kiểm tra xem no có layout khác k
           $breadcrumb[] = ['name' => $model->name, 'link' => url($model->link)];
           shareBreadcrumb($breadcrumb);
           if (view()->exists($model->view)) {
               $view = "view.news." . $model[0]->view;
               return view($view, ['category' => $model, 'news' => $news]);
           } else {
               return view("view.news.category", ['category' => $model, 'news' => $news]);
           }
      }
   }
   public static function detail($url_seo,News $model){
       $this->writeHistory();
       $category=NewsCategory_model::where(['id'=>$model->id_category])->first();
       $breadcrumb[] = ['name' => $category->name, 'link' => url($category->link)];
       $breadcrumb[] = ['name' => $news->name, 'link' => url($news->link)];
       shareBreadcrumb($breadcrumb);
       if ($category->view_detail) {
           $view = "view.news." . $category->view_detail;
           return view($view, ['category' => $category, 'news' => $news]);
       } else {
           return view("view.news.detail", ['category' => $category, 'news' => $news]);
       }
   }

}
