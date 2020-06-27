<html>
<head>
    <title>Sản phẩm</title>
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
                    <li><a href="#"><i class="fa fa-home"></i>Sản phẩm</a></li>
                </ul>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <header class="panel-heading">
                                <ul class="nav nav-tabs nav-justified">
                                 <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Sản phẩm</a>
                                 </li>
                                 <li class="">
                                    <a href="#tab_2" data-toggle="tab" aria-expanded="true">Hình ảnh liên
                                    quan</a>
                                </li>
                                @if($setting->product_together)
                                <li class="">
                                    <a href="#tab_3" data-toggle="tab" aria-expanded="true">Sản phẩm mua cùng</a>
                                </li>
                                <li class="">
                                    <a href="#tab_4" data-toggle="tab" aria-expanded="true">Tin tức sản phẩm</a>
                                </li>
                                @endif

                                <li class="">
                                    <a href="#seo" data-toggle="tab" aria-expanded="true">SEO</a>
                                </li>
                                @if($setting->product_qrcode)
                                    <li class="">
                                        <a href="#qrcode" data-toggle="tab" aria-expanded="true">QRCODE</a>
                                    </li>
                                @endif
                            </ul>
                        </header>
                        <div class="box-body" style="padding: 10px;">
                            {{ Form::open(['files' =>'true']) }}
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    @include('admin/home/product/product/base/_form',
                                    ['errors'=>$errors,
                                    'model'=>$model,'product_root'=>$product_root])
                                </div>
                                <div class="tab-pane " id="tab_2">
                                    @include('admin/home/product/product/base/_form_img',
                                    ['errors'=>$errors, 'model'=>$model,'images'=>$images])
                                </div>
                                @if($setting->product_together)
                                <div class="tab-pane " id="tab_3">
                                    @include('admin/home/product/product/base/_form_together',
                                    ['errors'=>$errors, 'model'=>$model])
                                </div>
                                <div class="tab-pane " id="tab_4">
                                    @include('admin/home/product/product/base/_form_newstogether',
                                    ['errors'=>$errors, 'model'=>$model])
                                </div>
                                @endif
                                <div class="tab-pane " id="seo">
                                    @include('admin/home/product/product/base/_form_seo',
                                    ['errors'=>$errors, 'model'=>$model])
                                </div>
                                @if($setting->product_qrcode)
                                    <div class="tab-pane " id="qrcode">
                                        @include('admin/home/product/product/base/_form_qrcode',
                                        ['errors'=>$errors, 'model'=>$model])
                                    </div>
                                @endif
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success pull-right">Chỉnh sửa</button>
                                    </div>
                                    
                                </div>
                            </div>
                            {{ Form::close() }}
                            
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
    CKEDITOR.replace('description');
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
