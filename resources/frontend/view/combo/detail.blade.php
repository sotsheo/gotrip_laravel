@extends('view.main_in')
@section('title',$model->name)
@section("content")
<?php 
use  App\Http\Model\province\Province_model;
use  App\Http\Model\combo\Combo_model;
use  App\Http\Model\flight\Airline_model;
?>
<div class="section1">
	
	
	<div class="search-trip">
		<div class="flex-center">
			<div class="container">
				<div class="tool-search-trip">
					<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view',12);?>

				</div>
			</div>
		</div>
	</div>
</div>
<link rel="stylesheet" href="{{ asset('resources/assets/css/vensdor/jquery.fancybox.min.css')}}" />
<div class="interview-detail-trip">
	<div class="container">


		<div class="name-detail-trip">
			<h1>
				<?= $model->name?>
			</h1>
		</div>
		<div class="gr-star">
			<?php for($i=1;$i<=$hotel->star;$i++){?>
				<img src="{{ asset('resources/assets/images/star-b.png')}}" alt="">
			<?php }?>
		</div>
		<div class="location">
			<i class="sprite sprite-ic-location-hv"></i> <?= $hotel->address?>
		</div>
		<div class="row">
			<div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
				<div class="slider-img-detail">
					<?php if($images) {?>
						<?php foreach($images as $image){?>
							<div class="item-img-detail">
								<img src="{{url($image->path.'/800x800/'.$image->name)}}" alt="" data-fancybox="gallery" href="{{url($image->path.$image->name)}}">
							</div>
						<?php }?>
					<?php }?>
				</div>
				<div class="slider-img-small">
					<?php if($images) {?>
						<?php foreach($images as $image){?>
							<div class="item-img-detail">
								<img src="{{url($image->path.'/400x400/'.$image->name)}}" 
								alt="{{$model->name}}">
								<div class="info">
									<i class="fa fa-plus" aria-hidden="true"></i>
								</div>
							</div>
						<?php }?>
					<?php }?>
				</div>
			</div>
			<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
				<div class="title-infor-detail">
					<h2>
						<img src="images/ic-gif.png" alt=""> <?= $model->name?>
					</h2>
					<div class="gr-star">
						<?php for($i=1;$i<=$hotel->star;$i++){?>
							<img src="images/star-b.png" alt="">
						<?php }?>
					</div>
					<div class="group-countdown">
						<?php $price_sale=($combo_time['price_type']==Combo_model::TYPE_2)?$combo_time['price_sale']:$combo_time['price_sale_1']; ?>
						<div class="price-detail">
							<?php if($price_sale){ ?>
								<span><?=number_format($combo_time['price']).' đ'?></span>
							<?php } ?>
							<b><?=number_format($combo_time['price_sum']).' đ'?>/khách</b>
						</div>
						<?php if($price_sale) {?>
							<div class="tag-countdown">
								<span>Tổng tiết kiệm</span>
								<b><?=number_format($price_sale).' đ'?></b>
							</div>
						<?php }?>
					</div>
					<div class="option-ctn-infor">
						<?php
						$from=Province_model::getName($combo_time->province_from);
						$to=Province_model::getName($combo_time->province_to);
						?>
						<?php if($from && $to){?>
							<p>
								<span style="margin-right: 20px"><i class="fa fa-map-marker" aria-hidden="true" style="float: none;color: #2389c5;"></i>Từ: <?= $from?></span>
								<span><i class="fa fa-location-arrow" aria-hidden="true" style="float: none;color: #2389c5;"></i> Đến: <?= $to?></span>
							</p>
						<?php } ?>
						<p>
							<i class="sprite sprite-ic-hotel"></i> <?= $combo_time->time_night?> đêm tại khách sạn tiêu
							chuẩn <?=$hotel->star?> sao
						</p>
						<p>
							<i class="sprite sprite-ic-clock-2"></i> Khởi hành ngày
							<?= date('d/m/yy',$combo_time->time_start)?>
						</p>
						<div class="group_v">
							<h3>Điểm nổi bật</h3>
							<p>
								<i class="sprite sprite-ic-bed-3"></i> Phòng Tiêu chuẩn Giường Đôi
							</p>
							<p>
								<i class="sprite sprite-ic-hotel"></i> <?= $combo_time->time_night?> đêm tại khách sạn <?=$hotel->name?>
							</p>
							<?php if($combo_time->planes_to_id){?>
								<p>
									<i class="sprite sprite-ic-plane-3"></i> Vé máy bay khứ hồi
								</p>
							<?php }?>
						</div>
						<div class="group_v">
							<p>
								<i class="fa fa-user-circle-o" aria-hidden="true" style="float: none;color: #2389c5;"></i> <?=$combo_time->number_order?> Đã đặt 
							</p>
						</div>

					</div>
					<div class="btn-order">
						<a class="order_btn" href="<?=url('combo/order_').$model->id.'_'.$combo_time->id?>">ĐẶT NGAY <span style="display: block;font-size: 12px;">Gotrip sẽ liên hệ với bạn sau 30 phút</span></a>
					</div>
					<div class="note">
						<i class="fa fa-clock-o"></i> Giá Có Thể Thay Đổi Trong: <span id="time_p">5</span> phút <span id="time_s"></span> giây
					</div>
					<script type="text/javascript">
						function startTimer(p, s) {

							setInterval(function () {
								tem=s;
								if(tem--==0){
									if(p>0){
										p--;
										s=60;
									}else{
										location.reload();
									}
								}
								s--;
								$("#time_p").html(p);
								$("#time_s").html(s);
							}, 1000);
						}

						window.onload = function () {
							startTimer(5, 0);
						};
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="detail_combo">
	<div class="container ">
		<div class="col-md-12">
			<div class="article-package">
				<div class="row content-view include-policy">
					<div class="col-md-6">
						<div class="box-info box-offline">
							<div class="box-header" id="package-include">

								<div class="box-tittle">
									<div class="block-title">Dịch vụ bao gồm</div>
								</div>

								<div class="box-body">
									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Vé máy bay theo hành trình, bay Hàng không Quốc gia Việt Nam - Vietnam Airlines</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Thuế sân bay, bảo hiểm hàng không và phụ phí xăng dầu hàng không</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 02 đêm nghỉ phòngVilla tại Vinpearl Resort &amp; Golf Nam Hội An 5* + 01 đêm nghỉ phòngDeluxe Room khách sạn Roliva Hotel 4* (tiêu chuẩn 2 người lớn/phòng)</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 02 bữa buffet sáng theo tiêu chuẩn tại khách sạnVinpearl Resort &amp; Golf Nam Hội An 5* + 01 bữa buffet sáng theo tiêu chuẩn tại khách sạn Roliva Hotel 4*</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 02 bữa trưa + 02 bữa tối theo tiêu chuẩn tại Vinpearl Resort &amp; Golf Nam Hội An 5*</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Vé vui chơi không giới hạn trong ngày tại công viên giải trí Vinwonder (chỉsử dụng trong 1 ngày và không áp dụng cho ngày ở cuối cùng)</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Miễn phí tiền phòng cho tối đa 02 trẻ em &lt;4 tuổi/phòng (ngủ chung giường với cha mẹ)</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Miễn phí sử dụng bể bơi, phòng tập Gym tại khách sạn</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Miễn phí sử dụng internet, wifi trong khuôn viên khách sạn.</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Trà, cà phê, nước suối miễn phí trong phòng.</p>
								</div>
							</div>
							<div class="box-header" id="package-include">

								<div class="box-tittle">
									<div class="block-title">Dịch vụ không bao gồm</div>
								</div>
								<div class="box-body">



									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Thuế VAT</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Xe ô tôđưa đón trong chương trình</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Trẻ em từ 12 tuổi trở lên tính như người lớn</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Phí nhận phòng sớm/trả phòng muộn (theo quy định của khách sạn)</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Phụ thu nâng hạng phòng</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Các chi phí không đề cập ở phần bao gồm</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="box-info box-offline">
							<div class="box-header" id="package-policy">

								<div id="menu9" class="box-tittle">
									<div class="block-title">Chính sách</div>
								</div>
								<div class="box-body">
									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Độ tuổi: Quý khách phải từ 18 tuổi trở lên mới được phép tham gia đặt dịch vụ trên website.</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Xác nhận thông tin đặt combo: Sau khi nhận được thông tin đặt dịch vụ của Quý khách, chúng tôi sẽ gửi email cho Quý khách để xác nhận thông tin đặt dịch vụ và yêu cầu thanh toán.</p>

									<p style="text-align: justify;">Thông tin xác nhận cuối cùng và chính xác là lúc Quý khách đã hoàn tất việc thanh toán combo. Ngược lại, việc đặt combo của Quý khách có thể bị huỷ bỏ nếu Quý khách không thực hiện thanh toán theo đúng thời hạn chúng tôi đã thông báo.</p>
								</div>
							</div>
							<div class="box-header" id="package-policy">
								<div class="box-tittle">
									<div class="block-title">Điều kiện</div>
								</div>
								<div class="box-body">
									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Huỷ dịch vụ trước 30 ngày so với ngày khởi hành: Phạt 20% tổng giá trị đơn hàng.</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Huỷ dịch vụ trong vòng 30 ngày so với ngày khởi hành: Phạt 100% tổng giá trị đơn hàng.</p>

									<p style="text-align: justify;"><strong>5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; LƯU Ý</strong></p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Giá combo áp dụng cho 01 người lớn</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Do chương trình nghỉ tại villa 2/3/4 phòng ngủ của Vinpearl resort &amp; Golf Nam Hội An 5* nên bán một lượt 4 combo trở lên (khuyến khích đặt số lượng người lớn chẵn: 4– 6 – 8…. Và villa sẽ không kê được extra bed).</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Giá dành cho khách quốc tịch Việt Nam.</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Phụ thu trẻ em tính theo năm sinh (không tính theo ngày tháng năm sinh).</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Khi đi máy bay Quý khách nên mang theo một trong các giấy tờ sau: (Chứng minh thư nhân dân còn hạn dưới 15 năm, hoặc hộ chiếu, giấy khai sinh (đối với trẻ em dưới 14 tuổi).</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Với trẻ em 14 tuổi ( Yêu cầu phải có CMTND, nếu trường hợp chưa có phải có giấy xác nhận nhân thân theo mẫu và đóng dấu của địa phương nơi cư trú).</p>

									<p style="text-align: justify;">-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Với trẻ em không đi cùng bố mẹ phải có giấy xác nhận ủy quyền của bố mẹ có xác nhận của địa phương nơi cư trú cho người đi cùng, để làm thủ tục lên máy bay.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="">
					<span class="btn btn--view-more more-include-policy ">Xem thêm  <i class="fa fa-chevron-down"></i></span>
					<span class="btn btn--view-more less-include-policy hide">Thu gọn  <i class="fa fa-chevron-up"></i></span>
				</div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">

    .item-room table{
        width: 100%;
    }
    .item-room table td:last-child{
        width: 150px;
    }
    .description_at{
        float: left;
        width: 100%;
        height: 245px;
        overflow: hidden;
        position: relative;
    }
    .description_at.active{
        height: unset;
    }

    .description_at .more_v_page {
        position: absolute;
        bottom: 0px;
        height: 40px;
        text-align: center;
        width: 100%;
        background: rgba(216, 216, 216, 1);
        margin-top: 30px;
        /* box-shadow: 0px -42px 0px 3px rgba(243, 240, 240, 0.25);*/
    }
    .description_at .more_v_page a{
        display: block;
        line-height: 38px;
    }
    .slider-img-small{
        margin-top: 10px;
        float: left;
        width: 100%;
    }
    .slider-img-small img{
        padding: 0px 3px;
    }
    
    .slick-prev, .slick-next {
     display: inline-block;
     font: normal normal normal 14px/1 FontAwesome;
     font-size: 20px;
     color: #0a162a;
     -webkit-font-smoothing: antialiased;
     padding: 12px;
     text-indent: 1px;
     text-align: center;
     transition: all .5s;
 }
 .slick-prev:hover, .slick-next:hover{
    background: #fff;
}
.slick-prev:hover:after, .slick-prev:hover:before,
.slick-next:hover:after, .slick-next:hover:before {
    background:transparent;
}
.slider-img-small .item-img-detail{
    position: relative;
}
.group_v{
    float: left;
    width: 100%;
    border-top: 1px solid rgba(255, 255, 255, .5);
    padding: 13px 0px;
}
.group_v h3{
    margin: 0px;
    font-size: 16px;
    color: #fff;
    margin-bottom: 15px;
    font-weight: 700;
    /*text-align: center;*/
}
.info{
    position: absolute;
    left: 0px;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,.5);
    z-index: -1;
    color: #fff;
    display:  flex;
    align-items: center;
    transition: all .5s;
    font-size: 20px;
}
.slider-img-small .slick-current .info{
   z-index: 1;
}
.info i{
    text-align: center;
    margin: 0 auto;
}
</style>
<style type="text/css">
	
	.detail_combo{
		float: left;
		width: 100%;
	}
	.detail_combo .article-package {
		min-height: 20px;
		padding-bottom: 30px;
		border-bottom: 0.4px solid #ccc;
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
		background-color: #fff;
		position: relative;
		margin-bottom: 30px;
	}
	.detail_combo .article-package .include-policy {
		height: 250px;
	}

	.detail_combo .article-package .content-view {
		overflow: hidden;
		transition: height 0.2s;
		padding: 20px 0px;
	}
	.detail_combo .box-tittle {
		padding-bottom: 5px;
		border-bottom: 1px solid #e5e5e5;
	}
	.detail_combo .box-tittle .block-title {
		font-size: 22px;
		font-weight: 400;
	}
	.detail_combo .box-header .box-body {
		margin-top: 10px;
	}
	.article-package .btn--view-more {
		position: absolute;
		top: 100%;
		left: 50%;
		width: 120px;
		margin-left: -60px;
		margin-top: -15px;
		text-align: center;
		background-color: #ffffff;
		border: solid 1px #0770cd;
		color: #0770cd;
		padding: 4px;
		transition: 0.3s;
	}

</style>
<script type="text/javascript">
	$(document).ready(function(){
		$(".more-include-policy").click(function(){
			$(".include-policy").height("auto");
			$(this).addClass("hide");
			$(".less-include-policy").removeClass("hide");
		});
		$(".less-include-policy").click(function(){
			$(".include-policy").height("250");
			$(this).addClass("hide");
			$(".more-include-policy").removeClass("hide");
		});
	});
</script>

<!-- chi tiet -->
<div class="ctn-detail-trip">
	<div class="container">
		<div class="title-name">
			<h2>Chi Tiết Combo</h2>
		</div>
		<div class="book-plane-trip">
			<h3>
				<img src="{{ asset('resources/assets/images/ic-giff2.png')}}" alt=""> 
				<?= $model->name ?>          
			</h3>
			<div class="group-plane-trip">
				<div class="airline-trip">
					<!-- chiều đi  -->
					<?php if($flight_from){ ?>
						<?php 
						$from=Province_model::getName($flight_from->province_id_from);
						$to=Province_model::getName($flight_from->province_id_to);
						$airline=Airline_model::find($flight_from['airline_id']);
						?>
						<div class="item-airline">
							<p>
								<i class="sprite sprite-ic-plane-3"></i> 
								Chiều đi: <?=$from?> > <?=$to?>                     
							</p>
							<div class="img">
								<a href="">
									<img src="{{url($airline->img_path.'/200x200/'.$airline->img_name)}}">
								</a>
							</div>
							<div class="infor">
								<b><?=date('H:i',$flight_from['time_from'])?></b>
								<p><?=date('d/m/Y',$flight_from['time_from'])?></p>
								<p>
									<?=$from?>                            
								</p>
							</div>
							<div class="arr">
								<img src="{{ asset('resources/assets/images/arr-long.png')}}" alt="1">
							</div>
							<div class="infor">
								<b><?=date('H:i',$flight_from['time_to'])?></b>
								<p><?=date('d/m/Y',$flight_from['time_to'])?></p>
								<p>
									<?=$to?>                                
								</p>
							</div>
						</div>
					<?php } ?>
					<?php if($flight_to){ ?>
						<?php 
						$from=Province_model::getName($flight_to->province_id_from);
						$to=Province_model::getName($flight_to->province_id_to);
						$airline=Airline_model::find($flight_to['airline_id']);
						?>
						<div class="item-airline">
							<p>
								<i class="sprite sprite-ic-plane-3"></i> 
								Chiều đi: <?=$from?> > <?=$to?>                     
							</p>
							<div class="img">
								<a href="">
									<img src="{{url($airline->img_path.'/200x200/'.$airline->img_name)}}">
								</a>
							</div>
							<div class="infor">
								<b><?=date('H:i',$flight_to['time_from'])?></b>
								<p><?=date('d/m/Y',$flight_to['time_from'])?></p>
								<p>
									<?=$from?>                            
								</p>
							</div>
							<div class="arr">
								<img src="{{ asset('resources/assets/images/arr-long.png')}}" alt="1">
							</div>
							<div class="infor">
								<b><?=date('H:i',$flight_to['time_to'])?></b>
								<p><?=date('d/m/Y',$flight_to['time_to'])?></p>
								<p>
									<?=$to?>                                
								</p>
							</div>
						</div>
					<?php } ?>
					<?php if($hotel_room){ ?>
						<div class="room-airline">
							<div class="img">
								<a href="">
									<img src="<?= url($hotel_room->img_path . '/s400_400/' . $hotel_room->img_name) ?>"
									alt="<?= $hotel_room->name?>">
								</a>
							</div>
							<div class="title">
								<h4>
									<a href=""><?= $hotel_room->name?></a>
								</h4>
								<div class="option">
									<span><i class="sprite sprite-ic-user-2"></i> <?=$hotel_room->no_of_persons?>
								Khách</span>
								<span><i class="sprite sprite-ic-home"></i><?= $hotel_room->acreage?></span>
							</div>
							<div class="option">
								<?php if($hotel_room->bed){?>
									<b><i class="sprite sprite-ic-bed-4"></i><?=$hotel_room->bed?> Giường Đơn</b>
								<?php }?>
								<?php if($hotel_room->double_bed){?>
									<b><i class="sprite sprite-ic-bed-4"></i><?=$hotel_room->double_bed?> Giường Đôi</b>
								<?php }?>
								<?php if($hotel_room->breakfast){?>
									<b><i class="sprite sprite-ic-dao"></i> Bao gồm ăn sáng</b>
								<?php }?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="order-trip">
				<div class="infor-order">
					<p>
						Gotrip tìm thấy giá tốt cho bạn
					</p>
					<b>
						<?=number_format($combo_time['price_sum']).' đ'?>/khách
					</b>
					<?php if($combo_time->planes_to_id){?>
						<span>(vé máy bay khứ hồi + <?= $combo_time->time_night?> đêm khách sạn)</span>
					<?php }?>
				</div>
				<div class="item">
					<?php if($price_sale){?>
						<p>
							Giá gốc: <span><?=number_format($combo_time['price']).' đ'?></span>
						</p>
					<?php }?>
					<?php if($price_sale) {?>
						<p>Bạn tiết kiệm được:
							<b><?=number_format($price_sale).' đ'?></b>
						</p>
					<?php }?>
				</div>
				<div class="btn-order">
					<a class="order_btn" href="<?=url('combo/order_').$model->id.'_'.$combo_time->id?>">ĐẶT NGAY<span style="display: block;font-size: 12px;">Gotrip sẽ liên hệ với bạn sau 30p</span></a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<div class="ctn-detail-trip">
	<div class="container">
		<div class="book-plane-trip">
			<h3>
				Lịch khởi hành
			</h3>
			<div class="group-plane-trip">
				<div class="airline-trip">
					<div class="combo_time ">
						<div class="title">
							<div class="">
								Ngày khởi hành
							</div>
							<div class="hiden_mobile">
								Số lượng ngày 
							</div>
							<div class="hiden_mobile">
								Số lượng người 
							</div>
							<div class="">
								Giá
							</div>
						</div>
						<div class="content">
							<?php foreach($combotime as $key=>$val){ ?>
								<div class="item">
									<div class="title_center">
										<div class="">
											T5 11/06/2020 06:00                                        
										</div>
										<div class="hiden_mobile">
											4                                        
										</div>
										<div class="hiden_mobile">
											12                                        
										</div>
										<div class="">
											<?=number_format($val['price_sum'])?> VND
											<i class="fa fa-plus-circle" aria-hidden="true"></i>
										</div>
									</div>

									<div class="content_item">
										<div class="left">
											<div class="row_item">
												<div class="column_item">
													<p>
														<span class="number_peopel" id="peopel_<?=$val['id']?>">1</span>
														người lớn
														<span class="price">  x <?=number_format($val['price_sum'])?></span>
													</p>
												</div>
												<div class="column_item">
													<div class="btn-group">
														<button type="button" class="btn number-button minus-adult" target_id="peopel_<?=$val['id']?>">
															<i class="fa fa-minus"></i>
														</button>
														<button type="button" class="btn number-button plus-adult" target_id="peopel_<?=$val['id']?>">
															<i class="fa fa-plus"></i>
														</button>
													</div>
												</div>
											</div>
											<div class="row_item">
												<div class="column_item">
													<p>
														<span class="number_peopel_child" id="child_<?=$val['id']?>">1</span>
														trẻ em
														<span class="price">  x 
															<?=number_format($val['price_children']-$val['price_sale_2'])?>	
														</span>
													</p>
												</div>
												<div class="column_item">
													<div class="btn-group">
														<button type="button" class="btn number-button minus-adult" target_id="child_<?=$val['id']?>">
															<i class="fa fa-minus"></i>
														</button>
														<button type="button" class="btn number-button plus-adult" target_id="child_<?=$val['id']?>">
															<i class="fa fa-plus"></i>
														</button>
													</div>
												</div>
											</div>
										</div>
										<div class="right ">
											<div class="btn-order">
												<a class="check_price" target_chil="child_<?=$val['id']?>" target_peopel="peopel_<?=$val['id']?>" target_price_chil="<?=$val['price_children']-$val['price_sale_2']?>" target_price_peopel="<?=$val['price_sum']?>" id="<?=$val['id']?>" room="">Xem giá</a>
											</div>

										</div>
									</div>
								</div>
							<?php } ?>
						</div>

					</div>
				</div>
				<div class="order-trip">
					<div class="item">
						<p>Số lượng người lớn: <b class="count_peopel">2</b></p>
						<p>Giá người lớn:<b class="price_peopel">6,590,000 VNĐ</b></p>
						<p>Số lượng trẻ em: <b class="count_child">0</b></p>
						<p>Giá trẻ em:<b class="price_child">5,990,000 VNĐ</b></p>
					</div>
					<div class="btn-order">
						<a class=" order_now" href="/combo/order-combo/order.html?id=49&amp;room=&amp;time=232">ĐẶT NGAY<span style="display: block;font-size: 12px;">Gotrip sẽ liên hệ với bạn sau 30p</span></a>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			$(document).ready(function(){
				$(".combo_time .title_center").each(function(){
					$(this).click(function(){
                // $('.content_item').slideUp();
                $(this).siblings('.content_item').slideToggle();

            });
				});
				$(".combo_time .minus-adult").each(function(){

					$(this).click(function(){
						var id=$(this).attr("target_id");
						number=parseInt($("#"+id).html());
						
						if((number-1)>0){
							$("#"+id).html(number-1);
						}
						
					});
				});
				$(".combo_time .plus-adult").each(function(){

					$(this).click(function(){
						var id=$(this).attr("target_id");
						number=parseInt($("#"+id).html());
						number++;
						$("#"+id).html(number);
					});
				});
				function formatNumber(num) {
					return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
				}
				$(".combo_time .check_price").each(function(){

					$(this).click(function(){
						var number_peopel=parseInt($("#"+$(this).attr("target_peopel")).html());
						var number_chil=parseInt($("#"+$(this).attr("target_chil")).html());
						var price_peopel=parseInt($(this).attr("target_price_peopel"));
						var price_chil=parseInt($(this).attr("target_price_chil"));
						$(".count_peopel").html(number_peopel);
						$(".count_child").html(number_chil);
						price=price_peopel*number_peopel;
						$(".price_peopel").html(formatNumber(price)+' VNĐ');
						price=price_chil*number_chil;
						$(".price_child").html(formatNumber(price)+' VNĐ');
						var id=$(this).attr("id");
						var room=$(this).attr("room");
						var url="?time="+id;
						if(room){
							url+="&room="+id;
						}
						if(number_peopel){
							url+="&count="+number_peopel;
						}
						if(number_chil){
							url+="&count_chi="+number_chil;
						}
						url+="&order="+1;
						$(".order_now").attr("href",window.location.href+url);
						
						return false;
					});
				});
				
			});
		</script>
	</div>
	<div class="order-trip">

	</div>
</div>
<style type="text/css">
    .combo_time .title{
        display: table;
        width: 100%;
        border: 1px solid #ffffff;
        background: #33afe4;
        color: #ffff;
        padding: 10px;
    }
    .combo_time .title >div{
        display: table-cell;
        width: 25%;
    }
    .combo_time .content .item .title_center{
        display: table;
        
        width: 100%;

    }
    .combo_time .content .item {
        float: left;
        width: 100%;
        border: 1px solid #d4d2d2;
        border-bottom: 0px;
        
    }
    .combo_time .content .item:last-child{
        border-bottom: 1px solid #d4d2d2;

    }
    .combo_time .content .item .title_center >div{
        display: table-cell;
        width: 25%;
        padding: 10px;
        float: left;

    }

    .combo_time .content .item  i{
        float: right;
    }
    .content_item{
        width: 100% !important;
        float: left;
    }
    .row_item{
        float: left;
        /*width: 100%;*/
    }
    .content_item .left{
        width: 60%;
    }
    .column_item{
        margin-right: 15px;
        float: left;
    }
    .column_item p{
        margin: 0px;
        padding: 10px;
        width: 187px;
    }
    .column_item p span{
        color: #1a3863;
    }
    .column_item p span.price{
        color: #e1bd0d;
    }
    .combo_time .content .item >div.content_item{
        display: none;
    }
    .combo_time .content .item >div.content_item .right{
        padding-right: 10px;
        padding-bottom: 10px;
    }
    @media(max-width: 767px){
        .hiden_mobile{
            display: none !important;
        }
        .combo_time .title >div ,
        .combo_time .content .item .title_center >div {
            display: table-cell;
            width: 50%;
        }
        .column_item {
            width: 30%;
        }
        .row_item .column_item:first-child {
            width: 60%;
        }
        .row_item {
            width: 100%;
        }
        .content_item .left {
            width: 100%;
        }
    }
    
</style>
@endsection