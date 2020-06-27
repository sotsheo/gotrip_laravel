<?php $check=isset($_GET['star'])?$_GET['star']:-1;?>
<div class="group-filter">
	<h2>
		ĐÁNH GIÁ
	</h2>
	<div class="box-filter-star">
		<div class="item-filter-star">
			<a href="<?=$star.'&star=4'?>">
				<img src="{{ asset('resources/assets/images/star.png')}}" alt="">
				<img src="{{ asset('resources/assets/images/star.png')}}" alt="">
				<img src="{{ asset('resources/assets/images/star.png')}}" alt="">
				<img src="{{ asset('resources/assets/images/star.png')}}" alt="">
				<img src="{{ asset('resources/assets/images/star-o.png')}}" alt="">
				<span>(ít nhất 4 sao)</span>
			</a>
		</div>
		<div class="item-filter-star">
			<a href="<?=$star.'&star=3'?>">
				<img src="{{ asset('resources/assets/images/star.png')}}" alt="">
				<img src="{{ asset('resources/assets/images/star.png')}}" alt="">
				<img src="{{ asset('resources/assets/images/star.png')}}" alt="">
				<img src="{{ asset('resources/assets/images/star-o.png')}}" alt="">
				<img src="{{ asset('resources/assets/images/star-o.png')}}" alt="">
				<span>(ít nhất 3 sao)</span>
			</a>
		</div>
		<div class="item-filter-star">
			<a href="<?=$star.'&star=2'?>">
				<img src="{{ asset('resources/assets/images/star.png')}}" alt="">
				<img src="{{ asset('resources/assets/images/star.png')}}" alt="">
				<img src="{{ asset('resources/assets/images/star-o.png')}}" alt="">
				<img src="{{ asset('resources/assets/images/star-o.png')}}" alt="">
				<img src="{{ asset('resources/assets/images/star-o.png')}}" alt="">
				<span>(ít nhất 2 sao)</span>
			</a>
		</div>
		<div class="item-filter-star">
			<a href="<?=$star.'&star=1'?>">
				<img src="{{ asset('resources/assets/images/star.png')}}" alt="">
				<img src="{{ asset('resources/assets/images/star-o.png')}}" alt="">
				<img src="{{ asset('resources/assets/images/star-o.png')}}" alt="">
				<img src="{{ asset('resources/assets/images/star-o.png')}}" alt="">
				<img src="{{ asset('resources/assets/images/star-o.png')}}" alt="">
				<span>(ít nhất 1 sao)</span>
			</a>
		</div>
	</div>
</div>