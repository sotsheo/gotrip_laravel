<html>
<head>
    @include('admin/layout/head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('admin/layout/header')
        <section>
            <section class="hbox stretch">
                @include('admin/layout/nav')
                <div id="content">
                    <div class="vbox">
                        <div class="scrollable padder">
                            <div class="content-wrapper">
                                <!-- Content Header (Page header) -->
                                <section class="content">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="box">
                                                <div class="box-header">
                                                    <h3 class="box-title">Data Table With Full Features</h3>
                                                </div>
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Rendering engine</th>
                                                                <th>Browser</th>
                                                                <th>Platform(s)</th>
                                                                <th>Engine version</th>
                                                                <th>CSS grade</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Trident</td>
                                                                <td>Internet
                                                                    Explorer 4.0
                                                                </td>
                                                                <td>Win 95+</td>
                                                                <td> 4</td>
                                                                <td>X</td>
                                                            </tr>
                                                        </tbody>

                                                    </table>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                            <!-- /.box -->
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            @include('admin/layout/footer')
        </section>
    </section>
</section>
</body>
</html>