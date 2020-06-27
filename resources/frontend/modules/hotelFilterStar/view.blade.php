<?php if($data){ ?>
<div class="categories-menu">
	<h2>
		Hạng sao khách sạn
	</h2>
	<div class="group-check-box">
		<?php foreach ($data as $key => $value) { ?>
			<div class="checkbox">
				<input type="checkbox" class="ais-checkbox"  {{($value['checked'])?'checked':''}}>
				<label>
					<span class="text-clip" title="radio">
						<?php for($i=0;$i<$value['name'];$i++){ ?>
							<img src="{{ asset('resources/assets/images/star.png')}}" alt="">
						<?php } ?>
					</span>
				</label>
				<a href="{{$value['link']}}" style="    display: block;width: 100%;position: absolute;z-index: 99;left: 0;top: 0;height: 100%;"></a>
			</div>
		<?php } ?>
	</div>
</div>
<?php } ?>