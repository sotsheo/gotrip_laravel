
@if(count($news)>0)
<div class="news-related">
	<div class="title-box">
		<h2>
			Tin tức liên quan
		</h2>
	</div>
	<div class="row">
		<div class="slide-news-related">
			<?php
			foreach($news as $n){
				?>
				<div class="item-news">
					<div class="img">
						<a href=""><img  class="hover-img" src="<?= url($n->img)?>" alt=""></a>
					</div>
					<div class="title">
						<h3>
							<a href="{{ url($n->link) }}<?php echo($n->id); ?>">
								<?=$n->description?>
							</a>
						</h3>
						<div class="time">
							<span><i class="fa fa-clock-o"></i>{{ date('d/m/Y', $n->date_public) }}</span>
							<span>|</span>
							<span><i class="fa fa-user-circle"></i> Nguyen huy</span>
						</div>
						<?=$n->short_description?>
						<div class="button-style hascolor">
							<a href="{{ url($n->link) }}<?php echo($n->id); ?>">Xem chi tiết</a>
						</div>
					</div>
				</div>
				<?php }?>
			</div>
		</div>
	</div>
	@endif