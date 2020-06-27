<html>
<head>
    <title>Sản phẩm</title>
    @include('admin/layout/head')
    <script src="{{ asset('public/layout_admin/ckeditor/ckeditor.js')}}"></script>
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
                    <form role="form" action="{{route('coppy_product')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Sản phẩm</a>
                                </li>
                                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="true">Hình ảnh liên
                                        quan</a></li>

                            </ul>

                            <div class="tab-content">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        @include('admin/home/product/product/base/_form',
                                        ['errors'=>$errors,
                                        'model'=>$model])
                                    </div>
                                    <div class="tab-pane " id="tab_2">
                                        @include('admin/home/product/product/base/_form_img',
                                        ['errors'=>$errors, 'model'=>$model])
                                    </div>

                                </div>

                            </div>
                            <button type="submit" class="btn btn-success pull-right"><i class="fa  fa-plus-circle"></i>
                                Chỉnh sửa
                            </button>
                        </div>

                    </form>
                </div>
                <!-- /.box-body -->
            </div>
    </div>
    </section>
</div>
</div>

<style type="text/css">
    .img_list .contents{
        position: relative;
    }

    .img_list button {
        position: absolute;
        top: 10px;
        width: 43px;
        right: 10px;
        opacity: .4;
        transition: all .5s;
    }

    .img_list:hover button {
        opacity: 1;
    }

    .tab-content {
        padding: 25px 10px;
    }
</style>
@include('admin/layout/footer')

<script>
    CKEDITOR.replace('editor1');

    $(".box-body form .btn-success").click(function () {
        var check = 0;
        $(".form-group.required").each(function () {
            if ($(this).children("input").val() == '') {
                $(this).children(".text-red").text("Trường thông tin này không được để trống");
                check = 1;
            }
        });
        $(".form-group.required_a").each(function () {
            if (!$(this).children("textarea").val()) {
                $(this).children(".text-red").text("Trường thông tin này không được để trống");
                check = 1;
            }
        });

        $(".form-group.select_a").each(function () {
            if ($(this).children("select").val() == 0) {
                $(this).children(".text-red").text("Trường thông tin này không được để trống");
                check = 1;
            }
        });
        if (check == 1) {
            return false;
        }
    });


    $(document).ready(function () {
        $(".validate_price").each(function () {
            $(this).on("keypress keyup blur", function (event) {
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
        })
    })
</script>

</body>
</html>