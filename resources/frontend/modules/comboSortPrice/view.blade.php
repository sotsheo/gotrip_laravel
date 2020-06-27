<?php if($data){ ?>
<div class="categories-menu">
	<h2>
		Ngân sách của bạn?
	</h2>
	<div class="group-check-box">
		<?php foreach ($data as $key => $value) { ?>
			<div class="checkbox">
				
					<input type="checkbox" class="ais-checkbox" {{($value['checked'])?'checked':''}} style="z-index: 1">
					<label><span class="text-clip" title="radio">{{$value['name']}}</span></label>
				<a href="{{$value['link']}}" style="    display: block;width: 100%;position: absolute;z-index: 99;left: 0;top: 0;height: 100%;"></a>
			</div>
		<?php } ?>
	</div>
</div>
<script type="text/javascript">
	$(".group-check-box a").each(function(){
		$(this).click(function(){
			console.log(1);
		});
	});
</script>
<?php } ?>