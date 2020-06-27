<?php

namespace App\Http\Controllers\backend;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Model\site\Website_model;
class Controller extends BaseController{

    const ACTIVE=1;
    const NOT_ACTIVE=0;
    const WEB=1;
    function __construct(){
        $w = Website_model::find(self::WEB);
        if ($w) {
            view()->share('w', $w);
        } else {
            $w = new Website_model;
            view()->share('w', $w);
        }
    }
    public  function showCategories($categories, $parent_id = 0, $char = '') {
        foreach ($categories as $key => $item) {
             // Nếu là chuyên mục con thì hiển thị
             if ($item['id_parent'] == $parent_id) {
                 $item['name'] = $char . $item['name'];
                 
                 $this->categorys[$item['id']] = $item['name'];
                 // Xóa chuyên mục đã lặp
                 unset($categories[$key]);
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                 $this->showCategories($categories, $item['id'], $char . '|---');
                
             }
         }
    }
    public function sortArrays($categories, $parent_id = 0, $char = '') {
        foreach ($categories as $key => $item) {
             // Nếu là chuyên mục con thì hiển thị
           
             if ($item['id_parent'] == $parent_id) {
                 $item['name'] = $char . $item['name'];
                 
                 $this->sorts[] = $item;
                 // print_r( $item);
                 // Xóa chuyên mục đã lặp
                 // unset($categories[$key]);
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                 $this->sortArrays($categories, $item['id'], $char . '|---');
                
             }

         }
    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
