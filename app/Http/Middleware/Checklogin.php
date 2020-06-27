<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Http\Model\au\Au_model;
use App\Http\Model\au\Group_au_model;
use App\Http\Model\au\Au_user_model;
use App\Http\Model\site\Website_model;
class Checklogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
   

    public $url_admin="/gotrip_laravel/";

    public function check_quyen($authorities){
      $check=0;
      if($authorities!=1){
        $url_segment = \Request::segment(2);
        switch ($url_segment) {
          case 'widget':
              $check=1;
            break;
          case 'website':
              $check=1;
            break;
          case 'form':
              $check=1;
            break;
          default:
            # code...
            break;
        }
      }
     return $check;
     
    }

    public function handle($request, Closure $next)
    { 
       $w = Website_model::find(1);
         // kiểm tra url có login và đã đăng nhập rồi thì cho và trang user
        $admin = \Request::segment(1);
        $admin_v2 = \Request::segment(2);
        
        if(Auth::check() && $admin_v2=='login'){
          if($w->type_website==1){
            return redirect('admin/news/');
          }
          if($w->type_website==2){
            return redirect('admin/product/');
          }
        }
        if($admin && Auth::check() && !$admin_v2){  
          if($w->type_website==1){
            return redirect('admin/news/');
          }
          if($w->type_website==2){
            return redirect('admin/product/');
          }
        }
        if($admin && !Auth::check() && $admin_v2){  
          return redirect('admin/');
        }
        
       //  // nếu chưa đang nhập và cố tình về trang user thì bắt quay lại đang nhập
       else if(!Auth::check() && !$request->is('admin') && $request->is('register')){
           return redirect()->route("index");
        }
        // kiem tra da dang nhap chua
        else{
         
             $all_router=$this->checkRouter();
            //  print_r($all_router);
            // die();
             // kiểm tra quyền khi đã đăng nhập
             if($all_router!=0){
                if($w->type_website==1){

                    return redirect('admin/news/');
                }
                if($w->type_website==2){
                  return redirect('admin/product/');
                }
            }
            return $next($request);
        }
    }

    function checkRouter(){
      $data=Auth::user();
      $au=['admin/login','admin/logout','admin','admin/news','admin/product'];
      $checks=0;
      $url=$_SERVER['REQUEST_URI'];
      // locall
      $url=str_replace($this->url_admin,'',$url);
      // server
      // $url=explode('/',$url);
      // unset($url[0]);
      // $url=implode('/',$url);

      $temv=explode('?',$url);
      if(isset($temv[1])){
        $url=$temv[0];
      }
      if($data){
            if($data->authorities==1){
                $tem=Au_model::all();
                foreach($tem as $t){
                    array_push($au,$t->url);
                }
            }else{
                $tem=Group_au_model::where('id_au_user',$data->au_list)->get();
                if($tem){
                    foreach($tem as $t){
                        $tb=Au_model::find($t->id_au);
                        array_push($au,$tb->url);
                    }
                }
            }
        }
      if(!in_array($url,$au)){
          foreach ($au as $r) {
            $checks=1;
              if (strpos($r, '{model}') !== false) {
                $totalSegsCount = count(\Request::segments());
                if(str_replace(\Request::segment($totalSegsCount),'',$url)==str_replace("{model}",'',$r)){
                  $checks=0;
                  break;
                }
                
              }
            }   
          }
        return $checks;
    }
}

