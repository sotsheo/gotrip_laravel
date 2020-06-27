<html>
<head>
	<title>{{$model->name}}</title>
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
								<li><a href="#"><i class="fa fa-home"></i> {{$model->name}}</a></li>
							</ul>
							<div class="row">
								<div class="col-xs-12">
									<div class="panel panel-default">
										<header class="panel-heading ">
											<a type="btn" class="btn btn-success pull-right btn-sm hidden-print" onClick="window.print();">Print</a>
											{{$model->name}}
										</header>

										<div class="box-body" style="padding:15px">
											<section class="scrollable wrapper">
												<div class="row">
													<div class="col-xs-6">
														<h4>Tên khách hàng: {{$model->name}}</h4>
														<p>Số điện thoại: <a href="tel:{{$model->phone}}">{{$model->phone}}</a></p>
														<p>Email: <a href="mailto:{{$model->email}}">{{$model->email}}</a></p>
														<p>Địa chỉ: {{$model->address}}</p>
														<p class="hidden-print">
															Trạng thái:
															<select style="height: 30px" class="process_change">
																<?php foreach($process as $key=>$va){ ?>
																	<option value="{{$key}}" 
																		{{($key==$model->process)?'selected':''}}>{{$va}}
																	</option>
																<?php } ?>
															</select>
														</p>
														<script type="text/javascript">
															function getMessage(urls,id,pro) {
														            $.ajax({
														                data: {"_token": "{{ csrf_token() }}",id:id,process:pro},
														                type:'POST',
														                url:urls,
														                success:function(data) {
														                	if(data.code==200){
														                		location.reload();
														                	}else{
														                		alert(console.log(data.messages));
														                	}
														                    //;
														               }
														           });
														        }
															$(document).ready(function(){
																$(".process_change").change(function(){
																	var val=$(this).find("option:selected").val();
																	getMessage("<?= route('changeprocess')?>",<?=$model->id?>,val);
																});
															});
														</script>
													</div>
													<div class="col-xs-6 text-right">
														<p class="h4">#{{$model->id}}</p>
														<h5>{{date('d/m/Y',$model->created_at)}}</h5>  
														<p>Nội dung: {{$model->note}}</p>         
													</div>
												</div>          
												
												<div class="line"></div>
												<table class="table">
													<thead>
														<tr>
															
															<th>Tên sản phẩm</th>
															<th >Số lượng</th>
															<th width="90">Giá</th>
															<th width="90">Tổng giá</th>
														</tr>
													</thead>
													<tbody>
														@if($products) 
															@foreach($products as $p)
															<tr>
																<td><a href="{{url($p['link'])}}" target="_blank">{{$p['name']}}</a></td>
																<td>{{$p['qty']}}</td>
																<td>{{number_format($p['price'])}} đ</td>
																<td>{{number_format($p['qty']*$p['price'])}} đ</td>
															</tr>
															@endforeach
														@endif
														<tr>
															<td colspan="3" class="text-right"><strong>Tổng giá</strong></td>
															<td>{{number_format($model->sum_price)}} đ</td>
														</tr>
														<tr>
															<td colspan="3" class="text-right no-border"><strong>Phí ship</strong></td>
															<td>{{number_format($price_ship)}} đ</td>
														</tr>
														<!-- <tr>
															<td colspan="3" class="text-right no-border"><strong>VAT Included in Total</strong></td>
															<td>$0.00</td>
														</tr> -->
														<tr>
															<td colspan="3" class="text-right no-border"><strong>Giá cuối</strong></td>
															<td><strong>{{number_format($model->sum_price-$price_ship)}} đ</strong></td>
														</tr>
													</tbody>
												</table>              
											</section>

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


</body>
</html>
