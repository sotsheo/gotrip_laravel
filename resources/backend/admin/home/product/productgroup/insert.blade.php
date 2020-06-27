<html>
<head>
    <title>Nhóm sản phẩm</title>
    @include('admin/layout/head')
    <script src="{{ asset('layout_admin/ckeditor/ckeditor.js')}}"></script>
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
                        <h3 class="box-title">Nhóm sản phẩm</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" action="{{route('create_list')}}"   method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group required">
                                <label>Tên</label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="name">
                                <span class="text-red"></span>
                            </div>

                            <div class="form-group required_a">
                                <label>Mô tả ngắn</label>
                                <textarea class="form-control" rows="3" placeholder="Enter ..." name="short_description"></textarea>
                                <span class="text-red"></span>
                            </div>

                            <div class="form-group">
                                    <label>Nội dung </label>
                                    <textarea name="editor1" id="editor1" rows="10" cols="80" >
                                    </textarea>
                                </div>


                            <div class="form-group">
                                <label for="exampleInputFile">Hình ảnh</label>
                                <input type="file" id="exampleInputFile" name="img">

                            </div>
                            <div class="form-group ">
                                <label>Thứ tự</label>
                                <input type="text" class="form-control" placeholder="Enter ..." name="location">
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
                                    <input type="text" class="form-control pull-right" id="datepicker" name="date_create">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success pull-right"><i class="fa  fa-plus-circle"></i> Thêm
                            </button>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </section>
    </div>
</div>

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
        if(check==1){
            return false;
        }
    });
</script>

</body>
</html>