<html >
<head>
    <title>Combo</title>
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
                    <li><a href="#"><i class="fa fa-home"></i>Combo</a></li>
                </ul>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <header class="panel-heading">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active"><a href="#home" data-toggle="tab">Thông tin </a></li>
                                     <li class=""><a href="#time" data-toggle="tab">Thời gian </a></li>
                                     <li class=""><a href="#images" data-toggle="tab">Hình ảnh </a></li>
                                     <li class=""><a href="#seo" data-toggle="tab">Seo </a></li>
                                   
                                </ul>
                            </header>
                            <div class="box-body" style="padding: 10px;">
                                <div class="tab-content">
                                    {{ Form::open(['files' =>'true']) }}
                                        <div class="tab-pane active" id="home">
                                            @include('admin/home/combo/combo/base/_form',
                                                ['errors'=>$errors,
                                                'model'=>$model])
                                        </div>
                                         <div class="tab-pane " id="seo">
                                             @include('admin/home/combo/combo/base/seo',
                                                ['errors'=>$errors,
                                                'model'=>$model])
                                        </div>
                                        <div class="tab-pane " id="images">
                                             @include('admin/home/combo/combo/base/_form_img',
                                                ['errors'=>$errors,
                                                'model'=>$model,'images'=>$images])
                                        </div>
                                         <div class="tab-pane " id="time">
                                             @include('admin/home/combo/combo/base/time',
                                                ['errors'=>$errors,
                                                'model'=>$model,
                                                'combotime'=>$combotime,
                                                ])
                                        </div>
                                        
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success pull-right">Chỉnh sửa</button>
                                        </div>
                                    {{ Form::close() }}
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
    CKEDITOR.replace( 'description' );
    CKEDITOR.replace( 'price_include' );
    CKEDITOR.replace( 'price_not_included' );
    CKEDITOR.replace( 'policy' );
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
