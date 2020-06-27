<div class="col-lg-6 colmd-6 col-sm-6 col-xs-12">
	<?php
		foreach($news as $n){
	?>
		<div class="item-news">
			<div class="img">
				<a href=""><img class="hover-img" src="<?= url($n->img)?>" alt=""></a>
				<span>{{ date('d/m/Y',$n->date_public) }}</span>
			</div>
			<div class="title">
				<h3>
					<a href="<?= url($n->link)?>">
						{{$n->name}}
					</a>
				</h3>
				<div class="time">
					<span><i class="fa fa-clock-o"></i>{{ date('d/m/Y',$n->date_public) }}</span>
					<span>|</span>
					<span><i class="fa fa-user-circle"></i>{{ ($n->user==1)?'admin':$n->user }}</span>
				</div>
				<p>
					{{$n->short_description}}
				</p>
				<div class="button-style hascolor">
					<a href="<?= url($n->link)?>">Xem chi tiết</a>
				</div>
			</div>
		</div>
	<?php }?>
</div>