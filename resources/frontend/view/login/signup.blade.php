
@extends('view.main_in')
@section('title','login')
@section("content")

<!-- banner in  -->
<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view_in',13);?>
<div class="product-page">
	<div class="shadow-open-filter"></div>
	<div class="container">
		<section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
			  <div class="container aside-xxl">
			    <!-- <a class="navbar-brand block" href="/">Admin</a> -->
			    <section class="panel panel-default bg-white m-t-lg">
			      <header class="panel-heading text-center">
			        <strong>Đăng nhập</strong>
			      </header>
			      <form  class="panel-body wrapper-lg" method="POST">
			        {{ csrf_field() }}

			        <div class="form-group">
			          <label class="control-label">Tên của bạn</label>
			           {{ Form::text('name',$model->name,['class'=>'form-control','placeholder'=>"Tên của bạn"])}}
			            <?php if(isset($errors) && $errors){?>
			           		<span class="text-red"><?= ($errors->has('name'))? $errors->first('name'):''; ?></span>
			            <?php } ?>
			        </div>
			        <div class="form-group">
			          <label class="control-label">Số điện thoại</label>
			           {{ Form::text('phone',$model->phone,['class'=>'form-control','placeholder'=>"Số điện thoại"])}}
			            <?php if(isset($errors)  && $errors){?>
			           		<span class="text-red"><?= ($errors->has('phone'))? $errors->first('phone'):''; ?></span>
			            <?php } ?>
			        </div>
			        <div class="form-group">
			          <label class="control-label">Email</label>
			           {{ Form::text('email',$model->email,['class'=>'form-control','placeholder'=>"Email"])}}
			            <?php if(isset($errors) && $errors){?>
			           		<span class="text-red"><?= ($errors->has('email'))? $errors->first('email'):''; ?></span>
			            <?php } ?>
			        </div>
			        <div class="form-group">
			          <label class="control-label">Địa chỉ</label>
			           {{ Form::text('address',$model->address,['class'=>'form-control','placeholder'=>"Địa chỉ"])}}
			           <?php if(isset($errors) && $errors){?>
			           <span class="text-red"><?= ($errors->has('address'))? $errors->first('address'):''; ?></span>
			            <?php } ?>
			        </div>
			        <div class="form-group">
			          <label class="control-label">Mật khẩu</label>
			           {{ Form::password('password',['class'=>'form-control','placeholder'=>"Mật khẩu"])}}

			          <?php if(isset($errors) && $errors){?>
			            <span class="text-red"><?= ($errors->has('password'))? $errors->first('password'):''; ?></span>
			          <?php } ?>
			          
			        </div>
			        <div class="form-group" style="border-bottom: 0px">
			          <button type="submit" class="btn btn-primary" >Đăng ký</button>
			        </div>
			      </form>
			    </section>
			  </div>
			</section>
	</div>
</div>
@endsection