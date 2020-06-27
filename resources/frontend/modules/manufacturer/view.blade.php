<div class="list-thuonghien-index">
<ul class="slide-thuonghieu-mobile">

	<?php
		foreach($manufacturer as $m){
	?>
		<li>
			<div class="vertical">
				<div class="middle">
					<a href="">
						<img class="hover-img" src="<?= url($m->img)?>" alt="">
					</a>
				</div>
			</div>
		</li>
	<?php }?>
</ul>
</div>