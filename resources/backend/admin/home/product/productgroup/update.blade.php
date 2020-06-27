<html>
<head>
  <title>Sản phẩm</title>
  @include('admin/layout/head')
  <script src="{{ asset('layout_admin/ckeditor/ckeditor.js')}}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    @include('admin/layout/header')

    @include('admin/layout/nav')
    <div class="content-wrapper">
      <section class="content">
        <div class="row">

          <!-- left column -->
          <div class="box box-warning">
            <div class="box-header with-border">
             <h3 class="box-title">Sản phẩm</h3>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Sản phẩm</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="true">Hình ảnh liên quan</a></li>
              
            </ul>
            <form role="form" action="{{route('edit_list')}}"   method="POST" enctype="multipart/form-data">
              <div class="tab-content">
                {{ csrf_field() }}
                <div class="tab-pane active" id="tab_1">
                  <input type="text" class="form-control" placeholder="Enter ..." name="id" style="display: none;" value="{{$list_group->id}}" id="id_group">
                  <div class="form-group required">
                    <label>Tên</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="name" value="{{$list_group->name}}" >
                    <span class="text-red"></span>
                  </div>

                  <div class="form-group required_a">
                    <label>Mô tả ngắn</label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="short_description">{{$list_group->short_description}}</textarea>
                    <span class="text-red"></span>
                  </div>

                  <div class="form-group">
                    <label>Nội dung banner</label>
                    <textarea name="editor1" id="editor1" rows="10" cols="80" >
                      {{$list_group->description}}
                    </textarea>
                  </div>


                  <div class="form-group">
                    <label for="exampleInputFile">Hình ảnh</label>
                    <input type="file" id="exampleInputFile" name="img">
                    <?php
                    if($list_group->img){
                      ?>
                      <img src="<?= url($list_group->img)?>" style="max-height: 150px;">
                      <?php }?>
                    </div>
                    <div class="form-group ">
                      <label>Thứ tự</label>
                      <input type="text" class="form-control" placeholder="Enter ..." name="location" value="{{$list_group->location}}">
                      <span class="text-red"></span>
                    </div>

                    <div class="form-group">
                      <label>Trạng thái</label>
                      <select class="form-control" name="state">
                        <option value="0">Hiện thị</option>
                        <option value="1">Ẩn</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Thời gian đăng</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" value="{{ date('d-m-Y',$list_group->date_create) }}" name="date_create">
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Thời gian public</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepickers" value="{{ date('d-m-Y', $list_group->date_public)}}" name="date_create">
                      </div>
                    </div>
                  </div>
                  
                  <div class="tab-pane" id="tab_2">
                   <div class="col-md-6">
                     <div class="box">
                      <div class="box-body">
                        <table class="table table-bordered add_product">
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Tên</th>
                            <th>Danh mục</th>
                          </tr>
                          <?php
                          $i=0;
                          foreach($data_out_group as $p){
                            $i++;

                            ?>
                            <tr class='item_product' id='id_{{$p->id}}'>
                              <th style='width: 10px'>#</th>
                              <td>{{$p->name}}</td>
                              <td>{{$p->name_product}}</td>
                              <td><a  data_id='{{$p->id}}' data_name='{{$p->name}}' data_cate='{{$p->name_product}}' id_class='id_{{$p->id}}'><span class='badge bg-red'><i class='fa fa-fw fa-share'></span></i></a></td>
                            </tr>
                            <?php }?>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                     <div class="box">
                      <div class="box-body">
                        <table class="table table-bordered remove_product">
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Tên</th>
                          </tr>
                          <?php
                          foreach($data_in_group as $p){
                            $i++;
                            ?>
                            <tr class='item_product' id='id_{{$p->id}}'>
                              <th style='width: 10px'>#</th>
                              <td>{{$p->name}}</td>
                              <td>{{$p->name_product}}</td>
                              <td><a  data_id='{{$p->id}}' data_name='{{$p->name}}' data_cate='{{$p->name_product}}' id_class='id_{{$p->id}}'><span class='badge bg-red'><i class='fa fa-fw fa-close'></i></span></a></td>
                            </tr>
                            <?php }?>
                          </table>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                  <button type="submit" class="btn btn-success pull-right"><i class="fa  fa-plus-circle"></i> Chỉnh sửa
                  </button>
                </form>
              </div>
              <!-- /.box-body -->
            </div>
          </div>
        </section>
      </div>
    </div>

    <style type="text/css">
      .img_list{
        position: relative;
      }
      .img_list button{
        position: absolute;
        top: 10px;
        width: 43px;
        right: 10px;
        opacity: .4;
        transition: all .5s;
      }
      .img_list:hover button{
       opacity: 1;
     }
     .tab-content{
       padding: 25px 10px;
     }
   </style>
   @include('admin/layout/footer')
   <script>              

     CKEDITOR.replace( 'editor1' );
     $(".box-body form .btn-success").click(function(){
      var check=0;
      $(".form-group.required").each(function(){
       if($(this).children("input").val()==''){
        $(this).children(".text-red").text("Trường thông tin này không được để trống");
        check=1;
      }
    });
      $(".form-group.required_a").each(function(){
       if(!$(this).children("textarea").val()){
        $(this).children(".text-red").text("Trường thông tin này không được để trống");
        check=1;
      }
    });

      $(".form-group.select_a").each(function(){
       if($(this).children("select").val()==0){
        $(this).children(".text-red").text("Trường thông tin này không được để trống");
        check=1;
      }
    });
      if(check==1){
        return false;
      }
    });
     $(".img_list button").each(function(){
      
      $(this).click(function(){
        var str=$("#text_f").val();
        str=str.replace($(this).attr("data"), "");
        $("#text_f").val(str);
        $(this).parent().remove();
      });
    });
     var check=0;
     click_add();
     click_close();
     function click_add(){
      $(".add_product .item_product a").each(function(index){
        $(this).click(function(){
          getMessage($(this).attr('data_id'),'add');
          var classid=$(this).attr("id_class");
          var html=$("#"+classid+"").html();
          $(".remove_product").append("<tr class='item_product' id='"+$(this).attr("id_class")+"'>"+html+"</tr>");
          $("#"+classid+"").remove();
          click_close();
          return false;
        }); 
      });
    }

    function click_close(){
      $(".remove_product .item_product a").each(function(index){
        $(this).click(function(){
          getMessage($(this).attr('data_id'),'delete');
          var classid=$(this).attr("id_class");
          $("#"+classid+"").remove();
          click_add();
          return false;
        }); 
      });
    }
    function getMessage(id_product,type) {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'POST',
        url:"<?= route('add_ajax')?>",
        data: {
         id_list: jQuery('#id_group').val(),
         id_product:id_product,
         type:type
       },
       success:function(data) {
         return data;
       }
     });
    }
    
  </script>

</body>
</html>