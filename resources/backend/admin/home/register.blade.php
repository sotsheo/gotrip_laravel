<html>
<head>
 <title>Đăng ký</title>
 @include('admin/layout/head')
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
     <b>Đăng ký</b>
   </div>
   <!-- /.login-logo -->
   <div class="login-box-body">

    <form role="form" action="{{route('register')}}"   method="POST" enctype="multipart/form-data">
     {{ csrf_field() }}

      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Full name" name="name">
        <span class="text-red">{{(isset($check['name']))?$check['name']:''}}</span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email">
        <span class="text-red">{{(isset($check['email']))?$check['email']:''}}</span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="text-red">{{(isset($check['email']))?$check['email']:''}}</span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Retype password" name="passwordv2">
        <span class="text-red">{{(isset($check['passwordv2'])) ? $check['passwordv2'] :''}}</span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng ký</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </form>
</div>
</div>
@include('admin/layout/footer')
<script type="text/javascript">
var chek=0;
  $(".btn-flat").click(function(){
    check=0;
    $(".form-group").each(function(){
       $(this).children(".text-red").text(""); 
    });
    $(".form-group").each(function(){
      if(!$(this).children("input").val()){
       $(this).children(".text-red").text("Trường thông tin này không được để trống");            
       check=1;
     }
   });
    if(check==1){
      return false;
    }
  });
</script>
</body>
</html>