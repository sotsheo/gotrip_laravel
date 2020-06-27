<?php


namespace App\Http\Controllers\backend\history;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\banner\Banner_model;
use App\Http\Model\banner\BannerCategory_model;
use App\Http\Model\Websites_model;
use Illuminate\Support\Facades\Input;
use App\Http\Model\history\History_model;
use App\Http\Model\history\HistoryItem_model;
use App\Http\Model\history\TableTem_model;
use App\Http\Model\site\Website_model;
class History_controller extends Controller{
//https://www.freemysqlhosting.net/account/?msg=943
    function index(){
         $w = Website_model::find(self::WEB);
        $messages= Session::get('messages');
        $history=History_model::orderByRaw('id DESC')->paginate($w->pagesize);
        return view("admin.home.history.index",["history"=>$history]);
    }

    function update(History_model $model){
    	$table=new TableTem_model($model->name_table);
    	$models=$table->find($model->colum_id);
    	$data=HistoryItem_model::where(['history_id'=>$model->id])->get();
    	if($data){
    		return view("admin.home.history.update",["models"=>$models,"model"=>$model,"data"=>$data]);
    	}
    	
    }

    function retore(Request $request){
        if($request->isMethod('post')){
            $id=$request->input('id');
            $model=HistoryItem_model::find($id);

            if($model){
                if($model->value_old!=$model->value_new){
                    $history=History_model::find($model->history_id);
                    if($history){
                        $table=new TableTem_model($history->name_table);
                        $table=$table->find($history->colum_id);
                        if($table){
                            $table[$model['name']]=$model->value_old;
                            if($table->save()){
                                return ['code'=>200,'messages'=>'Đã khôi phục thành công!'];
                            }
                            
                        }
                    }
                }
            }
            
        }
        return ['code'=>400,'messages'=>'Không thể chuyển khôi phục!'];
    }


    function restore(History_model $model,Request $request){
        die();
    }

}
