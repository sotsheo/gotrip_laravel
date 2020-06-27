<?php

namespace App\Http\Model\province;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
class Province_model extends Model
{
    protected $table = 'province';
    public $timestamps=false;
   	
   	public static function getName($id){
   		$data=Province_model::find($id);
   		return ($data)?$data['name']:'';
   	}

   	public static function getArrayProvince(){
   		$data=Province_model::get();
   		$cat=[0=>'Thành phố...'];
   		if($data){
   			foreach ($data as $key => $value) {
   				$cat[$value->id]=$value->name;
   			}
   		}
   		return $cat;
   	}
}
