<?php if(isset($data) && $data){?>
<div class="break-br"></div>
<div class="hot-trip">
	<div class="container">
		<div class="title-standard">
			<h2>
				<?=$category['name']?>
			</h2>
			<p>
				<?=$category['short_description']?>
			</p>
		</div>
		<div class="row multi-columns-row">
			<div class="col-lg-7 col-md-6 col-sm-6 col-xs-12 big-item-hot">
				<?php foreach ($data as $m) {?>
					<div class="item-hot-trip">
						<a href="<?= $m['link']?>">
							<div class="img">
								<img src="<?= url($m->img_root)?>" alt="{{$m->name}}">
							</div>
							<div class="title">
								<h3>
									<?=$m['name']?>
									
								</h3>
								<p>
									<?=$m['short_description']?>
								</p>
							</div>
						</a>
					</div>
				<?php break;} ?>
			</div>
			<div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 small-item-hot">
				<?php $i=0;foreach ($data as $m) {$i++;if($i==1)continue;?>
					<div class="item-hot-trip">
						<a href="<?= $m['link']?>">
							<div class="img">
								<img src="<?= url($m->img_root)?>" alt="{{$m->name}}">
							</div>
							<div class="title">
								<h3>
									<?=$m['name']?>
									<span>
										<?=$m['short_description']?>
									</span>
								</h3>
							</div>
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php } ?>