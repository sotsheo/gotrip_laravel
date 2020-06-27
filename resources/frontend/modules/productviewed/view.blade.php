
<?php if(isset($products) && $products){ ?>
	<div class="group-footer-index">
		<div class="container">
			<div class="row multi-columns-row">	
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="product-you-seen">
						<div class="title-box">
							<h2>
								<?=$widget->name?>
							</h2>
							<a href="">xem tất cả >></a>
						</div>
						<div class="slide-product-seen">
							<?php foreach ($products as $product) {?>
								<div class="item-hot-product">
									<div class="img">
										<a href="<?=  url($product->link)?>" alt="<?= $product->name?>">
											<img src="<?=url($product->img_path.'/400x400/'.$product->img_name)?>" 
											alt="<?= $product->name?>" class="hover-img" >
										</a>
									</div>
									<div class="title">
										<h2>
											<a href="<?=  url($product->link)?>"><?= $product->name?></a>
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
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="tag-search-index">
						<div class="title-box">
							<h2>
								Xu hướng tìm kiếm
							</h2>
						</div>
						<div class="list-tag">
							<a href="">Sale</a>
							<a href="">New</a>
							<a href="">Rau sạch</a>
							<a href="">Thực phẩm sạch</a>
							<a href="">Quả</a>
							<a href="">Kem</a>
							<a href="">Sữa</a>
							<a href="">Chế biến sẵn</a>
							<a href="">Cây cảnh</a>
							<a href="">Gỗ</a>
							<a href="">Thực phẩm sạch</a>
							<a href="">Quả</a>
							<a href="">Kem</a>
							<a href="">Sữa</a>
							<a href="">Chế biến sẵn</a>
							<a href="">Cây cảnh</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>