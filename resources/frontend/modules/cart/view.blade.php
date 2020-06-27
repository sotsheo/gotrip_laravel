
<div class="shoping-cart-index">
	<div class="img">
		<a href="cart.html">
			<img src="{{ asset('resources/assets/images/ic-cart.png')}}" alt="">
		</a>
		<?php if(count($data)){ ?>
			<span><?=count($data);?></span>
		<?php } ?>
	</div>
</div>