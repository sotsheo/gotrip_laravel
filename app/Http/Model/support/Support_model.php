<?php

namespace App\Http\Model\support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
class Support_model extends Model
{
    protected $table = 'support';
    public $timestamps=false;
    //
    public  static  function actionModel($request){
        if(isset($request->count)){
            for ($i=1; $i <=$request->count ; $i++) {
                $index='item_type_id_'.$i;
                $id_type=$request->input($index);
                $index='item_name_'.$i;
                $name=$request->input($index);
                $index='item_link_'.$i;
                $link=$request->input($index);
                if($id_type){
                    $supports=Support_model::where("id_type",$id_type)->first();
                    if($supports){
                        $support=Support_model::find($supports->id);
                        if($name){
                            $support->name=$name;
                        }
                        if($link){
                            $support->link=$link;
                        }
                        $support->save();
                    }
                    else{
                        $support=new Support_model;
                        $support->name='';
                        $support->link='';
                        if($name){
                            $support->name=$name;
                        }
                        if($link){
                            $support->link=$link;
                        }
                        $support->id_type=$id_type;
                        $support->save();
                    }
                    Session::flash('messages', 'Đã thêm thành công ');
                    return 'true';
                }
            }

        }

    }
   public static function getSupport(){
        $support=Support_model::join('type_support', 'type_support.id', '=', 'support.id_type')->select('support.*','type_support.name as name_type')->get();
        return $support;
    }
}
