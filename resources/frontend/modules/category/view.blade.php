@if(count($category)>0)
<div class="filter-box-left" style="margin-bottom: 0">
		<div class="cate-box">
			<h2>
				Tin tức chung
			</h2>
			<div class="list-cate-box">
				<?php
					foreach ($category as $cate) {
				?>
					<div class="menu-bar-lv-1">
						<a class="a-lv-1" href="<?= url($cate->link).$cate->id?>">{{ $cate->name }}</a>
					</div>
				<?php }?>
			</div>
		</div>
	</div>
@endif