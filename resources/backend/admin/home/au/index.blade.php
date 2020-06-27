<html>
<head>
    <title>Phân quyền</title>
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
                                <li><a href="#"><i class="fa fa-home"></i> Phân quyền</a></li>
                            </ul>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-default">
                                        <header class="panel-heading">
                                            <a type="btn" class="btn btn-success pull-right btn-sm "  href="{{ url('admin/au/create') }}">Thêm</a>
                                             Phân quyền
                                        </header>


                                        <div class="box-body">
                                            <table class="table table-striped m-b-none">

                                                <thead>
                                                    <tr>
                                                        <th style="width:50px;"> <input type="checkbox" id="select_all"  name="select_all" ></th>
                                                        <th>Tên quyền</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($au as $key ):?>
                                                        <tr>
                                                            <th style="width:50px;"> <input type="checkbox" data="$key['id']" class="select_id" name="select_id"></th>
                                                            <td>{{ $key['name'] }}</td>
                                                            <td>
                                                                <a href="{{ url('admin/au/update') }}<?php echo('/'.$key['id']); ?>" title="Edit"> <i class="fa  fa-edit "></i></a> 
                                                                <a title="close" class="close_id" href="{{ url('admin/au/delete') }}<?php echo('/'.$key['id']); ?>"> <i class="fa  fa-close "></i></a>
                                                            </td>
                                                        </tr>

                                                    <?php endforeach;?>


                                                </tbody>
                                            </table>
                                            {!! $au->links() !!}
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
    </body>
    </html>