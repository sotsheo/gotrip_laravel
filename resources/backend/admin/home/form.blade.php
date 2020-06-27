<html>
    <head>
    @include('admin/layout/head')
    <script src="{{ asset('ckeditor/ckeditor.js')}}"></script>
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
                                 <h3 class="box-title">Thêm bài viết</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                            <form role="form" action="{{route('add_news')}}"   method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Tên</label>
                                        <input type="text" class="form-control" placeholder="Enter ...">
                                </div>

                                <div class="form-group">
                                    <label>Url</label>
                                        <input type="text" class="form-control" placeholder="Enter ...">
                                </div>
                            
                                <div class="form-group">
                                    <label>Danh mục bài viết</label>
                                        <select class="form-control">
                                            <option>option 1</option>
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>
                                </div>

                                <div class="form-group">
                                    <label>Mô tả ngắn</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Nội dung bài viết</label>
                                    <textarea name="editor1" id="editor1" rows="10" cols="80">
                                           
                                    </textarea>
                                </div>
                              
                                <div class="form-group">
                                    <label for="exampleInputFile">Hình ảnh</label>
                                    <input type="file" id="exampleInputFile">

                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">
                                             Bài viết nổi bật
                                        </label>
                                    </div>
                                </div>

                               
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                        <select class="form-control">
                                            <option>option 1</option>
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>
                                </div>

                                <div class="form-group">
                                    <label>Từ khóa</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Thời gian đăng</label>
                                    <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Thời gian public</label>
                                    <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepickers">
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
    </script>

    </body>
</html>