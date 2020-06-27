
<?php if(isset($album) && $album){?>
<div class="gallery-index">
	<div class="title-standard center wow fadeInUp">
		<h2>Khách hàng của chúng tôi</h2>
	</div>
	<div class="list-gallery">
		<?php foreach($album as $ab){?>
			<?php foreach($ab->img as $img){?>
				<div class="item-gallery wow fadeIn">
					<div class="img">
						<img src="<?=url($img->img_path.'/400x400/'.$img->img_name)?>" 
							alt="<?= $ab['name']?>">
					</div>
					<a class="title" href="">
						<h3>
							<?= $ab['name']?>
						</h3>
					</a>
				</div>
			<?php }?>
		<?php }?>
	</div>
</div>
<?php }?>