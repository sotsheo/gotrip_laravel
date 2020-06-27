<?php


namespace App\Http\Controllers\backend\site;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\site\Recruitment_model;
use Illuminate\Support\Facades\Input;
use App\Http\Model\site\Website_model;
class Recruitment_controller extends Controller
{

    function index(){
         $w = Website_model::find(self::WEB);
        $messages= Session::get('messages');
        $recruitment=Recruitment_model::paginate($w->pagesize);
        return view("admin.home.recruitment.index",["recruitment"=>$recruitment,'messages'=>$messages]);
    }

    /*
     *
     * Tạo bài viết tuyển dụng
     * */
    function create(Request $request){
        $recruitment=new Recruitment_model;
        $recruitment->order=0;
        $recruitment->date_created=strtotime(date('d/m/Y'));
        $recruitment->date_deadline=strtotime(date('d/m/Y'));
        if($request->isMethod('post')) {
            $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){   
                // $model->public_at=strtotime($model->public_at);             
                $model->create($inputs);
                return redirect('admin/recruitment/');
            }
            $model->fill($inputs);
            $model->public_at=strtotime($model->public_at);
            return view('admin.home.recruitment.insert', [
                'errors' =>$validate,
                'model' => $model,
                "category" =>$tem]);
            
        }
        return view("admin.home.recruitment.insert",["model"=>$recruitment]);
    }

   

    function update(Recruitment_model $model,Request $request){

        if ($model) {
            if($request->isMethod('post')) {
                $inputs = Input::all();
                $validate=$model->validate($request);
                if(!$model->validate($request)){   
                    // $model->public_at=strtotime($model->public_at);             
                    $model->update($inputs);
                    return redirect('admin/recruitment/');
                }
                $model->fill($inputs);
                $model->public_at=strtotime($model->public_at);
                return view('admin.home.recruitment.update', [
                    'errors' =>$validate,
                    'model' => $model,
                    "category" =>$tem]); 
            }
            return view("admin.home.recruitment.update", [
                'model' => $model,
            ]);
        }
        return redirect('admin/recruitment/');
    }

    // function edit_post(Request $request){
    //     if ($request->isMethod('post')) {
    //         $model = Recruitment_model::find($request->id);
    //         $check = Recruitment_model::actionModel($model, $request);
    //         if ($check == 'true') {
    //             return redirect('admin/recruitment/');
    //         }
    //         return view('admin.home.recruitment.edit', [
    //             'errors' => $check['validation'],
    //             'model' => $check['model']]);
    //     }
    // }

    function delete(Recruitment_model $model){
        if($model){
            $model->delete();
        }
        return redirect('admin/recruitment/');

    }

}
