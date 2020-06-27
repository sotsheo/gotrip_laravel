<html>
<head>
    <title>Quản lý tài khoản</title>
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
                    <li><a href="#"><i class="fa fa-home"></i> Quản lý tài khoản</a></li>
                </ul>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <header class="panel-heading">
                                <a type="btn" class="btn btn-success pull-right btn-sm "  href="{{ url('admin/user/create') }}">Thêm</a>
                                Quản lý tài khoản
                            </header>
                            
                            <div class="box-body" >
                               <table class="table table-striped m-b-none">
                                   <thead>
                                    <tr>
                                        <th style="width:50px;"> <input type="checkbox" id="select_all"  name="select_all" ></th>
                                        <th>Tên</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($user as $key ):?>
                                        <tr>
                                            <th style="width:50px;"> <input type="checkbox" data="$key['id']" class="select_id" name="select_id"></th>
                                            <td>{{ $key['name'] }}</td>
                                            <td>
                                                <a href="{{ url('admin/user/update') }}<?php echo('/'.$key['id']); ?>" title="Edit"> <i class="fa  fa-edit "></i></a> 
                                                <a title="close" class="close_id" href="{{ url('admin/user/delete') }}<?php echo('/'.$key['id']); ?>"> <i class="fa  fa-close "></i></a>
                                            </td>
                                        </tr>

                                    <?php endforeach;?>


                                </tbody>
                            </table>
                            <div class="page">
                                {!! $user->links() !!}
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
