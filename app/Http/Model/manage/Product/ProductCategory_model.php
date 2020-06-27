<?php

namespace App\Http\Model\manage\Product;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Model\Product\Product_model;

use Validator;
class ProductCategory_model extends Model
{
    protected $table = 'product_category_import';
    public $timestamps = false;

    //
    public static function actionModel($category, $request)
    {
        $category->name = '';
        if ($request->name) {
            $category->name = $request->name;
        }
        $time = strtotime(date("d-m-Y h:i:s"));
        if ($request->img) {
            $file = $request->file('img');
            $destinationPath = 'upload/category_product/';
            $category->img = $destinationPath . $time . "." . $file->getClientOriginalExtension();
        }
        if ($request->editor1) {
            $category->description = $request->editor1;
        }
        $category->state = $request->state;
        if ((int)$request->orders) {
            $category->orders = $request->orders;
        }

        
        $category->created_at = strtotime(date('d-m-Y'));
        if ($request->created_at) {
            $category->created_at = strtotime($request->created_at);
        }
        // kiểm tra tồn tại của thời gian nếu không thì lấy thời gian hiện tại
        $category->updated_at = strtotime(date('d-m-Y'));
        if ($request->updated_at) {
            $category->updated_at = strtotime($request->updated_at);
        }
        $validation = ProductCategory_model::validation_category($request);
        if ($validation) {
            $data['validation'] = $validation;
            $data['model'] = $category;
            return $data;
        }
        if(isset( $file)){
            $result=$file->move($destinationPath,$time.".".$file->getClientOriginalExtension());
            $category->avatar_path=url('upload/');
            $category->avatar_name=$time.".".$file->getClientOriginalExtension();
            uploadFile($category->img,$file,$time);
        }
        if ($category->save()) {
            Session::flash('messages', 'Đã thêm thành công danh mục sản phẩm ' . $category->name);

            return 'true';
        }

    }

    public static function create_url(string $str)
    {
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
                'orders' => 'integer'
            ],
            [
                'required' => ':attribute Không được để trống',
                'integer' => ':attribute phải là số'
            ],
            [
                'name' => 'Tiêu đề',
                'orders' => 'Thứ tự'
            ]
        );
        if ($validate->fails()) {
            return $validate->messages();
        }
        return false;
    }

     public static function productcategoryishome($limit_category, $limit)
    {
        if ($limit_category && $limit) {
            $categorys = array();
            $category = ProductCategory_model::where('ishome', 1)->limit($limit_category)->get();
            if ($category) {
                foreach ($category as $cate) {
                    $product = Product_model::where('id_category', $cate->id)->limit($limit)->get();
                    $cate['product'] = $product;
                    $categorys[] = $cate;
                }
            }
            return $categorys;
        }
    }


}
