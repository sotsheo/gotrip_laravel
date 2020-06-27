<?php
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
if (!function_exists('uploadFile')) {
    function uploadFile($name,$file,$time)
    {
        $resize=array(
            '200x200',
            '300x300',
            '400x400',
            '500x500',
            '600x600',
            '700x700',
            '800x800',
            '900x900',
            '1000x1000'
        );
        list($width, $height, $type, $attr) = getimagesize($name);
        for($i=0;$i<(count($resize));$i++){
            $mang=explode('x', $resize[$i]);
            $ratio=floatval($height/$width);
            $height_new=$ratio*$mang[0];
            Image::make($name)->resize($mang[0], (int)$height_new)
                ->save('upload/'.$resize[$i].'/'.$time.".".$file->getClientOriginalExtension());

        }

    }
}
if (!function_exists('createUrlpage')) {
    function createUrlpage(string $str)
    {

        if( is_string( $str ) ){
            // Chuyển đổi toàn bộ chuỗi sang chữ thường
            $str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
            //Tạo mảng chứa key và chuỗi regex cần so sánh
            $unicode = [
                'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
                'd' => 'đ',
                'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
                'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
                'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
                'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
                'i' => 'í|ì|ỉ|ĩ|ị',
                '-' => '\+|\*|\/|\&|\!| |\^|\%|\$|\#|\@',
            ];
            foreach ( $unicode as $key => $value ){
                //So sánh và thay thế bằng hàm preg_replace
                $str = preg_replace("/($value)/", $key, $str);
            }
            //Trả về kết quả
            return $str;
        }
        //Nếu Dữ liệu không phải kiểu string thì trả về null
        return null;


    }
}

// create parameter
if (!function_exists('createParam')) {
    function createParam($name,$val){
        $all_parame=Input::all();
        if(!is_array($name)){
            $all_parame[$name]=$val;
        }
        if(is_array($name)){
            foreach ($name as $key => $value) {
                if(isset($val[$key])){
                    if($val[$key] !=-1){
                        $all_parame[$value]=$val[$key];
                    }else{
                        if(isset($all_parame[$value])){
                            unset($all_parame[$value]);
                        }
                    }
                    
                }
            }
        }
        $url=\Request::path();
        if($all_parame  ){
            $i=0;foreach ($all_parame as $key => $value) {$i++;
                if($i==1){
                     $url.='?'.$key.'='.$value;
                }else{
                    $url.='&'.$key.'='.$value;
                }
               
            }
        }
        return  $url;
    }
}
// check param parameter
if (!function_exists('checkParam')) {
    function checkParam($name,$val){
        $all_parame=Input::all();
        if(!is_array($name)){
            if(isset($all_parame[$name])){
                if($all_parame[$name]==$val)
                    return true;
            }
        }
        if(is_array($name)){
            $check=[];
            foreach ($name as $key => $value) {
                if(isset($all_parame[$name[$key]])){
                    if($all_parame[$name[$key]]==$val[$key]){
                        $check[]=true;
                    }
                }
            }
            if(count($check)==count($name)){
                return true;
            }
        }
        return false;
    }
}
// create bread
if (!function_exists('shareBreadcrumb')) {
    function shareBreadcrumb($str){
        $breadcrumb[]= ['name' =>'Trang chủ', 'link' => url('/')];
        foreach($str as $key=>$value){
            $breadcrumb[]= ['name' =>$value['name'], 'link' => $value['link']];

        }
        view()->share('breadcrumb', $breadcrumb);
    }
}
// media seo
if (!function_exists('shareSEO')) {
    function shareSEO($str,$data){
        $keys=['title','type','url','image'];
        $meta='';
        foreach($keys as $key){
            $tem="<meta property='".$key.':'.$key."' name='".$key.':'.$key."' content='' />";
            if(isset($data[$key])){
                $tem="<meta property='".$key.':'.$key."' name='".$key.':'.$key."' content='".$data[$key]."' />";
            }
            $meta.=$tem;
        }   
        view()->share('meta', $meta);
    }
}
if (!function_exists('create_menu')) {
  function create_menu($data){
        if($data){
            $menu=[];
            
            foreach($data as $m){
                if($m->id_parent==0){
                    $menu[$m->id]=$m;
                    $menu[$m->id]['item']=[];
                    $tem=[];
                    foreach($data as $v){
                        if($v->id_parent==$m->id){
                            $tem[$v->id]=$v;
                        }
                        $menu[$m->id]['item']=$tem;
                    }
                }
            }
            return $menu;
        }
        
    }
}

if (!function_exists('getID')) {
    function getID($url){
        if (isset($url[count($url) - 2]) && $url[count($url) - 2]) {
            $url_new = explode('.', $url[count($url) - 1]);
            return $url_new[0];
        }
        return 1;
    }   
}

if (!function_exists('getUrl')) {
    function getUrl($url){
        if (isset($url[count($url) - 2]) && $url[count($url) - 2]) {
            return $url[count($url) - 2];
        }
        return 1;
    }   
}

if (!function_exists('getIP')) {
  function getIP(){
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
        
    }
}

if (!function_exists('checkUrl')) {
    function checkUrl($url){
        foreach($url as $value){
            $tem=explode('/', $value);
            $url_base =  "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
            $url=explode('/', $url_base);
            $count=count($tem);
            $count_r=0;
            if($tem && $url){
                foreach($tem as $val){
                    if(in_array($val,$url)){
                        $count_r++;
                    }
                    if(!$val){
                        $count_r++;
                    }
                }
                if($count==$count_r){
                    return true;
                }
                
            }
            
        }

    }
    return false;
}



