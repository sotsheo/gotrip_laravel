@extends('view.main_in')
@section('title','Đặt hàng combo')
@section("content")
<?php 
use  App\Http\Model\province\Province_model;
use  App\Http\Model\combo\Combo_model;
use  App\Http\Model\flight\Airline_model;
use  App\Http\Model\flight\Flight_model;
?>
<div class="order-cart-page">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="detail-price">
					<h2>
						Chi tiết giá
					</h2>
					<ul>

						<li>
							<p>
								Giá gốc <b><?= number_format($combo['time']['price'])?>đ</b>
							</p>
						</li>
						<li>
							
							<p>
								Gotrip giúp bạn tiết kiệm <span>-<?=number_format($combo['time']['price_sale_1'])?>đ</span>
							</p>
										
						</li>
						<li>
							<p>
								Người lớn <b><?=$combo['people']?> x <?= number_format($combo['time']['price_sum'])?>đ</b>
							</p>
						</li>
					</ul>

					<div class="total">
						<h3>
							Tổng số tiền thanh toán <span><?= number_format($price_total)?>đ</span>
						</h3>
					</div>
				</div>
				<div class="infor-combo">
					<div class="title-box">
						<h2>
							Thông tin combo
						</h2>
					</div>
					<div class="img">
						<img src="{{url($combo['combo']->img_path.'/400x400/'.$combo['combo']->img_name)}}" 
												alt="<?=$combo['combo']['name']?>">
					</div>
					<h3>

						<a href="{{url($combo['combo']['link'])}}"><?=$combo['combo']['name']?></a>
					</h3>
					<div class="gr-star">
						<?php for($i=0;$i<$combo['hotel']['star'];$i++){ ?>
						<img src="{{ asset('resources/assets/images/star.png')}}" alt="">
						<?php } ?>
					</div>
					<div class="option-combo">
						<p>
							<img src="{{ asset('resources/assets/images/ic-clock.png')}}" alt=""> 
							<?=$combo['time']['time_night']?> đêm,  phòng: <?=$combo['hotel_room']['name']?>
						</p>
						<p>
							<img src="{{ asset('resources/assets/images/ic-group-user.png')}}" alt=""> 2 người lớn
						</p>
						<?php if($combo['time']['planes_from_id']){ 

							$plances=Flight_model::find($combo['time']['planes_from_id']);
								if($plances){
									$airl=Airline_model::find($plances->airline_id);
							?>
							<?php
								$from=Province_model::getName($plances->province_id_from);
								$to=Province_model::getName($plances->province_id_to);
							?>

							<p>
								<img src="{{ asset('resources/assets/images/ic-lich.png')}}" alt=""> Ngày về: {{date('d/m/Y',$plances->from)}}
								<span class="airline">
									<?php if($airl && $airl->img_path){ ?>
									<img src="{{url($airl->img_root)}}" 
												alt="<?=$airl->name?>">
									<?php } ?>{{date('H:s',$plances->from)}} | <?=$from?>  -   {{date('H:s',$plances->from)}} | <?=$to?>
								</span>
							</p>
						<?php } } ?>

						<?php if($combo['time']['planes_to_id']){ 
							$plances=Flight_model::find($combo['time']['planes_to_id']);
								if($plances){
									$airl=Airline_model::find($plances->airline_id);
							?>
								<?php
									$from=Province_model::getName($plances->province_id_from);
									$to=Province_model::getName($plances->province_id_to);
								?>

							<p>
								<img src="{{ asset('resources/assets/images/ic-lich.png')}}" alt=""> Ngày về: {{date('d/m/Y',$plances->from)}}
								<span class="airline">
									<?php if($airl && $airl->img_path){ ?>
									<img src="{{url($airl->img_root)}}" 
												alt="<?=$airl->name?>">
									<?php } ?>
								{{date('H:s',$plances->from)}} | <?=$from?>  -   {{date('H:s',$plances->from)}} | <?=$to?>
								</span>
							</p>
						<?php } } ?>
					</div>
				</div>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<div class="note-camket">
					<h2>
						Gotrip cam kết bảo mật thông tin cá nhân của quý khách
					</h2>
					<p>
						Mọi thông tin cá nhân của quý khách nhập tại đây đều được bảo mật
					</p>
				</div>
				<div class="form-order-cart awe-check">
					 {{ Form::open(['files' =>'true']) }}
						<div class="item-input">
							<label for="">Vui lòng điền thông tin của bạn</label>
							<div class="group-check-box">
								<div class="radio">
									{{ Form::radio('prefix',$model->prefix,['class'=>'form-control','placeholder'=>"Họ và tên"])}}
									<label><span class="text-clip" title="Anh">Anh</span></label>
								</div>
								<div class="radio">
									{{ Form::radio('prefix',$model->prefix,['class'=>'form-control','placeholder'=>"Họ và tên"])}}
									<label><span class="text-clip" title="Chị">Chị</span></label>
								</div>
							</div>
						</div>
						<div class="item-input">
							<label for="">Họ và tên</label>
							<span>Chú ý có khoảng cách giữa Họ và tên của bạn</span>
							{{ Form::text('name',$model->name,['class'=>'form-control','placeholder'=>"Họ và tên"])}}
							<span class="text-red"><?= ($errors->has('name'))? $errors->first('name'):''; ?></span>
						</div>
						<div class="item-input">
							<label for="">Email</label>
							<span>Gotrip sẽ gửi Thông tin đặt COMBO tới địa chỉ Email này</span>
							{{ Form::email('email',$model->email,['class'=>'form-control','placeholder'=>"Email"])}}
							<span class="text-red"><?= ($errors->has('email'))? $errors->first('email'):''; ?></span>
						</div>
						<div class="item-input">
							<label for="">Số điện thoại</label>
							<span>Sau khi gửi email Gotrip sẽ gọi điện cho bạn qua số này để xác nhận dịch vụ và hướng dẫn thanh toán</span>
							{{ Form::text('phone',$model->phone,['class'=>'form-control','placeholder'=>"SĐT"])}}
							<span class="text-red"><?= ($errors->has('phone'))? $errors->first('phone'):''; ?></span>
						</div>
						<div class="item-input">
							<label for="">Quý khách có Mã giảm giá / Quà tặng?</label>
							<span>Chấp nhận Mã giảm giá / Quà tặng cung cấp bởi URBOX</span>
							<input type="text" placeholder="" style="width: 200px" name="code" id="code">
							<button value="" style="width: 120px; margin-left: 15px;" class="code_check">Áp dụng</button>
							<style type="text/css">

							 .form-order-cart .item-input .code_check{
							   	padding: 5px 15px;
							    border: 1px solid #ebebeb;
							    margin-top: 6px;
							}
							</style>
							<script type="text/javascript">
								$(".code_check").click(function(){
									var url='<?= route('checkCode')?>';
									if($("#code").val()){
										checkCode(url);
									}
									console.log($("#code").val());
									return false;
									
								});
								function checkCode(urls) {
							            $.ajax({
							                
							                data: {"code":$("#code").val(),"_token": "{{ csrf_token() }}",},
							                type:'POST',
							                url:urls,
							                success:function(data) {
							                    
							               }
							           });
							        }
							   
							</script>
						</div>
						<div class="item-input item-submit">
							<label for="">Đừng bỏ lỡ! Giá đang rất tốt nhé!</label>
							<button type="submit">TIẾP TỤC</button>
						</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection