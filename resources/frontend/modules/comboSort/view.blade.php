<?php use Illuminate\Support\Facades\Route; ?>
<div class="filter-search">
	<a class="<?=checkParam('sort','')?'active':''?>" href="<?=createParam('sort','')?>">Gotrip gợi ý</a>
	<a class="<?=checkParam('sort','price_desc')?'active':''?>" href="<?=createParam('sort','price_desc')?>" >Giá tăng dần</a>
	<a class="<?=checkParam('sort','price_asc')?'active':''?>" href="<?=createParam('sort','price_asc')?>">Giá giảm dần</a>
	<a class="<?=checkParam('sort','price_desc')?'active':''?>" href="<?=createParam('sort','price_desc')?>">Được đánh giá cao</a>
</div>