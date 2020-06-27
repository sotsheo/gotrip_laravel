<html>
<head>
    <title>Chi tiết lịch sử</title>
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
                    <li><a href="#"><i class="fa fa-home"></i>Chi tiết lịch sử</a></li>
                </ul>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <header class="panel-heading">
                                <ul class="nav nav-tabs nav-justified">
                                   <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Thông tin </a>
                                   </li>
                                   
                                   
                                   
                               </ul>
                           </header>
                           <div class="box-body" style="padding: 10px;">
                            
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    @include('admin/home/history/_form',
                                    ['data'=>$data,
                                    'model'=>$model])
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



</body>
</html>
