

@extends('view.main')
@section('title','Đặt hàng')
@section("content")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('resources/assets/css/cart.css')}}">
<div class="giohang">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<header class="panel-heading ">
						Thông tin khách hàng
					</header>

					<div class="box-body" style="padding:15px">
						<section class="scrollable wrapper">
							<h2>Thông tin cá nhân</h2>
							<form role="form"    method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div class="form-group required">
										<label>Tên</label>
										<input type="text" class="form-control" placeholder="Họ tên ..." name="name" value="{{$model->name}}">
										<?php if(isset($validate)){ ?>
											<span class="text-red"><?= ($validate->has('name'))? $validate->first('name'):''; ?></span>
										<?php } ?>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div class="form-group">
										<label>Số điện thoại</label>
										<input type="text" class="form-control" placeholder="Phone ..." name="phone" 
										value="{{$model->phone}}">
										<?php if(isset($validate)){ ?>
											<span class="text-red"><?= ($validate->has('phone'))? $validate->first('phone'):''; ?></span>
										<?php } ?>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div class="form-group">
										<label>Email</label>
										<input type="email" class="form-control" placeholder="Email ..." name="email" 
										value="{{$model->email}}">
										<?php if(isset($validate)){ ?>
											<span class="text-red"><?= ($validate->has('email'))? $validate->first('email'):''; ?></span>
										<?php } ?>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div class="form-group required_a">
										<label>Địa chỉ</label>
										<input type="text" class="form-control" placeholder="Địa chỉ ..." name="address" 
										value="{{$model->address}}">
										<?php if(isset($validate)){ ?>
											<span class="text-red"><?= ($validate->has('address'))? $validate->first('address'):''; ?></span>
										<?php } ?>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div class="form-group ">
										<label>Ghi chú</label>
										<textarea class="form-control" rows="3" placeholder="Nội dung" 
										name="note" value="{{$model->note}}"></textarea>
										<?php if(isset($validate)){ ?>
											<span class="text-red"><?= ($validate->has('note'))? $validate->first('note'):''; ?></span>
										<?php } ?>
									</div>
								</div>
								<div class="col-sm-12 ">
									<button type="submit" class="btn btn-success pull-right">Thanh toán
									</button>
								</div>
							</form>

						</section>

					</div>
				</div>
			</div>
			<div class="col-md-4 ">
				<div class="panel panel-default">
					<header class="panel-heading ">
						Thông tin sản phẩm
					</header>
					<div class="if_product">
						<div class='item '>
							<table>
								<tr>
									<th>Tên sản phẩm</th>
									<th>Số lượng</th>
									<th>Giá</th>
								</tr>
								@foreach($products as $p)
								<tr>
									<td>{{$p['name']}}</td>
									<td>{{$p['qty']}}</td>
									<td>{{ number_format($p['qty'] * $p['price'] ,0 ,'.' ,'.').' Đ'}}</td>
								</tr>
								@endforeach
							</table>
							<div>
								<form>
									<input type='text' name='code_product' placeholder="Mã giảm giá">
									<button type="submit"><i class="fa fa-send"></i></button>
								</form>
							</div>

						</div>
					</div>
					
				</div>
			</div>
		</div>
		
	</div>
</div>


@endsection