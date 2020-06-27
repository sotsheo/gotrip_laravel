<html>
<head>
    <title>Menu</title>
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
                    <li><a href="#"><i class="fa fa-home"></i> Bài viết</a></li>
                </ul>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <header class="panel-heading">
                                <a type="btn" class="btn btn-success pull-right btn-sm "  href="{{ url('admin/menu/create_category') }}">Thêm</a>
                                Menu
                            </header>
                            
                            <div class="box-body" >
                             <?php foreach($category as $key){?>
                                <div class="col-xs-6">
                                    <div class="panel panel-default">
                                        <header class="panel-heading">
                                           <a type="btn" class="btn btn-danger pull-right btn-sm "  href="{{ url('admin/menu/delete_category/') }}<?php echo('/'.$key->id); ?>"><i class="fa fa-trash-o"></i></a>
                                           <a href="{{ url('/admin/menu/edit_category/') }}<?php echo('/'.$key->id); ?>">{{$key->name}}</a>
                                        </header>

                                        <div class="box-body">
                                            <?php if(isset($menu[$key->id]) && $menu[$key->id]){?>
                                                <table class="table table-striped m-b-none">
                                                    <thead>
                                                        <tr>
                                                            <th>Tên </th>
                                                            <th>Vị trí</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($menu[$key->id] as $item){ if($item->id_category==$key->id){ ?>
                                                        <tr>
                                                            <td>{{$item->name}}</td>
                                                            <td>{{$item->orders}}</td>
                                                            <td class="tools">
                                                                <a href="{{ url('/admin/menu/update_menu/') }}<?php echo('/'.$item->id); ?>"><i class="fa fa-edit"></i></a>
                                                                <a href="{{ url('/admin/menu/delete_menu/') }}<?php echo('/'.$item->id); ?>"><i class="fa fa-trash-o"></i></a>
                                                            </td>
                                                        </tr>    
                                                        <?php } }?>                 
                                                    </tbody>
                                                </table>
                                            <?php } ?>
                                            <div class="add_v">
                                                <a type="btn" class="btn btn-success  btn-sm "   href="{{ url('/admin/menu/create_id/') }}<?php echo('/'.$key->id); ?>">Thêm menu</a>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            <?php } ?>

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
