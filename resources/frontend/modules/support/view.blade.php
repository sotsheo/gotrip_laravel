

<div class="left_info">
	<ul>
		<?php foreach ($support as $sp) { ?>
			<?php if($sp->name_type=='fb'){?>
			<li><a href=""><i class="fa fa-facebook-square" aria-hidden="true"></i><span>Facebook</span></a></li>
			<?php }?>
			<?php if($sp->name_type=='youtube'){?>
			<li><a href=""><i class="fa fa-youtube-play" aria-hidden="true"></i><span>Youtube</span></a></li>
			<?php }?>
		<?php }?>
	</ul>
</div>