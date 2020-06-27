<?php 
use App\Http\Model\product\Manufacturer_model;
 ?>
<?php if(isset($category) && $category){?>
	<?php foreach($category as $cate){?>
		<div class="cate-product-index">
			<div class="container">
				<div class="title-cate-index">
					<h2>
						<img src="<?=url($cate->img_path.'/400x400/'.$cate->img_name)?>" alt="<?= $cate->name?>">
						<?= $cate->name?>
					</h2>
					<div class="view-more">
						<a href="<?= url($cate->link)?>">Xem tất cả >></a>
					</div>
					<?php 
						$ma=[];
						if($cate->product){
							foreach ($cate->product as $products) {
								$ma[$products->id_manufacturer]=$products->id_manufacturer;
							}
						}
						$ma=Manufacturer_model::whereIn('id',$ma)->get();
					?>
					<div class="list-sub-cate">
						<?php if($ma){
							foreach($ma as $m){ 
						?>
						<a href="{{url($m->link)}}">{{$m->name}}</a>
						<?php } } ?>
					</div>
				</div>
				<div class="box-product-incate">
					<?php foreach($cate->product as $products){?>
						<div class="item-hot-product">
							<div class="img">
								<?php if($products->price_market>$products->price){ ?>
									<div class="sale-bel">
										<?php $tem= ($products->price_market-$products->price)/$products->price;?>
										<span>GIẢM<?=$tem*100?>%</span>
									</div>
								<?php } ?>
								<a href="<?= url($products->link)?>" alt="<?= $products->name?>">
									<img src="<?=url($products->img_path.'/400x400/'.$products->img_name)?>" 
									alt="<?= $products->name?>" class="hover-img" >
								</a>

							</div>
							<div class="title">
								<h2>
									<a href="<?= url($products->link)?>"><?= $products->name?></a>
								</h2>
								<div class="price">
									<?php if($products->price){?>
										<p>
											<?=number_format($products->price ,0 ,'.' ,'.').' Đ'?>
										</p>
									<?php } ?>
									<?php if($products->price_market){?>
										<del><?=number_format($products->price_market ,0 ,'.' ,'.').' Đ'?></del>
									<?php } ?>
								</div>
						<div class="desc">
							<p>
								<?= $products->short_description?>
							</p>
						</div>
					</div>
				</div>
			<?php } ?>

		</div>
	</div>
</div>
<?php }?>
<?php }?>