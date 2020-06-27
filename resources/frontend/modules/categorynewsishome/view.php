
<?php if(isset($category) && $category){?>
<div class="list_item_main ">
	<div class="row">
		<?php foreach($category as $cate){?>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="item wow fadeInUp" style="animation-delay: 0.5s; visibility: visible; animation-name: fadeInUp;">
					<h3><?= $cate->name ?></h3>
					<div class="content">
						<div class="img">
							<a href="<?= url($cate->link);?>"> <img alt="<?=$cate->name ?>" src="<?= $cate->img ?>">
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php }?>
	</div>
</div>
<?php }?>