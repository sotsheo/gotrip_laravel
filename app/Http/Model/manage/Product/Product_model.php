<?php

namespace App\Http\Model\manage\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Model\manage\Product\ProductCategory_model;
use App\Http\Model\Product\Manufacturer_model;
use App\Http\Model\Product\ProductImages_model;
class Product_model extends Model
{
    protected $table = 'product_import';
    public $timestamps = false;

    //
    public static function actionModel($product, $request,$order=array())
    {
        $check = 0;
        $time = strtotime(date("d-m-Y h:i:s"));

        // if ($request->manufacturer_id) {
        //     $pro = Manufacturer_model::find($request->manufacturer_id);
        //     if (!$pro) {
        //         $check = 1;
        //     }
        // }
        if ($request->category_id) {
            $category = ProductCategory_model::find($request->category_id);
            if (!$category) {
                $check = 1;
            }
        }

        if ($check == 0) {
            $product->name='';
            if($request->name){
                $product->name = $request->name;
                $product->url_seo = createUrlpage($request->name);
            }
            $product->code = '';
            if ($request->code) {
                $product->code = $request->code;
            }
            $product->category_id = $request->category_id;
            $product->manufacturer_id = 0;
            if ($request->manufacturer_id) {
                $product->manufacturer_id = $request->manufacturer_id;
            }
            if ((int)$request->price) {
                $product->price = $request->price;
            }
            // if ($request->manufacturer) {
            //     $product->manufacturer = $request->manufacturer;
            // }
            if ((int)$request->price_market) {
                $product->price_market = $request->price_market;
            }
            $product->short_description = $request->short_description;
            $product->description = '';
            if ($request->editor1) {
                $product->description = $request->editor1;
            }

            $destinationPath = 'upload/product/';
            if ($request->avatar) {
                $file = $request->file('avatar');
                $product->avatar = $destinationPath . $time . "." . $file->getClientOriginalExtension();
            }
            
            $product->state = $request->state;
            if ($request->get('ishot', 0) != 0) {
                $product->ishot = 1;
            }
            
            $product->user_id = 1;
            $product->date_create = strtotime(date("d-m-Y"));
            if ($request->date_create) {
                $product->date_create = strtotime($request->date_create);
            }
            if(!$product->id){
                $product->created_at=$product->updated_at  = strtotime(date("d-m-Y"));
            }else{
                $product->updated_at = strtotime(date("d-m-Y"));
            }
            
          
            $i = 0;
            $validation = Product_model::validation_category($request);
            if ($validation) {
                $data['validation'] = $validation;
                $data['model'] = $product;
                return $data;
            }
          
           

            if ($product->save()) {
                Session::flash('messages', 'Đã thêm thành công sản phẩm' . $product->name);
                return 'true';
            }
        }
    }

    public static function create_url(string $str)
    {
        //Kiểm tra xem dữ liệu truyền vào có phải là một chuỗi hay không
        if (is_string($str)) {
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

            foreach ($unicode as $key => $value) {
                //So sánh và thay thế bằng hàm preg_replace

                $str = preg_replace("/($value)/", $key, $str);
            }
            //Trả về kết quả
            return $str;
        }
        //Nếu Dữ liệu không phải kiểu string thì trả về null
        return null;
    }

    public static function validation_category($request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2|max:255',
                'orders,category_id' => 'required,integer',
                'category_id'=>'exists:product_category,id'
            ],
            [
                'required' => ':attribute Không được để trống',
                'orders' => ':attribute phải là số',
                'exists'=>':attribute không được rông'
            ],
            [
                'name' => 'Tiêu đề',
                'orders' => 'Tứ tự',
                'category_id' => 'Danh mục'
            ]
        );
        if ($validate->fails()) {
            return $validate->messages();
        }
        return false;
    }

    
}