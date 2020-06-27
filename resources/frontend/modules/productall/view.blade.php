<?php  if(isset($products) && $products){ ?>
<div class="content-product-tab content-read content-read-all">
	<div class="row multi-columns-row">
		<?php foreach($products as $product){?>
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
				<div class="item-product">
					<div class="img">
						<a href="<?= $product->link?>">
							<img src="<?=url($product->img_path.'/400x400/'.$product->img_name)?>" 
							alt="<?= $product->name?>">
						</a>
					</div>
					<div class="title">
						<h3>
							<a href="<?= $product->link?>"><?= $product->name?></a>
						</h3>
						<?php if($product->price){?>
							<p class="price"> <?=number_format($product->price ,0 ,'.' ,'.').' Đ'?> </p>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
<?php } ?>