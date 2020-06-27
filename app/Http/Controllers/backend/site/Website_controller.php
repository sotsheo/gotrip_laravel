<?php


namespace App\Http\Controllers\backend\site;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Reponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Model\site\Website_model;
use Illuminate\Support\Facades\Session;
use File;

class Website_controller extends Controller
{
	function index(){
		
		$w=Websites_model::all();
		return view("admin.home.website.index");
	}
	function create_theme(){
		return view("admin.home.website.insert");
	}
	function create_themes(Request $request){
		if($request->isMethod('post')){
			$w=new Websites_model;
			$w->name=$request->name;
			$w->img='';
			$w->status=0;
			$time=strtotime(date("d-m-Y h:i:s"));
			if($request->img){
				$file = $request->file('img');
				$destinationPath = 'upload/theme/';
				$w->img=$destinationPath.$time.".".$file->getClientOriginalExtension();
			}
			if($request->status){
				$w->status=$request->status;
			}
			$path =base_path('theme')."/".$w->name;
			if(!File::exists($path)){
				File::makeDirectory($path);
				$path_css =base_path('theme')."/".$w->name."/css";
				File::makeDirectory($path_css);
				$path_css =base_path('theme')."/".$w->name."/js";
				File::makeDirectory($path_css);
				$path_view =base_path('theme')."/".$w->name."/view";
				File::makeDirectory($path_view);
				$path_model =base_path('theme')."/".$w->name."/model";
				File::makeDirectory($path_model);
			}
			if($w->save()){
				if(isset( $file))
				{
					$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
				}
			}
		}
		return redirect('admin/website/');
	}
	function update_theme($id){
		$w=Websites_model::find($id);
		if($w){
			return view("admin.home.website.update",['w'=>$w]);
		}
		return redirect('admin/website/');
	}

	function update_themes(Request $request){
		if($request->isMethod('post')){
			$w= Websites_model::find($request->id);
			if($w){
				$tem=$w->name;
				$w->name=$request->name;
				$time=strtotime(date("d-m-Y h:i:s"));
				if($request->img){
					$file = $request->file('img');
					$destinationPath = 'upload/theme/';
					$w->img=$destinationPath.$time.".".$file->getClientOriginalExtension();
				}
				if($request->status){
					$w->status=$request->status;
				}
				$path =base_path('theme')."/".$w->name;
				if(!File::exists($path)){
					$path_tem =base_path('theme')."/".$tem;
					if(File::exists($path_tem)){
						File::deleteDirectory($path_tem);
					}
					File::makeDirectory($path);
					$path_css =base_path('theme')."/".$w->name."/css";
					File::makeDirectory($path_css);
					$path_css =base_path('theme')."/".$w->name."/js";
					File::makeDirectory($path_css);
					$path_view =base_path('theme')."/".$w->name."/view";
					File::makeDirectory($path_view);
					$path_model =base_path('theme')."/".$w->name."/model";
					File::makeDirectory($path_model);
				}				
				if($w->save()){
					if(isset( $file))
					{
						$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
					}
				}
			}
			
		}
		return redirect('admin/website/');
	}
	function delete($id){
		$w= Websites_model::find($id);
		if($w){
			$path =base_path('theme')."/".$w->name;
			if(File::exists($path)){
				File::deleteDirectory($path);
			}
			$w->delete();
		}
		return redirect('admin/website/');
	}
	static function get_website($name){
		$w=Websites_model::where("name",trim($name))->first();
		$wb=Website_model::where("id_site",$w->id)->first();

		$data["w"]=$w;
		$data['url']='soure/theme/'.$name;
		$data["wb"]=$wb;

		return $data;
	}

	function setLang(Request $request){
		if($request->isMethod('post')){
			if($request->lang){
				$request->session()->put('lang', $request->lang);
				return Session::get('lang');
			}
			
		}
	}


}
