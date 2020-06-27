<?php


namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\site\Introduce_model;
use App\Http\Model\product\Category_product_model;
use Mail;
use App\Http\Model\site\Website_model;

class Site_controller extends Controller
{
    

    public function index($page){
        $page=explode('.',$page);
        $url_page='site/';
        switch ($page[0]){

            case 'gioi-thieu':
                $url_page.='gioi-thieu.html';
                $breadcrumb[] = ['name' => 'Giới thiệu', 'link' => url($url_page)];
                shareBreadcrumb($breadcrumb);
                return $this->introduct('gioi-thieu');
                break;
            case 'lien-he':
                $breadcrumb[] = ['name' => 'Liên hệ', 'link' => url($url_page)];
                shareBreadcrumb($breadcrumb);
                return $this->contact('lien-he');
                break;
        }
        return redirect('/');
   }


   public  function introduct($title){
        $this->writeHistory();
       $introduct=Introduce_model::first();
        return view('view.view.site.introduce',['introduct'=>$introduct,'title'=>$title]);
   }

    public  function contact($title){
        $this->writeHistory();
        $introduct=Introduce_model::first();
        return view('view.view.site.contact',['title'=>$title]);
    }
}
