<?php

namespace App\Http\Controllers\frontend\home;

use App\Http\Controllers\frontend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\album\Album_model;
use App\Http\Model\album\AlbumCategory_model;

use Mail;
use App\Http\Model\site\Website_model;
class Video_controller extends Controller
{
    
   	public function index(){
   		$this->writeHistory();
   		return view("view.view.video.index"); 
   	}

   	function category($id,$wb){
   		$this->writeHistory();
   	}

   	function detail($id,$wb){
   		$this->writeHistory();
   	}
}
