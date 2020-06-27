

@extends('view.main')
@section('title','Đặt hàng')
@section("content")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('resources/assets/css/cart.css')}}">
<div class="giohang">
	<div class="container">
		<div class="panel panel-default">
			<header class="panel-heading ">
				
				Giỏ hàng
			</header>

			<div class="box-body" style="padding:15px">
				<section class="scrollable wrapper">
					<div class="box-body">
						@if(count($products)>0)
						<div class="giohang">
							<div class="title">
								<div class="name">
									<h3>Tên sản phẩm</h3>
								</div>
								<div class="price">
									<h3>Giá</h3>
								</div>
								<div class="number_p">
									<h3>Số lượng</h3>
								</div>
								<div class="prices">
									<h3>Tổng tiền</h3>
								</div>
							</div>
							<div class="contents">
								<?php foreach($products as $c){?>
									<div class="item">
										<div class="name">
											<img src="{{url($c['img_path'].'/400x400/'.$c['img_name'])}}">
											<h2><a href="<?= url($c['link'])?>">{{$c['name']}} </a></h2>
										</div>
										<div class="group">
											<div class="price">
												<p>{{number_format((int)$c['price'],0 ,'.' ,'.')}} Đ</p>
											</div>
											<div class="number_p">
												<div class="div_count">
													<a href="javascript:void(0);" class="amount-down" id_data='<?php echo($c['id']); ?>'>
														<button >
															<i class="fa fa-minus" aria-hidden="true"></i>
														</button>
													</a>
													<input type="text" name="{{$c['id']}} " value="{{$c['qty']}}" class="number">
													<a href="javascript:void(0);" class="amount-up" id_data='<?php echo($c['id']); ?>'>
														<button >
															<i class="fa fa-plus" aria-hidden="true"></i>
														</button>
													</a>
												</div>
											</div>
										</div>
										<div class="prices">
											<p>{{number_format((int)$c['qty']*(int)$c['price'],0 ,'.' ,'.')}} Đ</p>
										</div>
										<a href="{{ url('cart/delete/') }}<?php echo('/'.$c['id']); ?>" title="Edit" class='close_item'><i class="fa  fa-close "></i></a> 
									</div>
								<?php }?>

							</div>
						</div>
					</div>
					<!-- /.box-body -->
					@else
					<p>Hiện tại không có sản phẩm trong giỏ hàng</p>
					@endif

				</section>
				<div class="continew">
					<a type="button" class="btn btn-block btn-primary" href="{{ url('/') }}">Tiếp tục mua hàng</a>
					@if(count($products)>0)
					<a type="button" class="btn btn-block btn-success" href="{{ url('order/order') }}">Thanh toán</a>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('.number').bind("cut copy paste drag drop", function(e) {
			e.preventDefault();
		});     
		$(".div_count .amount-down").each(function(){
			$(this).click(function(){
				var giatri=parseInt($(this).siblings('.number').val())-1;
				var id=$(this).attr("id_data");
				if( giatri>=0){
					$(this).siblings('.number').val(giatri);
					increaseQty(id,giatri);
				}

			})
		});
		$(".div_count .amount-up").each(function(){
			$(this).click(function(){
				var giatri=parseInt($(this).siblings('.number').val())+1;
				var id=$(this).attr("id_data");
				if( giatri>=0){
					$(this).siblings('.number').val(giatri);
					increaseQty(id,giatri);
				}

			})
		});
	});
	function isNumberKey(evt) {
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}
	function increaseQty(id, qty) {
		document.location="<?=url('/order/update')?>" +  "/"+id + "/" + qty;
		
	}
</script>

@endsection