

<div class="table_news  wow fadeInRight" style="animation-delay: .5s;">
	<h3 class="title_table"><?= $category->name?></h3>
	<div class="content">
		<ul>
			<?php foreach ($news as $n) {?>
				<li><a href="<?= url($n->link)?>">{{$n->name}}</a></li>
			<?php }?>
		</ul>
	</div>
</div>