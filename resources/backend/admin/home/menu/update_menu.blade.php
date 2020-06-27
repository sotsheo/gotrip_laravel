<html >
<head>
    <title>Menu</title>
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
                        <li><a href="{{ url('admin/news') }}"><i class="fa fa-home"></i> Menu</a></li>
                    </ul>
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="panel panel-default">
                                <div class="tab-pane active" id="home">
                                    <header class="panel-heading">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab_v1" data-toggle="tab" aria-expanded="true">Thông tin cơ bản</a></li>
                                           
                                        </ul>
                                    </header>
                                    <div class="box-body" style="padding: 10px;">
                                        <div class="tab-content">
                                           <form role="form"    method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="nav-tabs-custom">

                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab_v1">

                                                        @include('admin/home/menu/menu/_form',
                                                        ['errors'=>$errors,
                                                        'model'=>$model,
                                                        'name'=>'Sửa'])
                                                    </div>
                                                    <div class="tab-pane" id="tab_v2">
                                                        @include('admin/home/menu/menu/_form_menu',
                                                        ['errors'=>$errors,

                                                        'name'=>'Sửa'])
                                                    </div>

                                                </div>
                                                <!-- /.tab-content -->
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success pull-right">Chỉnh sửa</button>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>

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
        else{
            $(this).children(".text-red").text("");
        }
    });
        $(".form-group.required_a").each(function(){
           if(!$(this).children("textarea").val()){
            $(this).children(".text-red").text("Trường thông tin này không được để trống");
            check=1;
        }
        else{
            $(this).children(".text-red").text("");
        }
    });


        if(check==1){
            return false;
        }
    });
</script>

</body>
</html>
