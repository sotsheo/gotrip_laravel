@extends('view.main_in')
@section('title',$title)
@section("content")
<?php 
use  App\Http\Model\province\Province_model;
use  App\Http\Model\combo\Combo_model;
use  App\Http\Model\flight\Airline_model;
use  App\Http\Model\flight\Flight_model;
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
<div class="page-list-product">
	<div class="shadow-open-filter"></div>
	<div class="container">
		<div class="row mar-10">
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 pad-10 awe-check hide-mobile-check">
				<div class="filter-box-left">
					
					<!-- lọc giá  -->
					<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view',14);?>
					
					<!-- lọc hang sao -->
					<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view',15);?>

				</div>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pad-10">

				
				@include('modules/breadcrumbs/view')
				<div class="title-cate">
					
					<div class="btn-show-filter">
						Bộ lọc sản phẩm
					</div>
				</div>
				<!-- cắm sort -->
				<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view',13);?>
				<div class="list-combo-gotrip">
					<?php if($combo){ ?>
						<?php foreach ($combo as $key => $cb) { if(!count($cb['time']))continue;?>
							<div class="item-combo-gotrip">
								<div class="img">
									<a href="{{url($cb->link)}}?time=<?=$cb['time'][0]['id']?>">
										<img src="{{url($cb->img_path.'/400x400/'.$cb->img_name)}}" 
										alt="{{$cb->name}}">
									</a>
								</div>
								<div class="title">
									<h3>
										<a href="{{url($cb->link)}}?time=<?=$cb['time'][0]['id']?>">{{$cb->name}}</a>
									</h3>
									<div class="location">
										<i class="sprite sprite-ic-place"></i> <?=$cb['time'][0]['address_text_to']?>
									</div>
									<div class="bed">
										<i class="sprite sprite-ic-bed-3"></i> Phòng tiêu chuẩn giường đôi
									</div>
									<div class="airline-option">
										<?php if($cb['time'][0]['planes_from_id']){
											$plances=Flight_model::find($cb['time'][0]['planes_from_id']); ?>
											<?php if($plances){?>
											<?php
											$from=Province_model::getName($plances->province_id_from);
											$to=Province_model::getName($plances->province_id_to);
											?>
											
												<div class="go">
													<p>
														<i class="sprite sprite-ic-plane"></i> Chiều đi: <?=$from?> > <?=$to?> (<?= date('d/m/Y',$plances['time_from'])?>)
													</p>
													<div class="time-in">
														<img src="images/vj-air.png" alt=""> <?= date('H:s',$plances['time_from'])?> | <?=$from?>
													</div>
													<div class="time-out">
														<?= date('H:s',$plances['time_to'])?> | <?=$to?>
													</div>
												</div>
											<?php } ?>
										<?php } ?>

										<?php if($cb['time'][0]['planes_to_id']){ ?>
											<?php $plances=Flight_model::find($cb['time'][0]['planes_to_id']); ?>
											<?php if($plances){?>
												<?php
												$from=Province_model::getName($plances->province_id_from);
												$to=Province_model::getName($plances->province_id_to);?>
											<div class="go">
												<p>
													<i class="sprite sprite-ic-plane"></i> Chiều về: <?=$from?> > <?=$to?> 
													(<?= date('d/m/Y',$plances['time_from'])?>)
												</p>
												<div class="time-in">
													<img src="images/vj-air.png" alt=""> <?= date('H:s',$plances['time_from'])?> | <?=$from?>
												</div>
												<div class="time-out">
													<?= date('H:s',$plances['time_to'])?> | <?=$to?>
												</div>
											</div>
											<?php } ?>
										<?php } ?>
									</div>
								</div>
								<div class="point-review" <?=$cb['time'][0]['id']?>  <?=$cb['id']?>>
									<?php if($cb['time'][0]['price_type']==Combo_model::TYPE_1) {?>
										<span><?=number_format($cb['time'][0]['price_sale_1'])?></span>
									<?php }else{ ?>
										<span><?=number_format($cb['time'][0]['price_sale_1'])?></span>
									<?php } ?>
									<b><?=number_format($cb['time'][0]['price_sum'])?></b>
									<spam>đ/khách</spam>
									<?php if($cb['time'][0]['price_sale']!=0){ ?>
										<button>

											Tổng tiết kiệm
											<b><?=number_format($cb['time'][0]['price_sale'])?></b>
										</button>
									<?php } ?>
									<div class="note">
										Hiện có <?=$cb['time'][0]['number_order']?> du khách đang xem chỗ này 
									</div>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
					 {!! $combo_page->links() !!}
					
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection