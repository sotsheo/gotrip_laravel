<?php

namespace App\Http\Model\site;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Cookie;
class Lang_model extends Model
{

	function tableLang($name){
		if(Session::get('lang')!='vi'){
			return Session::get('lang').'_'.$name;
		}
		else{
			return $name;
		}
	}


}
