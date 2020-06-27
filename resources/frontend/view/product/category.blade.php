
@extends('view.main')
@section('title',$category->name)
@section("content")

<!-- banner in  -->
<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view_in',13);?>
<div class="product-page">
	<div class="shadow-open-filter"></div>
	<div class="container">
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 awe-check hide-mobile-check pad-0">
			<div class="filter-box-left">
				<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view',14);?>

				<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view',17);?>

				<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view',16);?>
				
				
			</div>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pad-0">
			<div class="border-left-product">
				<div class="filter-review-detail">
					<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view',15);?>
				</div>
				<div class="list-product-categories">
					<div class="row multi-columns-row">
						<?php foreach($products as $product){?>
							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 item-col-5">
								<div class="item-hot-product">
									<div class="img">
										<?php if($product->price_market>$product->price){ ?>
											<div class="sale-bel">
												<?php $tem= ($product->price_market-$product->price)/$product->price;?>
												<span>GIẢM<?=$tem*100?>%</span>
											</div>
										<?php } ?>
										<a href="<?=url($product->link)?>">
											<img src="<?=url($product->img_path.'/400x400/'.$product->img_name)?>" 
											alt="<?= $product->name?>">
										</a>
									</div>
									<div class="title">
										<h2>
											<a href="<?=url($product->link)?>"><?=$product->name?></a>
										</h2>
										<div class="price">
											<?php if($product->price){?>
												<p>
													<?=number_format($product->price ,0 ,'.' ,'.').' Đ'?>
												</p>
											<?php } ?>
											<?php if($product->price_market){?>
												<del><?=number_format($product->price_market ,0 ,'.' ,'.').' Đ'?></del>
											<?php } ?>
										</div>
										<div class="desc">
											<p>
												<?= $product->short_description?>
											</p>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			@include('modules.paginate.view',['paginator'=>$products])
		</div>
	</div>
</div>
@endsection