<html>
<head>

    <title>Website</title>
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
                                <li><a href="#"><i class="fa fa-home"></i> Tin tức</a></li>
                            </ul>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-default" style="float: left;width: 100%;">
                                        <header class="panel-heading">
                                           
                                            Support
                                        </header>
                                    <div class="box-body" style="padding: 10px;float: left;width: 100%;">
                                        <?php $route=route('edit_support');?>
                                        @include('admin/home/site/support/_form',
                                        ['errors'=>$errors,
                                        "support"=>$support,
                                        'type_support'=>$type_support,
                                        'route'=>$route,
                                        'name'=>'Sửa'])
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
        .col-xs-1 i {
            line-height: 30px;
        }

        .box-body .item_sp {
            float: left;
            width: 100%;
            margin-bottom: 10px;
        }

        .btn-info {
            width: 150px;
            float: left;
        }

        #select_form {
            margin-bottom: 10px;
        }

        .item_sp .col-xs-3 {
            position: relative;
        }

        .item_sp .col-xs-3:after {
            content: '';
            position: absolute;
            top: 0;
            height: 100%;
            width: 100%;
            left: 0;
            background: transparent;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {

        });
        $('#add_item').click(function () {
            var name = $("#select_form :selected").text();
            if ($('#select_form').val() != 0) {
                var count = parseInt($("#count").val());
                count++;
                $("#count").val(count);
                $(".group_sp").append("<div class='item_sp'><div class='col-xs-3'><input type='text' class='form-control'  name='item_type_" + count + "' value='" + name + "'></div><div class='col-xs-4'><input type='text' class='form-control'  name='item_name_" + count + "'></div><div class='col-xs-4'> <input type='text' class='form-control' name='item_link_" + count + "'> <input type='text' class='form-control' name='item_type_id_" + count + "' style='display:none' value='" + $("#select_form").val() + "'></div><div class='col-xs-1'><a><i class='fa fa-window-close' aria-hidden='true'></i></a></div>");
            }
        });
    </script>
</body>
</html>