

@extends('view.main')
@section('title','Thông tin order')
@section("content")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
	.giohang{
		background: #f1f1f1;
	}
	.giohang .item{
		margin-bottom: 10px;
	}
	.title_giohang{
		color: rgb(113, 113, 113);
		text-align: center;
		font-weight: 500;
		text-transform: uppercase;

	}
	.giohang .item .padder{
		padding: 0px 5px;
	}
</style>
<div class="giohang">
	<div class="container ">
		<div class="item">
			<div class="title_giohang">
				<h2>Thông tin order</h2>
			</div>
			<section class="panel panel-default">
				<h4 class="font-thin padder">Thông tin khách hàng</h4>
				<ul class="list-group">
					<li class="list-group-item">
						<p>Họ và tên: {{$model->name}} </p>
						<p>Số điện thoại: {{$model->phone}} </p>
						<p>Email: {{$model->email}} </p>
						<p>Nội dung: {{$model->content}} </p>
					</li>

				</ul>
			</section>
		</div>
		<div class="item">
			<section class="panel panel-default">
				<h4 class="font-thin padder">Thông tin sản phẩm</h4>
				<table class="table table-striped m-b-none">
					<thead>
						<tr>
							<th  width="150">Hình ảnh</th>
							<th>Tên sản phẩm</th>
							<th width="150" >Số lượng</th>                    
							<th width="250">Giá</th>
						</tr>
					</thead>
					<tbody>
						@if($items)
						@foreach($items as $p)
						<tr>
							<td><img src="{{url($p['img_path'].'/200x200/'.$p['img_name'])}}" style="max-width: 70px;max-height: 70px"></td>
							<td><a href="{{url($p['link'])}}" target="_blank">{{$p['name']}}</a></td>
							
							<td>{{$p['qty']}}</td>
							<td>{{number_format($p['price'])}} Đ</td>
						</tr>
						@endforeach
						@endif
					</tbody>
				</table>
			</section>
		</div>
		<div class="item">
			<div class="row">
				<div class="col-md-3 col-md-offset-9">
					<section class="panel panel-default">

						<table class="table table-striped m-b-none">

							<tbody>
								<tr>
									<td>Tổng tiền</td>
									<td>{{number_format($model->price_sum)}} Đ</td>
								</tr>
								<tr>
									<td>Ship</td>
									<td>{{number_format($model->price_ship)}} Đ</td>
								</tr>
								<tr>
									<td>Tổng tiền</td>
									<td>{{number_format($model->price_sum-$model->price_ship)}} Đ</td>
								</tr>
							</tbody>

						</table>
						<div class="btn_xb" style="text-align: right;padding: 5px;">
							<a class="btn btn-success" href="{{url('/')}}">Xác nhận</a>
						</div>

					</section>
				</div>
			</div>

		</div>

	</div>
</div>

@endsection