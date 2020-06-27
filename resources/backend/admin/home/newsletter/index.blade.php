<html>
<head>
    <title>Đăng ký nhận bản tin</title>
    @include('admin/layout/head')
</head>
<body class="app">

    <div class="">
        <section class="vbox">
            @include('admin/layout/header')

            <section>
                <section class="hbox stretch">

                    @include('admin/layout/nav')
                    <div id="content">
                        <section class="vbox">
                            <div class="scrollable padder">
                              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                                <li><a href="#"><i class="fa fa-home"></i>  Đăng ký nhận bản tin</a></li>
                            </ul>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-default">
                                        <header class="panel-heading">

                                            Đăng ký nhận bản tin
                                        </header>


                                        <div class="box-body">
                                            <table class="table table-striped m-b-none">
                                               <thead>
                                                <tr>
                                                    <th style="width:50px;"> <input type="checkbox" id="select_all"  name="select_all" ></th>
                                                    <th>Tên</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Thời gian gửi</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $i=0;
                                                foreach ($news as $key ){
                                                    $i++;
                                                    ?>
                                                    <tr class="{{($i<=$count)?'viewed':''}}">
                                                        <th style="width:50px;"> <input type="checkbox" data="$key->id" class="select_id" name="select_id"></th>
                                                        <td>{{ $key->name }}</td>
                                                        <td>{{ $key->email }}</td>
                                                        <td>{{ $key->phone }}</td>
                                                        <td>{{ date('d/m/Y', $key->date_create) }}</td>
                                                        <td>
                                                            <a title="close" class="close_id" href="{{ url('admin/newsletter/delete') }}<?php echo('/'.$key['id']); ?>"> 
                                                                <i class="fa  fa-trash-o "></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php }?>
                                            </tbody>

                                        </table>
                                        <div class="page">
                                            {!! $news->links() !!}
                                        </div>
                                    </div>
                                </div>

                            </section>
                        </div>
                    </div>

                    @include('admin/layout/footer')
                </section>
            </section>
        </section>
    </div>
    <style type="text/css">
        .pagination {
            float: right;
        }
        .table-bordered tbody  .viewed td{
            background-color:#e4e2e2 !important;
            border: 1px solid #e4e2e2 !important;
        }
    </style>
    <script>
        $(".close_id").each(function(){
            $(this).click(function(){
                var tb=confirm("Bạn có chắc xóa bạn ghi này không");
                if(tb != true){
                    return false;
                }

            });
        });

    </script>
</body>
</html>