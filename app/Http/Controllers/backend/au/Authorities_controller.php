<?php


namespace App\Http\Controllers\backend\Au;
use Illuminate\Http\Request;
use App\Http\Controllers\backend\Controller;
use App\Http\Model\au\Au_model;
use App\Http\Model\au\Group_au_model;
use App\Http\Model\au\Au_user_model;
use App\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
class Authorities_controller extends Controller
{

    function index(){
        $routes = Route::getRoutes();
        foreach ($routes as $value) {
            $tem= (explode("/",$value->uri()));
            if(isset($tem[0])|| $tem[0]){
                if($tem[0]=="admin"){
                    $r =new Au_model();
                    $r->name=$value->uri();
                    $r->url=$value->uri();
                    if(count(Au_model::where("url",$value->uri())->get())==0){
                        Au_model::actionModel($r);
                        
                    }

                }
            }
        }
        $au=Au_model::orderByRaw('id DESC')->paginate(10);
        $au_user=Au_user_model::orderByRaw('id DESC')->paginate(10);
        return view("admin.home.au.index",['au'=>$au_user]);
    }
    
    function create(){
        $au=Au_model::all();
        $model=new Au_user_model();
        return view("admin.home.au.insert", ['au' => $au,'model'=>$model]);
    }

    function create_au(Request $request){
        if ($request->isMethod('post')) {
            $model=new Au_user_model();
            if ($request->name) {
                $model->name=$request->name;
                $check=Au_user_model::actionModel($model);
                if ($check=='true') {
                    return redirect('admin/au/');
                }
            }
        }
    }

    function update($id){
        $au=Au_model::all();
        $model=Au_user_model::find($id);
        $getau=Au_model::join('au_user', 'au_user.id_au', '=', 'au.id')->where('au_user.id_au_user', '=', $model->id)->select('au.id', 'au.name')->distinct()->get();
        return view("admin.home.au.update", ['au' => $au,'model'=>$model,'getau'=>$getau]);
    }

    function update_au(Request $request){
        $model=Au_user_model::find($request->id);
        if($model){
           $model->name=$request->name;
           $check=Au_user_model::actionModel($model);
           if ($check=='true') {
                return redirect('admin/au/');
            }
        }
    }

    function delete($id){
        $model=Au_user_model::find($request->id);
        if($model){
           if ($model->delete()) {
                return redirect('admin/au/');
            }
        }
    }

    function addRouter(Request $request){
        if($request->isMethod('post')){
            $data=$request->data;
            $id=$request->id;
            if($id){
                if(count($data)){
                    foreach ($data as $key) {
                        $model=new Group_au_model();
                        $model->id_au_user=$id;
                        $model->id_au=$key;
                        Group_au_model::actionModel($model);
                    }
                }
            }
            return $id;
        }
    }

    function moveRouter(Request $request){
        if($request->isMethod('post')){
            $data=$request->data;
            $id=$request->id;
            if($id){
                if(count($data)){
                    foreach ($data as $key) {
                    $where['id_au']=$key;
                    $where['id_au_user']=$id;
                    $tem=Group_au_model::where($where)->get();
                        if($tem){
                            $tem->delete();
                        }
                    }
                }
            }
            return $id;
        }
    }

    // return router admin
    public static  function get_router(){
        $data=Auth::user();
        $au=['admin/login','admin/logout'];
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
        return $au;
    }
}