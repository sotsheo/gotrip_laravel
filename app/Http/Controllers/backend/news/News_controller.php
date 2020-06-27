<?php


namespace App\Http\Controllers\backend\news;

use App\Http\Controllers\backend\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Model\news\News_model;
use Illuminate\Support\Facades\Input;
use App\Http\Model\news\NewsCategory_model;
use App\Http\Model\history\History_model;
use Mail;
use App\Http\Model\site\Website_model;

class News_controller extends Controller{

    var $categorys=[];
    function index(Request $request){
        $where=[];
        $where['admin']=1;
        if($request->input('name')){
            $where['name']=$request->input('name');
        }
        if($request->input('id_category')){
            $where['id_category']=$request->input('id_category');
        }
        if($request->input('status')!=-1){
            $where['status']=$request->input('status');
        }
       
        $news=News_model::getNews($where);
        // $news = News_model::where(['status'=>1,'delete'=>0])->orderByRaw('orders ASC,id DESC')->paginate(10);
        $messages = Session::get('messages');
        $category=NewsCategory_model::where(['delete'=>0,'status'=>1])->get();
        $this->showCategories($category);
        $category=$this->categorys;
        return view("admin.home.news.news.index", [
            'news' => $news, 
            'category' => $category, 
            'messages' => $messages,
            'where'=>$where
        ]);
    }

    

    function create(Request $request){
       
        $model = new News_model;
        $model->created_at= $model->updated_at= $model->public_at = time();
        $category=NewsCategory_model::where(['delete'=>0,'status'=>1])->get();
        $this->showCategories($category);
        $tem=$this->categorys;
        
        if ($request->isMethod('post')) {
            $inputs = Input::all();
            $validate=$model->validate($request);
            if(!$model->validate($request)){
                $inputs['ishot']=isset($inputs['ishot'])?self::ACTIVE:self::NOT_ACTIVE;  
                $model->public_at=strtotime(str_replace('/', '-', $inputs['public_at']));
                $tem=$model->create($inputs);
                History_model::updateChange(History_model::ACTION_CREATE,'news',$tem->id);
                return redirect('admin/news/');
            }
            $model->fill($inputs);
            $model->public_at=strtotime(str_replace('/', '-', $model->public_at));
            return view('admin.home.news.news.insert', [
                'errors' =>$validate,
                'model' => $model,
                "category" =>$tem]);
            

        }
        return view("admin.home.news.news.insert", ['category' => $tem,'model'=>$model]);
    }


    function update(News_model $model,Request $request){
        if ($model) {
            $category=NewsCategory_model::where(['delete'=>0,'status'=>1])->get();
            $this->showCategories($category);
            $tem=$this->categorys;

            if ($request->isMethod('post')) {
                $inputs = Input::all();
                $validate=$model->validate($request);
                
                if(!$model->validate($request)){  
                    $inputs['ishot']=isset($inputs['ishot'])?self::ACTIVE:self::NOT_ACTIVE;  
                    $model_old=$model;  
                    if(History_model::updateChange(History_model::ACTION_UPDATE,'news',$model->id,$model_old,$inputs)){
                        $model->update($inputs);
                        return redirect('admin/news/');
                    }  
                }
                $model->fill($inputs);
               
                if($model->updated_at){
                    $model->public_at = strtotime(str_replace('/', '-',$model->public_at));
                }else{
                    $model->updated_at=strtotime(date('d/m/Y',time()));
                }
                 return view('admin.home.news.news.update', [
                    'errors' =>$validate,
                    'model' => $model,
                    "category" =>$tem]);
            }
            return view("admin.home.news.news.update", ['model' => $model, 'category' => $tem]);
        }
        return redirect('admin/news/');
    }

    

    function delete(News_model $model)
    {

        if ($model) {
            $model->delete=1;
            $model->delete_at=time();
            if ($model->save()) {
                History_model::updateChange(History_model::ACTION_DELETE,'news',$model->id);
                Session::flash('messages', 'Đã xóa  thành công bài viết');
                return redirect('admin/news/');
            }
        }
        return redirect('admin/news/');
    }



    // lay bai viet liên quan
    static function getRelatedPosts($id_category, $id, $limit)
    {
        $news = News_model::where('id_category', $id_category)->where('id', '!=', $id)->limit($limit)->get();
        return $news;
    }

    function getNewsTogether(Request $request){
        if($request->isMethod('post')) {
            $name=$request->input('name');
            if($name){
                $news=News_model::getNews(['name'=>$name]);
                if($news){
                    $html=view("admin.home.product.product.view_news_search",['news'=> $news])->render();
                    return [
                        'code'=>200,
                        'messages'=>$html
                    ];
                }
            }
             return [
                'code'=>200,
                'messages'=>'Không tìm được bài viết nào...'
            ];
           
        }
    }

    public function our_backup_database($table_name=''){

        //ENTER THE RELEVANT INFO BELOW
        $mysqlHostName      = env('DB_HOST');
        $mysqlUserName      = env('DB_USERNAME');
        $mysqlPassword      = env('DB_PASSWORD');
        $DbName             = env('DB_DATABASE');
        $backup_name        = "mybackup.sql";
        $tables             = array("user_admin","album","album_category","album_images","au","au_group","au_user","banner","banner_category","cart","cart_item","combo","combo_images","contacform","contacform","district","history_user","history_item",'html','introduces','listgroupproduct','manufacturer','menu','menu_category','news','news_category','news_together','newsletter','pagecontent','product','product_category','product_category_image','product_import','product_list_group','product_rating','product_together','properties','province','recruiment','shop','shop_images','support','suport_type','type_support','typewidget','users','video','video_category','village','ward','website','widget'); 
        if($table_name){
             $tables=[$table_name];
        }
        $connect = new \PDO("mysql:host=127.0.0.1;dbname=quanly;charset=utf8", "root", "",array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $result = $statement->fetchAll();


        $output = '';
        foreach($tables as $table)
        {
         $show_table_query = "SHOW CREATE TABLE " . $table . "";
         $statement = $connect->prepare($show_table_query);
         $statement->execute();
         $show_table_result = $statement->fetchAll();

         foreach($show_table_result as $show_table_row)
         {
          $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
         }
         $select_query = "SELECT * FROM " . $table . "";
         $statement = $connect->prepare($select_query);
         $statement->execute();
         $total_row = $statement->rowCount();

        for($count=0; $count<$total_row; $count++){
              $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
              $table_column_array = array_keys($single_result);
              $table_value_array = array_values($single_result);
              $output .= "\nINSERT INTO $table (";
              $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
              $output .= "'" . implode("','", $table_value_array) . "');\n";
            }
        }
        $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';
        $file_handle = fopen($file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_name));
        ob_clean();
        flush();
        readfile($file_name);
        unlink($file_name);
    }

     // đệ quy vòng lặp lấy category
    function showCategories($categories, $parent_id = 0, $char = '') {
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
}   
