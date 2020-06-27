
<?php if($data){ ?>
	<div class="hot-new-index">
		<div class="title-hotnew">
			<h2>
				<img src="images/ic-volume.png" alt="">
				<?= $widget->name;?>
			</h2>
		</div>
		<div class="slider-hotnew-index">
			<?php foreach($data as $news){?>
				<div class="item-hotnew">
					<div class="img">
						<a href="<?= $news->link?>" alt="<?= $news->name?>">
							<img src="<?= $news->img_path.'/200x200/'.$news->img_name?>" alt="<?= $news->name?>">
						</a>
					</div>
					<div class="title">
						<h3>
							<a href="<?= $news->link?>" alt="<?= $news->name?>"><?= $news->name?></a>
						</h3>
						<span>1 giờ trước</span>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
	<?php } ?>