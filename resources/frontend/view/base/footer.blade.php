<div class="footer wow fadeInUp">
   <div class="container">
      <div class="row multi-columns-row">
         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="intro-footer">
               <a href="<?= url('/')?>">
                <img src="<?= url($w->logo_root)?>" alt="<?=$w->name?>">
            </a>
            <?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view',9);?>

        </div>
    </div>
    <?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view_footer',8);?>
    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="support-footer">
           <h2>
              HỖ TRỢ MIỄN PHÍ 24/7
          </h2>
          <div class="phone">
              <img src="images/ic-phone2.png" alt=""> 0912.320.889
          </div>
          <div class="phone">
              <img src="images/ic-phone2.png" alt=""> 0968.672.768
          </div>
          <p>
              Tổng đài hỗ trợ 24/7 Hoặc gửi email về địa chỉ booking@postumtravel.vn sẽ phản hồi trong vòng 24h.
          </p>
      </div>
  </div>
</div>
<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view',10);?>
<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view',11);?>

</div>
</div>
<script type="text/javascript">
  function getMessage(urls,form,key) {
    $(".er_all").html('');
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {"_token": "{{ csrf_token() }}",data:form},
      type:'POST',
      url:urls,
      success:function(data) {

          if(data.code==200){
            location.reload();
          }
          if(data.code==400){
          
            if(data.messages){
              $(".er_"+key).html(data.messages);
            }
            if(data.errors){
              $.each(jQuery.parseJSON(data.errors), function(i, item) {
                 $("."+i+"_"+key).html(item);
              });
              
            }
          }
        }
      });
  }
    
</script>
<div style="display: none;" id="register-form" class="form-style">
    <h2>ĐĂNG KÝ TÀI KHOẢN</h2>
    <form action="" id="signup">
        <div class="input-item">
            <label for="">Họ và tên:</label>
            <input type="text" placeholder="Vui lòng nhập emai" name="name">
            <p class=" name_signup er_all">  </p>
        </div>
        <div class="input-item">
            <label for="">Emai đăng nhập</label>
             <input type="email" placeholder="Vui lòng nhập emai" name="email">
            <p class=" email_signup er_all">  </p>
        </div>
        <div class="input-item">
            <label for="">Số điện thoại</label>
             <input type="text" placeholder="Vui lòng nhập sđt" name="phone">
            <p class=" phone_signup er_all">  </p>
        </div>
         <div class="input-item">
            <label for="">Địa chỉ</label>
             <input type="text" placeholder="Vui lòng nhập sđt" name="address">
            <p class=" address_signup er_all">  </p>
        </div>
        <div class="input-item">
            <label for="">Mật khẩu:</label>
             <input type="password" placeholder="Vui lòng nhập emai" name="password">
            <p class=" password_signup er_all">  </p>
        </div>
       
        <div class="input-btn">
            <button type="submit">Đăng Ký</button>
        </div>
        <a style="text-align: right;" data-fancybox data-src="#login-form" href="javascript:;" class="register">Bạn đã có tài khoản? Đăng nhập</a>
        <p>
            Hoặc đăng nhập bằng tài khoản mạng xã hội
        </p>
        <div class="group-btn-fb">
            <a href="">
                <img src="images/btn-facebook.png" alt="">
            </a>
            <a href="">
                <img src="images/btn-googleplus.png" alt="">
            </a>
        </div>
        <script type="text/javascript">
            $("#signup").submit(function(){
              getMessage("<?=url('signupAjax')?>",$("#signup").serializeArray(),'signup');
                return false;
            });
        </script>
    </form>
</div>

<div style="display: none;" id="login-form" class="form-style">
    <h2>ĐĂNG NHẬP TÀI KHOẢN</h2>
    <form action="" id="login">
        <div class="input-item">
            <label for="">Emai đăng nhập</label>
            <input type="email" placeholder="Vui lòng nhập emai" name="email">
            <p class=" email_login er_all">  </p>
        </div>
        <div class="input-item">
            <label for="">Mật khẩu:</label>
            <input type="password" placeholder="Vui lòng nhập mật khẩu" name="password">
            <p class="er_login password_login er_all">  </p>
        </div>
        <div class="input-btn">
            <button type="submit">Đăng Ký</button>
        </div>
        <a style="text-align: right;" data-fancybox data-src="#register-form" href="javascript:;" class="register">Bạn chưa có tài khoản? Đăng kí</a>
        <p>
            Hoặc đăng ký bằng tài khoản mạng xã hội
        </p>
        <div class="group-btn-fb">
            <a href="">
                <img src="images/btn-facebook.png" alt="">
            </a>
            <a href="">
                <img src="images/btn-googleplus.png" alt="">
            </a>
        </div>
         <script type="text/javascript">
            $("#login").submit(function(){
              getMessage("<?=url('loginAjax')?>",$("#login").serializeArray(),'login');
              return false;
            });
        </script>
    </form>
</div>
<script type="text/javascript">
  getLocation();
  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    } 
  }
  function showPosition(position) {
     // position.coords.latitude  
     // position.coords.longitude;
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {"_token": "{{ csrf_token() }}",'latitude':position.coords.latitude,'longitude':position.coords.longitude},
      type:'POST',
      url:"<?=url('getPosition')?>",
      success:function(data) {
          if(data.code==200){
            // location.reload();
          }
        }
      });
  }

  
</script>