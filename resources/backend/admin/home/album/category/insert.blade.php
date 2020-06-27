<html >
<head>
    <title>Danh mục Album</title>
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
                    <li><a href="#"><i class="fa fa-home"></i> Danh mục Album</a></li>
                </ul>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <header class="panel-heading">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active"><a href="#home" data-toggle="tab">Thông tin </a></li>
                                   
                                    <li class=""><a href="#seo" data-toggle="tab">SEO</a></li>
                                   
                                </ul>
                            </header>
                            <div class="box-body" style="padding: 10px;">
                                <div class="tab-content">
                                    {{ Form::open(['files' =>'true']) }}
                                        <div class="tab-pane active" id="home">
                                            @include('admin/home/album/category/_form',
                                                ['errors'=>$errors,
                                                'model'=>$model,
                                                'name'=>'Chỉnh sửa'])
                                        </div>
                                       
                                        <div class="tab-pane"  id="seo">
                                            @include('admin/home/album/category/_form_seo',
                                                ['errors'=>$errors,
                                                'model'=>$model,
                                                'name'=>'Chỉnh sửa'])
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success pull-right">Thêm mới</button>
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
