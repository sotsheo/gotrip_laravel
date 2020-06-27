<html>
<head>
    <title>Widget</title>
    @include('admin/layout/head')
    <script src="{{ asset('public/layout_admin/ckeditor/ckeditor.js')}}"></script>
</head>
<body class="app">
    <section class="vbox">
        @include('admin/layout/header')
        <section>
          <section class="hbox stretch">
            @include('admin/layout/nav')
            <section id="content">
              <section class="vbox">          
                <section class="scrollable padder">
                   <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                    <li><a href="#"><i class="fa fa-home"></i> Sản phẩm</a></li>
                </ul>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default" >
                            <header class="panel-heading">

                                Widget
                            </header>
                            
                            <div class="box-body" style="padding: 10px;">
                                <form role="form"   method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group required">
                                    <div class="col-sm-2 control-label">
                                        <label>Tên</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Enter ..." name="name" >
                                        <span class="text-red"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2 control-label">
                                        <label>Text</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Enter ..." name="text_head" >
                                        <span class="text-red"></span>
                                    </div>
                                </div>
                                <div class="form-group select_a ">
                                    <div class="col-sm-2 control-label">
                                        <label>Type</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="type" id="type">
                                           <option value="0">Chọn type</option>
                                           <?php foreach($type as $t){?>
                                            <option value="{{$t}}">{{$t}}</option>
                                        <?php  } ?>
                                    </select>

                                    <span class="text-red"></span>
                                </div>
                            </div>
                            <div class="form-group select_a">
                                <div class="col-sm-2 control-label">
                                    <label>Number Type</label>
                                </div>
                                <div class="col-sm-10">
                                    <select class="form-control" name="number_type">
                                        <option value="0">Chọn type</option>
                                        <?php
                                        for($i=1;$i<=30;$i++){
                                            $chek=0;
                                            foreach($widget as $wg){
                                                if($wg->number_type==$i){
                                                   $chek=1;
                                               }
                                           }
                                           if($chek==0){
                                             ?>
                                             <option value="{{$i}}">{{$i}}</option>
                                         <?php  } $chek=0; }?>
                                     </select>
                                     <span class="text-red"></span>
                                 </div>
                             </div>
                             <div class="form-group">
                                <div class="col-sm-2 control-label">
                                    <label>Number Type</label>
                                </div>
                                <div class="col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"  name="show_name" value="1">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div id="grid">

                            </div>
                            <div class="form-group">
                                 <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success pull-right"><i class="fa  fa-plus-circle"></i> Thêm
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </section>
</section>
</section>
</section>
</section>
@include('admin/layout/footer')

<script>              

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
    $(document).ready(function(){
        var datas;
        $("#type").change(function(){

            var type=$(this).val();

            var url='<?= route('getDataWidget')?>';

            if(type){
              getMessage(url);
          }

      });
        function getMessage(urls) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {"_token": "{{ csrf_token() }}",'type':$("#type").val()},
                type:'POST',
                url:urls,
                success:function(data) {
                    if(data){
                        $(".result").addClass("active");
                        $("#grid").find('div').remove();
                        $("#grid").append(data);
                        remove();
                    }                
                    else{
                       $(".result").removeClass("active");
                   }
               }
           });
        }
    });
    function remove(){
        $("#item_result option").each(function(){
            $(this).remove();
        });
    }
</script>


</body>
</html>
