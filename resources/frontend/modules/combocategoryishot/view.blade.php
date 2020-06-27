<?php 
use App\Http\Model\combo\Combo_model;
use App\Http\Model\province\Province_model;
?>
<?php if($data){?>
<div class="break-br"></div>
<div class="hot-price">
	<?php foreach ($data as $key => $value) { ?>
		<?php if($data[$value['id']]['item']){ ?>
			<div class="container">
				<div class="title-standard">
					<h2>
						<?=$value['name']?>
					</h2>
					<p>
						<?=$value['short_description']?>
					</p>
				
				</div>
				<div class="row multi-columns-row">
					
						<?php foreach ($data[$value['id']]['item'] as $key2 => $value2) { ?>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="item-hot-price">
								<div class="img">
									<a href="<?= url($value2['link'])?>">
										<img src="<?=$value2['img_root']?>" alt="">
									</a>
									<div class="range-trip">
										<span><i class="sprite sprite-ic-plane"></i> <?=Province_model::find($data[$value['id']]['item'][$value2['id']]['time'][0]['province_from'])['name']?></span>
										<img src="{{ asset('resources/assets/images/arr-long-2.png')}}" alt="">
										<span><i class="sprite sprite-ic-place"></i> <?=Province_model::find($data[$value['id']]['item'][$value2['id']]['time'][0]['province_to'])['name'] ?></span>
									</div>
								</div>
								<div class="title">
									<h3>
										<a href="<?=$value2['link']?>"><?=$value2['name']?></a>
									</h3>
									<div class="time">
										<i class="sprite sprite-ic-clock"></i> <?=$data[$value['id']]['item'][$value2['id']]['time'][0]['time_day']?> ngày <?=$data[$value['id']]['item'][$value2['id']]['time'][0]['time_night']?> đêm
									</div>
									<div class="calendar">
										<i class="sprite sprite-ic-calendar-2"></i> Khởi hành: 
										<?=date('d/m/Y',$data[$value['id']]['item'][$value2['id']]['time'][0]['time_start'])?>
										<img src="images/gr-icon-2.png" alt="">
									</div>
									<div class="price-cmt">

										<?php if($data[$value['id']]['item'][$value2['id']]['time'][0]['type']==Combo_model::TYPE_1){?>
											<div class="price-product">
												<span>
													<?=number_format($data[$value['id']]['item'][$value2['id']]['time'][0]['price'])?>đ/khách</span>
													<!-- nếu là load -->
												<?=number_format($data[$value['id']]['item'][$value2['id']]['time'][0]['price_sale_1'])?>đ/khách
											</div>
										<?php }else{ ?>
											<div class="price-product">
												<?=number_format($data[$value['id']]['item'][$value2['id']]['time'][0]['price_sum'])?>đ/khách
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
					
				</div>
			</div>
		<?php } ?>
	<?php } ?>
</div>
<?php } ?>