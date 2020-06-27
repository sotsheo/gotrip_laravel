<?php 
use App\Http\Model\province\Province_model;
use App\Http\Model\flight\Airline_model;
use App\Http\Model\flight\Flight_model;
?>
<html>
<head>
    <title>Chuyến bay</title>
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
                    <li><a href="#"><i class="fa fa-home"></i> Chuyến bay</a></li>
                </ul>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <header class="panel-heading">
                                <a type="btn" class="btn btn-success pull-right btn-sm "  href="{{ url('admin/flight/create') }}">Thêm</a>
                                Chuyến bay
                            </header>
                            <div class="row wrapper">
                                <div class="col-sm-8">
                                    
                                    
                                </div>
                                    <div class="box-body" >
                                       <table class="table table-striped m-b-none">
                                        <thead>
                                            <tr>
                                                <th style="width:50px;"> <input type="checkbox" id="select_all"  name="select_all" ></th>
                                                <th>Hãng bay</th>
                                                <th>Loại</th>
                                                <th>Địa điểm bay</th>
                                                <th>Địa điểm đến</th>
                                                <th>Thời gian khởi hành</th>
                                                <th>Thời gian hạ cánh</th>
                                                <th>Giá</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($model as $key ):?>
                                                <tr>
                                                    <th style="width:50px;"> <input type="checkbox" data="$key->id" class="select_id" name="select_id"></th>
                                                    <td>{{ Airline_model::getName($key->airline_id) }}</td>
                                                    <td>{{ Flight_model::getDirector($key->type) }}</td>
                                                    <td>{{ $key->address_from_text }}</td>
                                                    <td>{{ $key->address_to_text }}</td>

                                                    <td>{{ date('H:i d/m/yy',$key->time_from) }}</td>
                                                    <td>{{ date('H:i d/m/yy',$key->time_to) }}</td>
                                                     <td>{{ number_format($key->price) }} đ</td>
                                                    <td><?=( $key->status) ? 'Hiển thị' :'Ẩn' ?></td>
                                                    <td>
                                                       
                                                        <a href="{{ url('admin/flight/update') }}<?php echo('/'.$key->id); ?>" title="Update"> <i class="fa  fa-edit "></i></a> 

                                                        <a title="close" class="close_id" href="{{ url('admin/flight/delete') }}<?php echo('/'.$key->id); ?>"> <i class="fa fa-trash-o"></i></a>
                                                    </td>

                                                </tr>
                                            <?php endforeach;?>
                                        </tbody>

                                    </table>
                                     <div class="page">
                                    {!! $model->links() !!}
                                </div>
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
