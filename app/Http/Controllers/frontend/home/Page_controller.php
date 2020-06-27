<?php


namespace App\Http\Controllers\frontend\home;

use App\Http\Controllers\frontend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\news\PageContent_model;
use App\Http\Model\site\Website_model;
use Mail;

class Page_controller extends Controller
{
   

   public static function category($category_id,$wb){
      $this->writeHistory();
       $category = PageContent_model::where('id', $category_id)->first();
       $page = $wb->page_size;
       if ($category) {
           // lấy tin tức thuộc danh mục trên
           $news = News_model::where('id_category', $category->id)->paginate($page);
           // // kiểm tra xem no có layout khác k
           $breadcrumb[] = ['name' => $category->name, 'link' => url($category->link)];
           shareBreadcrumb($breadcrumb);
           if (view()->exists($category->view)) {
               $view = "view.view.news." . $category[0]->view;
               return view($view, ['category' => $category, 'news' => $news]);
           } else {
               return view("view.view.news.category", ['category' => $category, 'news' => $news]);
           }
       }
   }
   public static function detail($page){
   	  $this->writeHistory();
   	 $url_news = explode('-', $page);
   	 if (isset($url_news[count($url_news) - 2]) &&  $url_news[count($url_news) - 2]== 'nd') {
   	 	$news = explode('.', $url_news[count($url_news) - 1]);
   	 	$news = PageContent_model::where('id', $news)->first();
   	 	if (view()->exists($news->view)) {
             $view = "view.view.page." . $category[0]->view;
               return view($view, ['news' => $news]);
           } else {
               return view("view.view.page.detail", [ 'news' => $news]);
           }
   	 	return $news;
   	 }
     return redirect('/');
   }

}
