
@extends('view.view.main')
@section('title','Sản phẩm')
@section("content")

<div class="wapper hidden-main" id="main">
	<?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view_in',22);?>
	<div class="product-page">
		<div class="container">
			<div class="row mar-10">
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 pad-10 awe-check">
					<div class="filter-box-left">
						
						<?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view_category',23);?>

						<!-- Lọc giá -->
						<?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view',21);?>
						
					</div>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pad-10">
					<div class="filter-review-detail">
						<div class="title-categories-page">
							<h3>
								Tất cả sản phẩm
							</h3>
						</div>
						<div class="filter-review filter-list-product">
							<!-- pagesize -->
							<?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view',19);?>
							<?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view',20);?>
							
						</div>
					</div>
					<div class="list-product-categories">
						<div class="row multi-columns-row">
							<?php foreach($products as $product){?>
								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
									<div class="item-product">
										<div class="img">
											<a href="<?=url($product->link)?>">
												<img src="<?=url($product->img_path.'/400x400/'.$product->img_name)?>" 
												alt="<?= $product->name?>">
											</a>
										</div>
										<div class="title">
											<h3>
												<a href="<?=url($product->link)?>"><?=$product->name?></a>
											</h3>
											<div class="star">
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
											</div>
											<?php if($product->price){?>
												<p class="price"><?=number_format($product->price ,0 ,'.' ,'.').' Đ'?> </p>
											<?php }?>
										</div>
									</div>
								</div>
							<?php }?>
						</div>
						
						@include('view.modules.paginate.view',['paginator'=>$products])
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- banner support -->
	<?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view_support',13);?>


	<!-- banner đối tác -->
	<?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view_patter',14);?>
</div>
@endsection