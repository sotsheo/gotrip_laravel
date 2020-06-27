<?php
use App\Http\Model\cart\Cart_model;

?>
<?php $orders=Cart_model::getOrder(); ?>
<header class="bg-dark dk header navbar navbar-fixed-top-xs">
  <div class="navbar-header aside-md">
    <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
      <i class="fa fa-bars"></i>
    </a>
    <a href="#" class="navbar-brand" data-toggle="fullscreen"> {{ (auth()->user()->authorities==1)?'Admin':(auth()->user()->name) }}</a>
    <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
      <i class="fa fa-cog"></i>
    </a>
  </div>
  
  <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">
    <li class="hidden-xs">
      <a href="#" class="dropdown-toggle dk" data-toggle="dropdown">
        <i class="fa fa-bell"></i>
        @if(isset($orders) && count($orders)>0)
        <span class="badge badge-sm up bg-danger m-l-n-sm ">{{ count($orders)}}</span>
        @endif
      </a>
      @if(isset($orders) && count($orders)>0)
      <div class="dropdown-menu aside-xl">
        <div class="panel bg-white">
            <header class="panel-heading b-light bg-light">
              <strong>Đặt hàng <span class="" style="display: inline;">{{ count($orders)}}</span> </strong>
            </header>
            <div class="  animated fadeInRight">
                @foreach($orders as $ord)
                  <a href="{{url('/admin/cart/update/').'/'.$ord->id}}" class="media list-group-item" target="_blank">
                    <span class="media-body block m-b-none">
                      <?=$ord->name?><br>
                      <small class="text-muted">{{date('H:i:s d/m/Y',$ord->created_at)}}</small>
                    </span>
                  </a>
                @endforeach
            </div>
            
        </div>
      </div>
      @endif
    </li>
    <li class="dropdown">
      <a href="{{route('logout')}}" >Đăng xuất </a>
    </li>
  </ul>      
</header>
<style type="text/css">
  .input-group{
    display: flex;
    align-items: center;
  }
  .row.wrapper{
    padding: 10px;
  }
  .panel-heading a{
    margin-top: -5px;
    
  }
  .nav-primary ul.nav > li > a {
    font-weight: 500;
  }
  .panel .table thead > tr > th {
    font-size: 14px;
    font-weight: 500;
  }
  .breadcrumb i{
    margin-right: 5px;
  }

</style>

