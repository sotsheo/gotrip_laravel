<?php if(isset($category) && $category){?>
<div class="cate-box">
	<h2>
		<?= $widget->name?>
	</h2>
	<div class="list-cate-box">
		<?php foreach($category as $cate){?>
			<div class="menu-bar-lv-1">
				<a class="a-lv-1" href="<?= url($cate->link) ?>"><em>•</em> <?= $cate->name ?></a>
				<?php if($cate['item']){ ?>
					<?php foreach($cate['item'] as $key=>$cate_v2){?>
						<div class="menu-bar-lv-2">
							<a class="a-lv-2" href="<?= url($cate_v2->link) ?>"><i class="fa fa-angle-right"></i><?= $cate_v2->name ?></a>
						</div>
					<?php } ?>
					<span class="span-lv-1 fa fa-angle-right"></span>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>
<?php } ?>