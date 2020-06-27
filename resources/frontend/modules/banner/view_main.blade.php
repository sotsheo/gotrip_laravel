<?php if(isset($banner) && $banner){?>
	<div class="banner-main">
		<?php foreach ($banner as $b) { ?>
		<div class="item-banner">
			<div class="img">
				<a href="{{$b->link}}">
					<img src="<?= url($b->img_root)?>" alt="{{$b->name}}">
				</a>
			</div>
		</div>
		<?php } ?>
	</div>
<?php } ?>