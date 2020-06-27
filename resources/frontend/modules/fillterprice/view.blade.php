<?php $check=isset($_GET['price_min'])?$_GET['price_min']:-1;?>

<div class="group-filter">
	<h2>
		<?= $widget->name?>
	</h2>
	<div class="group-check-box">
		<div class="radio">
			<input class='fillterprice' type="radio" name="radiobox" <?=($check==0)?'checked':''?> 
			hrefs="<?= ($check==0)?$sortprice:$sortprice.'&price_min=0&price_max=50000';?>">
			<label><span class="text-clip" title="500.000">Dưới 500.000 vnđ</span></label>
		</div>
		<div class="radio">
			<input  class='fillterprice' type="radio" name="radiobox" <?=($check==50000)?'checked':''?>  
			hrefs="<?= ($check==50000)?$sortprice:$sortprice.'&price_min=50000&price_max=200000';?>">
			<label><span class="text-clip" title="500.000">500.000 - 2.000.000 vnđ</span></label>
		</div>
		<div class="radio">
			<input  class='fillterprice' type="radio" name="radiobox" <?=($check==200000)?'checked':''?>  
			hrefs="<?= ($check==200000)?$sortprice:$sortprice.'&price_min=200000&price_max=500000';?>">
			<label><span class="text-clip" title="500.000">2.000.000 - 5.000.000 vnđ</span></label>
		</div>
		<div class="radio">
			<input  class='fillterprice' type="radio" name="radiobox" <?=($check==500000)?'checked':''?> 
			hrefs="<?= ($check==500000)?$sortprice:$sortprice.'&price_min=500000&price_max=1000000';?>">
			<label><span class="text-clip" title="500.000">5.000.000 - 10.000.000 vnđ</span></label>
		</div>
	</div>

</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(".fillterprice").click(function(){
			window.location.href=$(this).attr('hrefs');

		});
	});
</script>