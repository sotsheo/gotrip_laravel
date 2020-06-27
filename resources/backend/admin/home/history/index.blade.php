<?php 
use App\Http\Model\history\History_model;
use App\User;
?>
<html>
<head>
    <title>Lịch sử</title>
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
                                Lịch sử 
                            </header>
                            
                            <div class="box-body" >
                               <table class="table table-striped m-b-none">
                                <thead>
                                    <tr>
                                        <th style="width:50px;"> <input type="checkbox" id="select_all"  name="select_all" ></th>
                                        <th>Tài khoản</th>
                                        <th>Hành động</th>
                                        <th>Dữ liệu</th>
                                        <th>Thời gian</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($history as $key ):?>
                                        <tr>
                                            <th style="width:50px;"> <input type="checkbox" data="$key->id" class="select_id" name="select_id"></th>
                                           
                                            <?php $user=User::find($key->user_id) ?>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ History_model::getAction($key->action) }}</td>
                                            <td>{{ History_model::getTableName($key->name_table) }}</td>
                                            <td>{{ date('d/m/Y',$key->created_at) }}</td>
                                            <td>
                                            	<?php if($key->action==History_model::ACTION_UPDATE){ ?>
                                                	<a href="{{ url('admin/history/update') }}<?php echo('/'.$key->id); ?>" title="Edit"> <i class="fa fa-edit "></i></a> 
                                            	<?php } ?>
                                            	<?php if($key->action==History_model::ACTION_DELETE){ ?>
                                                	<a href="{{ url('admin/history/restore') }}<?php echo('/'.$key->id); ?>" title="Restore"> <i class="fa fa-undo "></i></a> 
                                                	<a href="{{ url('admin/history/delete') }}<?php echo('/'.$key->id); ?>" title="Delete"> <i class="fa fa-trash-o "></i></a> 
                                            	<?php } ?>
                                            </td>

                                        </tr>
                                    <?php endforeach;?>
                                </tbody>

                            </table>
                             <div class="page">
                            {!! $history->links() !!}
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


</body>
</html>
