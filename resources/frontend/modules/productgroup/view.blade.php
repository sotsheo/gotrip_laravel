


	
			<div class="group_product wow fadeInUp" data-wow-delay=".5s" >
				<div class="title_product_g">

					<h2><a href="<?= $group->link?>"><?= $group->name?></a></h2>
				</div>
				<div class="content_product ">
					<div class="slider_product ">
						<?php foreach($data as $products){?>
							<div class="item_product">
								<div class="img img_zoom">
									<a href="<?= $products->link?>">
										<img src="<?=url($products->img_path.'/400x400/'.$products->img_name)?>" 
										alt="<?= $products->name?>">
									</a>
									<span class="price_sale">Giảm 30%</span>
								</div>
								<div class="text">
									<a href="<?= $products->link?>"><h3><?= $products->name?> </h3></a>
									<?php if($products->price){?>
										<p class="price"> <?=number_format($products->price ,0 ,'.' ,'.').' Đ'?> </p>
									<?php } ?>
								<!-- <p>Tặng sạc không dây và giảm ngay 30% </p>
								<p>
									<i class="fa fa-star start" aria-hidden="true"></i>
									<i class="fa fa-star start" aria-hidden="true"></i>
									<i class="fa fa-star start" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<span>007 đánh giá</span>
								</p> -->
							</div>
						</div>
					<?php }?>
				</div>
			</div>
		</div>

