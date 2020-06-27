<?php

namespace App\Http\Model\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\product\Product_model;
use App\Http\Model\product\Category_product_model;
use App\Http\Model\product\Group_product_model;
use Validator;
class List_group_product_model extends Model
{
	protected $table = 'product_list_group';
	public $timestamps=false;
	protected $fillable = [
        'name',
        'short_description',
        'created_at',
        'updated_at',
        'location',
        'description',
        'meta_keywords',
        'meta_description',
        'meta_title',
        'public_at',
        'state',
        'link',
        'img',
        'img_root',
        'url_seo',
        'delete'
    ];
    public static function boot(){
        parent::boot();
        self::creating(function($model){
        	 $model->url_seo=createUrlpage($model->name);
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/group_product/';
                $model->img_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                $model->img='';
            }
            $model->created_at=$model->updated_at=time();
            $model->public_at=strtotime($model->public_at);
            
        });
        self::created(function($model){
            $model->created_at=$model->updated_at=time();
           	$model->link="/".$model->url_seo."_gp".$model->id.".html";
           	$model->save();
        });
        self::updating(function($model){
        	$model->url_seo=createUrlpage($model->name);
        	if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/group_product/';
                $model->img_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                $model->img='';
            }
            $model->link="/".$model->url_seo."_gp".$model->id.".html";
            $model->public_at=strtotime($model->public_at);
            $model->updated_at=time();
        });
        
    }
    //

	// thực hiện thêm sửa sql 28/7/2019
	// public static function actionModel($group, $request){

	// 	$group->name=$request->name; 
	// 	$group->link="";
	// 	if($request->id){
	// 		$group->link="/".createUrlpage($request->name)."-gp-".$request->id.".html";
	// 	}

	// 	$group->location=0;

	// 	$group->description='';
	// 	$group->state=(int)$request->state;
	// 	$time=strtotime(date("d-m-Y h:i:s"));
	// 	if($request->img){
	// 		$file = $request->file('img');
	// 		$destinationPath = 'upload/group_product/';
	// 		$group->img=$destinationPath.$time.".".$file->getClientOriginalExtension();
	// 	}

	// 	if($request->short_description){
	// 		$group->short_description=$request->short_description;
	// 	}  
	// 	if($request->editor1){
	// 		$group->description=$request->editor1;
	// 	}
	// 	if((int)$request->location){
	// 		$group->location=$request->location;
	// 	}
 //            // kiểm tra tồn tại của thời gian nếu không thì lấy thời gian hiện tại
	// 	$group->date_create=strtotime(date('d-m-Y'));
	// 	if($request->date_create){
	// 		$group->date_create=strtotime($request->date_create);
	// 	}
 //            // kiểm tra tồn tại của thời gian nếu không thì lấy thời gian hiện tại
	// 	$group->date_public=strtotime(date('d-m-Y'));
	// 	if($request->date_public){
	// 		$group->date_public=strtotime($request->date_public);
	// 	}
	// 	$validation = List_group_product_model::validation($request);
	// 	if ($validation) {
	// 		$data['validation'] = $validation;
	// 		$data['model'] = $group;
	// 		return $data;
	// 	}
	// 	if($group->save()){

	// 		Session::flash('messages', 'Đã thêm thành công nhóm sản phẩm '.$group->name);
	// 		if(!$request->id){
	// 			$id_insert=List_group_product_model::orderBy('id','DESC')->first();
	// 			$id_insert->link ="/".createUrlpage($group->name)."-gp-".$id_insert->id.".html";
	// 			$id_insert->save();
	// 		}
	// 		if(isset( $file)){
	// 			$result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
	// 			if($result){

	// 			}                   
	// 		}
	// 		return 'true';
	// 	}  
	// }
	public static function validate($request)
	{
		$validate = Validator::make(
			$request->all(),
			[
				'name' => 'required|min:2|max:255',

			],
			[
				'required' => ':attribute Không được để trống',

			],
			[
				'name' => 'Tiêu đề',

			]
		);
		if ($validate->fails()) {
			return $validate->messages();
		}
		return false;
	}

	// Ajax thêm sản phẩm vào nhóm sản phẩm 28/7/2019
	public static function addProduct($product,$request){
		$list=List_group_product_model::find($request->id_list);
		if($list){
			if($request->type=='add'){
				$group=new Group_product_model;
				$group->id_product=$product->id;
				$group->id_list_group=$list->id;

				if($group->save()){
					return 1;
				}
			}
			if($request->type=='delete'){
				$group=Group_product_model::where(["id_product"=>$product->id,'id_list_group'=>$list->id])->first();
				$group_delete=Group_product_model::find($group->id);
				if($group_delete){
					if($group_delete->delete()){
						return 1;
					}
				} 
			}
		}
	}

	// Trả về tất cả nhóm sản phẩm widgetadmin 28/7/2019
	public static function getAllGroup(){
		$category = List_group_product_model::all();
		$data['limit'] = 0;
		$data['category'] =  $category;
		return $data;
	}

	public static function getProductInGroup($limit,$id){
		$groupproduct=Group_product_model::where('id_list_group',$id)->limit($limit)->get();
		$data=[];
		foreach($groupproduct as $gr){			
		 $data[]=Product_model::find($gr->id_product);
		}
		return $data;
	}
	public static function getGroup($id){
		 $data=List_group_product_model::find($id);
		return $data;
	}
}
