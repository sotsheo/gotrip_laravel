<html>
<head>
    <title>Giới thiệu</title>
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
                    <li><a href="#"><i class="fa fa-home"></i>Giới thiệu</a></li>
                </ul>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <header class="panel-heading">
                                    <ul class="nav nav-tabs nav-justified">
                                         <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Thông tin</a>
                                    </li>

                                   
                                </ul>
                            </header>
                            <div class="box-body" style="padding: 10px;">
                                {{ Form::open(['files' =>'true']) }}
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        @include('admin/home/site/introduce/_form',
                                        ['errors'=>$errors,
                                        'model'=>$model])
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                            <button type="submit" class="btn btn-success pull-right">Chỉnh sửa</button>
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
