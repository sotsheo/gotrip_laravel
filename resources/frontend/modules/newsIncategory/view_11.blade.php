@if(isset($news)&& $news)
<div class="list-event-index">
	<div class="col-lg-3 colmd-3 col-sm-3 col-xs-12">
		
		<?php
		$i=0;
			foreach($news as $n){
			$i++;
			if($i<=2){
		?>
		
			<div class="item-news">
				<div class="img">
					<a href="<?= url($n->link)?>"><img class="hover-img" src="<?= url($n->img)?>" alt=""></a>
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
						<span><i class="fa fa-user-circle"></i> {{ ($n->user==1)?'admin':$n->user }}</span>
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
		<?php }?>
	</div>
	@include('view/modules/newsIncategoryhot/view')
	<div class="col-lg-3 colmd-3 col-sm-3 col-xs-12">
		<?php
		$i=0;
			foreach($news as $n){
			$i++;
			if($i>=3){
		?>
		
			<div class="item-news">
				<div class="img">
					<a href="<?= url($n->link).$n->id?>"><img class="hover-img" src="<?= url($n->img)?>" alt=""></a>
					<span>{{ date('d/m/Y',$n->date_public) }}</span>
				</div>
				<div class="title">
					<h3>
						<a href="<?= url($n->link).$n->id?>">
							{{$n->name}}
						</a>
					</h3>
					<div class="time">
						<span><i class="fa fa-clock-o"></i>{{ date('d/m/Y',$n->date_public) }}</span>
						<span>|</span>
						<span><i class="fa fa-user-circle"></i> {{ ($n->user==1)?'admin':$n->user }}</span>
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
		<?php }?>
	</div>
</div>
@endif