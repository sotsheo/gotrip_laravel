<?php if(isset($banner) && $banner){?>
<div class="camket">
	<div class="title-box">
		<h2>
			<?=$category['name']?>
		</h2>
	</div>
	<div class="container">
		<div class="row">
			<?php foreach ($banner as $b) { ?>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<div class="item-camket">
						<img src="<?= url($b->img_root)?>" alt="{{$b->name}}">
						<h3>{{$b->name}}</h3>
						<p>
							{{$b->short_description}}
						</p>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php } ?>