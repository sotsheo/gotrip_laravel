<?php $check=isset($_GET['sort'])?$_GET['sort']:'';?>

<div class="filter-review filter-list-product">
	<div class="btn-show-filter">
		<img src="{{ asset('resources/assets/images/ic-filter-hv.png')}" alt=""> Bộ lọc sản phẩm
	</div>
	<div class="option-sub-filter">
		<div class="top-sub-filter">
			<h2>
				Ưu tiên xem
			</h2>
			<ul>
				
				<li>
					<a href="<?= $sort;?>" class="<?=(!$check)?'active':''?>">HÀNG MỚI</a>
				</li>
				
				<li>
					<a href="<?= ($check=='price')?$sort:$sort.'&sort=price'?>" class="<?=($check=='price')?'active':''?>">Giá tăng dần</a>
				</li>
				<li><a href="<?= ($check=='price')?$sort:$sort.'&sort=price_desc'?>" class="<?=($check=='price_desc')?$check:''?>">Giá giảm dần</a></li>
			</ul>
			<div class="search-in-product">
				<form action="">
					<input type="text" placeholder="Tìm sản phẩm" name="name">
					<input type="submit" class="search-icon">
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#sort").change(function(){
			window.location.href=$(this).children("option:selected").attr('hrefs');
		});
	});
</script>