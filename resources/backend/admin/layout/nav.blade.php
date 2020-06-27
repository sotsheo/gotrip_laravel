
 <?php 
    use App\Http\Controllers\backend\news\Newsletter_controller;
    use App\Http\Controllers\backend\au\Authorities_controller;
    use Illuminate\Support\Facades\Auth;
    $data =Newsletter_controller::get(); 
    // lấy tấy cả các router mà admin có 
    $au=Authorities_controller::get_router();
    ?>
    
    @include('admin/layout/website',
          ['au'=>$au])
