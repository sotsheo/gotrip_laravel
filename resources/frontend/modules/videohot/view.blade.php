<?php if(isset($data) && $data){?>
<div class="right-intro">
	<div class="video-intro">
		<?php foreach($data as $video){?>
			<div class="img">
				<img src="<?= $video->img_path.'/400x400/'.$video->img_name;?>" alt="">
			</div>
		<?php }?>
		<div class="btn-play">
			<img src="{{ asset('resources/assets/images/arrow.png')}}" alt="">
		</div>
	</div>
</div>
<?php }?>