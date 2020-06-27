<html>
<head>
    <title>Sản phẩm</title>
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
                    <li><a href="#"><i class="fa fa-home"></i> Sản phẩm</a></li>
                </ul>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <header class="panel-heading">
                                <a type="btn" class="btn btn-success pull-right btn-sm "  href="{{ url('admin/product/create') }}">Thêm</a>
                                       Sản phẩm
                            </header>
                            <div class="row wrapper">
                                      <div class="col-sm-8">
                                        <form>
                                        <div class="input-group">
                                            
                                                <input class="input-sm form-control" type="text" name="name" id='name' placeholder="Nhập tên sản phẩm" value="{{ (isset($where['name']))? $where['name']:'' }}">
                                           
                                                <?php
                                                $id=(isset($where['id_category']))?$where['id_category']:0;
                                                ?>
                                                <select name="id_category" class="input-sm form-control">
                                                    <option value="0" {{($id==0)?'selected':''}}>Lựa chọn danh mục</option>
                                                    @foreach ($category as $item )
                                                    <option value="{{ $item->id }}" {{($id==$item->id)?'selected':''}}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            
                                                <?php
                                                $id=(isset($where['status']))?$where['status']:-1;
                                                ?>
                                                <select name="status" class="input-sm form-control">
                                                    <option value="-1" {{($id==-1)?'selected':''}}>Lựa chọn trạng thái</option>
                                                    <option value="1" {{($id==1)?'selected':''}}>Hiện </option>
                                                    <option value="0" {{($id==0)?'selected':''}}>Ẩn</option>
                                                </select>
                                            
                                            <div class="item_search" style="width: 250px;">
                                                <button type="submit" style="padding: 4px;">Tìm kiếm</button> 
                                            </div>
                                           
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            <div class="box-body" >
                                 <table class="table table-striped m-b-none">
                                        <thead>
                                        <tr>
                                            <th style="width:50px;"> <input type="checkbox" id="select_all"  name="select_all" ></th>
                                            <th>Tên</th>
                                            <th>Hình ảnh </th>
                                            <th>Danh mục</th>
                                            <th>Trạng thái</th>
                                            <th>Sản phẩm hot</th>
                                            <th>Giá thị trường</th>
                                            <th>Giá bán</th>
                                            <th>Ngày tạo</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($product as $key ):?>
                                        <tr>
                                            <th style="width:50px;"> <input type="checkbox" data="$key->id" class="select_id" name="select_id"></th>
                                            <td>{{ $key->name }}</td>
                                            <td>
                                                <?php
                                                if($key->img_root){
                                                    ?>
                                                    <img src="<?= url($key->img_root)?>" style="max-width: 50px;"/>
                                                    <?php }?>
                                                </td>  
                                                <td>
                                                    <?php foreach($category as $cat){
                                                        if($cat->id==$key->id_category){
                                                            echo($cat->name);
                                                        }
                                                    }?>
                                                </td>     
                                                <td><?=( $key->status==1) ? 'Hiển thị' :'Ẩn' ?></td>     
                                                <td><?=( $key->ishot==0) ? '' :'Hot' ?></td>   
                                                <td><?=( number_format($key->price_market))?> đ</td>   
                                                <td><?=( number_format($key->price))  ?> đ</td>  
                                                <td>{{ date('d/m/Y', $key->created_at) }}</td>
                                                <td>
                                                   <a href="{{ url($key->link) }}" title="view"> <i class="fa fa-search"></i></a> 
                                                   <a href="{{ url('admin/product/update') }}<?php echo('/'.$key->id); ?>" title="Edit"> <i class="fa  fa-edit "></i></a> 
                                                    <a href="{{ url('admin/product/coppy') }}<?php echo('/'.$key->id); ?>" title="Coppy"><i class="fa fa-fw fa-copy"></i></a> 
                                                   <a title="close" class="close_id" href="{{ url('admin/product/delete') }}<?php echo('/'.$key['id']); ?>"> <i class="fa  fa-trash-o "></i></a></td>
                                               </tr>
                                               <?php endforeach;?>
                                           </tbody>

                                    </table>
                                    <div class="page">
                                        {!! $product->links() !!}
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
