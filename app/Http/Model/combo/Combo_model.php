<?php

namespace App\Http\Model\combo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\Request;
use App\Cl\ClCategory;
use  App\Http\Model\album\AlbumImg_model;
use  App\Http\Model\combo\ComboTime_model;
use  App\Http\Model\hotel\Hotel_model;
use Illuminate\Support\Facades\Input;
class Combo_model extends Model{
    
    const TYPE_1=1;// LOẠI COMBO BO FIX GIÁ SẴN
    const TYPE_2=2;// LOẠI COMBO DỰA VÀO MB + GP + T - GKM
    const ORDER='ordercombo';// LOẠI COMBO DỰA VÀO MB + GP + T - GKM
    protected $table = 'combo';
    public $timestamps=false;
    protected $fillable = [
        'name',
        'category_id',
        'category_track',
        'price_include',
        'price_not_included',
        'policy',
        'condition',
        'url_seo',
        'status',
        'number_point',
        'viewed',
        'view',
        'img',
        'img_path',
        'img_name',
        'img_root',
        // 'short_description',
        'description',
        'ishot',
        'created_at',
        'updated_at',
        'orders',
        'meta_keywords',
        'meta_description',
        'meta_title',
        'link',
        'delete',
        'delete_at'
    ];
    public static function boot(){
        parent::boot();
        self::creating(function($model){
            $model->url_seo=createUrlpage($model->name);
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/combo/';
                $model->img_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                if(isset($file)){
                    $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                    $model->img_path=url('upload/');
                    $model->img_name=$time.".".$file->getClientOriginalExtension();
                    uploadFile($model->img_root,$file,$time);
                    $model->img='';
                }
            }
            $model->created_at=$model->updated_at=strtotime(date('d/m/Y H:i:s'));
             if(is_array($model->category_id)){
                 $model->category_id=implode(' ',array_values($model->category_id));
            }
           
            
        });
        self::created(function($model){
           // $model->id_category_track=Combo_model::getAllCategoryTrack($model->id_category);
           $model->link = "/" . $model->url_seo . "_cb" .$model->id . '.html';
           $model->save();
        });
        self::updating(function($model){
            if($model->img){
                $time=time();
                $file = $model->img;
                $destinationPath = 'upload/combo/';
                $model->img_root=$destinationPath.$time.".".$file->getClientOriginalExtension();
                if(isset($file)){
                    $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
                    $model->img_path=url('upload/');
                    $model->img_name=$time.".".$file->getClientOriginalExtension();
                    uploadFile($model->img_root,$file,$time);
                    $model->img='';
                }
            }
            $model->updated_at=time();
            $model->url_seo=createUrlpage($model->name);
            $model->link = "/" . $model->url_seo . "_cb" .$model->id . '.html';
            
            if(is_array($model->category_id)){
                 $model->category_id=implode(' ',array_values($model->category_id));
            }
            $tem_track='';
            $tem=explode(' ', $model->category_id);
            if($tem){
                foreach($tem as $key=>$val){
                    $tem_track.=' '.Combo_model::getAllCategoryTrack($val);
                }
            }
            $model->category_track=$tem_track;
            //  print_r($model->public_at);
            // die();
        });
        
    }
   

    public static function validate($request){
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:5|max:255',
            ],
            [
                'required' => ':attribute không được để trống',
                'integer' => ':attribute chỉ được nhập số',
            ],

            [
                'name' => 'Tiêu đề',
            ]

        );
        if ($validate->fails()) {
            return  $validate->messages();
        }
        return false;
    }
    public static function getAllCategoryTrack($id){
        $cat=$id;
        $cat_tem=0;
        $category=ComboCategory_model::find($id);
        if($category){
            $cat_tem=$category->id_parent;
        }
        while ($cat_tem) {
           $category=ComboCategory_model::find($cat_tem);
           if($category){
            $cat.=' '.$category->id;
             $cat_tem=$category->id_parent;
           }
        }
        return $cat;
    }
    // lấy combo
    public static function getComboInCate($id=0,$option=[]){
        $where['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        $hotel=Hotel_model::query();
        $combotime=ComboTime_model::query();
        $request=Input::all();
        $time=time();
        if(isset($option['time'])){
            $time=$option['time'];
        }
        $combotime->select('combo_id')
        ->where($where)
        ->where('time_start','>',$time);
        
        if(isset($option['time_end']) && $option['time_end'] && $option['time_end']>$time){
            $combotime->where('time_start','>',$option['time_end']);
        }

        $order=[];
        if(isset($request['sort'])){
            $tem=explode('_', $request['sort']);
            if(count($tem)>=2){
                if($tem[1]=='desc' || $tem[1]=='asc'){
                    if($tem[0]=='price'){
                        $combotime->orderBy('price_sum',$tem[1]);
                        $order['name']='price_sum';
                        $order['by']=$tem[1];
                    }
                }
            }
        }
        // sort theo gia
        if(isset($request['p_mi'])){
            $combotime->where('price_sum','>=',(int)$request['p_mi']);
        }
        if(isset($request['p_ma'])){
            $combotime->where('price_sum','<=',(int)$request['p_ma']);
        }
        if(isset($request['ht_star']) && (int)$request['ht_star']>0 && (int)$request['ht_star']<6){
            $hotel=$hotel->select('id')->where(['star'=>(int)$request['ht_star']])->get()
            ->toArray();
            $hotel_id = array_map(function($val){
                return $val['id'];
            }, $hotel);
           
            $combotime->whereIn('hotel_id',$hotel_id);

        }
        $datatime=$combotime->distinct()
        ->get()
        ->toArray();
        $combo=Combo_model::query();
        $combo_id = array_map(function($val){
            return $val['combo_id'];
        }, $datatime);

        if($id){
            $combo->whereRaw("MATCH (category_track) AGAINST ('".$id."' IN BOOLEAN MODE)");
        }
        $limit=0;
        if(isset($option['limit']) && $option['limit']){
            $limit=$option['limit'];
        }       

        $combo=$combo->where($where)->whereIn('id',$combo_id)->paginate($limit);
        if(isset($option['page'])){
            return $combo;
        }
        // sắp xếp lại dữ liệu 
        $data_tem=[];

        if($combo){
            foreach ($combo as $key => $value) {
                foreach ($datatime as $key2 => $value2) {
                   if($value['id']==$value2['combo_id']){
                        $data_tem[$value['id']]=$value;
                        unset($datatime[$key2]);
                        break;
                   }
                }
            }
            $combo=$data_tem;
        }
        
        $data=[];
        if($combo){
            foreach ($combo as $key => $value) {

                $data[$value['id']]=$value;
                $combotime=ComboTime_model::query();
                $where['combo_id']=$value['id'];
                $combotime->where($where);
                if(isset($option['time']) && $option['time']){
                    $combotime->where('time_start','>',$time);
                }
                if(isset($request['p_mi'])){
                    $combotime->where('price_sum','>=',(int)$request['p_mi']);
                }
                if(isset($request['p_ma'])){
                    $combotime->where('price_sum','<=',(int)$request['p_ma']);
                }
                 if(isset($request['ht_star']) && (int)$request['ht_star']>0 && (int)$request['ht_star']<6){
                    $combotime->whereIn('hotel_id',$hotel_id);
                }
                if($order){
                    $combotime->orderBy($order['name'],$order['by']);
                }
                $data[$value['id']]['time']= $combotime->get();
            }
        }
         
        return $data;
    }

    public static function getComboInCateIsHome($option=[]){
        $where['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        $where['ishot']=ClCategory::ACTIVE;
        $limit=0;
        if(isset($option['limit']) && $option['limit']){
            $limit=$option['limit'];
        }
        $limit_item=0;
         if(isset($option['limit_item']) && $option['limit_item']){
            $limit_item=$option['limit_item'];
        }
        $combocategory=ComboCategory_model::query();
        $combocategory=$combocategory->where($where)->limit($limit)->get();
        $data=[];
        if($combocategory){
            foreach($combocategory as $key=>$val){
                $data[$val['id']]=$val;
                $data[$val['id']]['item']=Combo_model::getComboInCate($val['id'],['limit'=>$limit_item,'time'=>'time']);
            }
        }
       
        return $data;
    }

    // lấy tất cả combo khi k quan tâm tới option
    public static  function getAllNotOptions($id=0,$option=[]){
        $where['status']=ClCategory::ACTIVE;
        $where['delete']=ClCategory::NOT_ACTIVE;
        $combotime=ComboTime_model::query();
        $request=Input::all();
        $time=time();
       
        $combotime->select('combo_id')
        ->where($where)
        ->where('time_start','>',$time);
        
        
        $order=[];
        if(isset($request['sort'])){
            $tem=explode('_', $request['sort']);
            if(count($tem)>=2){
                if($tem[1]=='desc' || $tem[1]=='asc'){
                    if($tem[0]=='price'){
                        $combotime->orderBy('price_sum',$tem[1]);
                        $order['name']='price_sum';
                        $order['by']=$tem[1];
                    }
                }
            }
        }
       
        $datatime=$combotime->distinct()
        ->get()
        ->toArray();
        $combo=Combo_model::query();
        $combo_id = array_map(function($val){
            return $val['combo_id'];
        }, $datatime);
        if($id){
            $combo->whereRaw("MATCH (category_track) AGAINST ('".$id."' IN BOOLEAN MODE)");
        }
        $limit=0;
        if(isset($option['limit']) && $option['limit']){
            $limit=$option['limit'];
        }       
        $combo=$combo->where($where)->whereIn('id',$combo_id)->paginate($limit);
        if(isset($option['page'])){
            return $combo;
        }
        $data=[];
        if($combo){
            foreach ($combo as $key => $value) {
                $data[$value['id']]=$value;
                $combotime=ComboTime_model::query();
                $where['combo_id']=$value['id'];
                $data[$value['id']]['time']= $combotime->get();
            }
        }
        
        // 
        return $data;
    }


}
