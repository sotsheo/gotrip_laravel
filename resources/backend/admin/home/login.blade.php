<html>
<head>
 <title>Đăng nhập</title>
 @include('admin/layout/head')
</head>

<body class="hold-transition login-page">
 <section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
  <div class="container aside-xxl">
    <!-- <a class="navbar-brand block" href="/">Admin</a> -->
    <section class="panel panel-default bg-white m-t-lg">
      <header class="panel-heading text-center">
        <strong>Đăng nhập</strong>
      </header>
      <form  class="panel-body wrapper-lg" method="POST">
        {{ csrf_field() }}

        <div class="form-group">
          <label class="control-label">Email</label>
           {{ Form::text('name',$model->name,['class'=>'form-control','placeholder'=>"Email"])}}
        </div>
        <div class="form-group">
          <label class="control-label">Mật khẩu</label>
           {{ Form::password('password',['class'=>'form-control','placeholder'=>"Mật khẩu"])}}

          <?php if(isset($validate)){?>
            <span class="text-red"><?= ($validate->has('password'))? $validate->first('password'):''; ?></span>
          <?php } ?>
          <?php if(isset($alert)){?>
            <span class="text-red"><?= $alert; ?></span>
          <?php } ?>
        </div>
        <div class="form-group" style="border-bottom: 0px">
          <button type="submit" class="btn btn-primary" >Đăng nhập</button>
        </div>
      </form>
    </section>
  </div>
</section>

@include('admin/layout/footer')
<script type="text/javascript">

  $(".btn-flat").click(function(){
    var chek=0;
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