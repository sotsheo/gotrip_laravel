<?php
namespace App\Http\Controllers\backend;
use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Model\site\Website_model;
use App\Http\Model\Restore_model;
use Illuminate\Support\Facades\Input;
class Restore_controller extends Controller{

	function index(Request $request){
		$table_list=Restore_model::getTables();
        if($request->isMethod('post')) {
            $table=$request->input('table');
            $date=$request->input('date');
            $type=$request->input('type');
            $table_root=array_keys(Restore_model::getTables());
            if($table && in_array($table, $table_root)){
                $restore=new Restore_model($table);
                $date=explode('/', $date);
                $time_start=mktime(0, 0, 0, $date[1], $date[0], $date[2]);
                $time_end=mktime(23, 59, 59, $date[1], $date[0], $date[2]);
                $data=$restore->where('delete_at','>=',$time_start)->where('delete_at','<',$time_end)->get();
                // xóa
                if($type==2 && $data){
                    foreach ($data as $key) {
                        $tem=$restore->find($key->id);
                        if($tem){
                            $tem->delete();
                        }
                        
                    }
                }
                if($type==1 && $data){
                    foreach ($data as $key) {
                        $tem=$restore->find($key->id);
                        if($tem){
                            $tem->delete=0;
                            $tem->save();
                        }
                    }
                }
            }
            
        }
		return view("admin.home.restore.index",['table_list'=>$table_list]);
	}

	function getDate(Request $request){
		if($request->isMethod('post')) {
            $table=$request->input('table');
            $table_root=array_keys(Restore_model::getTables());
            if($table && in_array($table, $table_root)){
                $restore=new Restore_model($table);
                $data=$restore->getDate();
                if($data){
                    return [
                        'code'=>200,
                        'messages'=>$data
                    ];
                }
            }
            return [
                'code'=>400,
                'messages'=>'Không có dữ liệu khôi phục.'
            ];
           
        }
	}

}
