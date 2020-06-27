<?php

    if(Session::has('success')){
?>
	<div class="pp_t">
		<div class="success_pp">
			<div class="title">
				<h4>Thông báo</h4>
			</div>
			<div class="content">
				<p>{{Session::get('success')}}</p>
			</div>
		</div>
	</div>
	<style type="text/css">
		.pp_t{
			position: fixed;
			z-index: 99;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			background: rgba(206, 198, 198, 0.5);
		}
		.pp_t .success_pp{
			width: 320px;
			margin: 10% auto;
			background: #fff;	
		}
		.pp_t .success_pp .title h4{
			border-top: 4px solid red;
			padding: 10px;
			margin: 0px;
			background: #32a517;
			color: #fff;
		}
		.pp_t .success_pp .content p{
			padding: 15px;
			font-size: 14px;
			color: #333;
			margin-top: 0px;
		}
	</style>
	<script type="text/javascript">
		$(".pp_t").click(function(){
			$(this).css("display",'none');
		});
	</script>
<?php }?>
