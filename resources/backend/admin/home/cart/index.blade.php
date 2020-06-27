<?php
use App\Http\Model\cart\Cart_model;

?>
<html>
<head>
	<title> Đặt hàng</title>
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
							<ul class="breadcrumb no-border no-radius b-b b-light pull-in hidden-print">
								<li><a href="#"><i class="fa fa-home"></i> Đặt hàng</a></li>
							</ul>
							<div class="row">
								<div class="col-xs-12">
									<div class="panel panel-default">
										<header class="panel-heading ">
											<a type="btn" class="btn btn-success pull-right btn-sm hidden-print" onClick="window.print();">Print</a>
											Đặt hàng
										</header>

										<div class="box-body" >
											<table class="table table-striped m-b-none">
												<thead>
													<tr>
														<th style="width:50px;"> <input type="checkbox" id="select_all"  name="select_all" ></th>
														<th>Tên</th>
														<th>Số điện thoại</th>
														<th>Email</th>
														<th>Địa chỉ</th>
														<th>Trạng thái</th>
														<th>Thời gian</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($carts as $key ):?>
														<tr>
															<th style="width:50px;"> <input type="checkbox" data="$key->id" class="select_id" name="select_id"></th>
															<td>{{ $key->name }}</td>
															<td>{{ $key->phone }}</td>															
															<td>{{ $key->email }}</td>
															<td>{{ $key->address }}</td>
															<td>{{ Cart_model::getMethodIn($key->process)}}</td>
															<td>{{ date('H:i:s d/m/Y',$key->created_at) }}</td>
															<td>

																<a href="{{ url('admin/cart/update') }}<?php echo('/'.$key->id); ?>" title="Edit"> <i class="fa  fa-edit "></i></a> 

																<a title="close" class="close_id" href="{{ url('admin/cart/delete') }}<?php echo('/'.$key->id); ?>"> <i class="fa fa-trash-o"></i></a>
															</td>

														</tr>
													<?php endforeach;?>
												</tbody>

											</table>
											<div class="page">
												{!! $carts->links() !!}
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
	</section>
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
