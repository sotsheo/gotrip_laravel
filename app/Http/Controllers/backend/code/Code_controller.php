<?php


namespace App\Http\Controllers\backend\code;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Model\code\Code_model;
use App\Http\Model\code\CodeItem_model;
use App\Http\Model\history\History_model;

use Mail;
use App\Http\Model\site\Website_model;
class Code_controller extends Controller
{
    function index(){
    	$w = Website_model::find(self::WEB);
        $model = Code_model::where(['delete'=>self::NOT_ACTIVE])
        ->orderByRaw('id DESC')
        ->paginate($w->pagesize);

        $messages = Session::get('messages');
        return view("admin.home.code.code.index", ['model' => $model]);
    }

  	function create(Request $request){
  		$model=new Code_model;
		$model->time_start = strtotime(date('d-m-Y'));
		$model->time_end = strtotime(date('d-m-Y'));
		
		if ($request->isMethod('post')) {
            $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){   
                // $model->public_at=strtotime($model->public_at);             
                $tem=$model->create($inputs);
                if($tem->id){
                	for($i=0;$i<$tem->number_code;$i++){
						$code_item=new CodeItem_model;
	                	$code_item->code_id=$tem->id;
	                	$code_tem=$code_item->save();
	                	if($code_item->id){
	                		$code_item->key=$tem->prefix.$this->generateRandomString(5);
	                		$code_item->save();
	                	}
                	}
                	
                }
                //History_model::updateChange(History_model::ACTION_CREATE,'news',$tem->id);
                return redirect('admin/code/');
            }
            $model->fill($inputs);
            //$model->public_at=strtotime($model->public_at);
            return view('admin.home.code.code.insert', [
                'errors' =>$validate,
                'model' => $model
            ]);

		}
		return view("admin.home.code.code.insert",["model"=>$model]);
    }

    function update(Code_model $model,Request $request){
        $code_item=CodeItem_model::where(['code_id'=>$model->id])->get();
        return view("admin.home.code.code.update",["model"=>$model,"code_item"=>$code_item]);
    }

    protected function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


        
}   
