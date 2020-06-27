<?php 
use App\Http\Model\history\History_model;
use App\User;
?>
<form>
	<?php if($data){ 
		foreach($data as $d){
			?>
			<div class="form-group required">
				<div class="col-sm-2 control-label">
					<label><?=History_model::getColumName($d->name)?></label>
				</div>
				<div class="col-sm-8">
					<?=History_model::getValue($model->name_table,$d) ?>
				</div>
				<div class="col-sm-2">
					<a class="btn btn-s-md btn-primary show_popup" 
					data_old='<?=$d->value_old?>'
					data_new='<?=$d->value_new?>'
					id="<?=$d->id?>"
					>Khôi phục</a>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
	<div class="popup">
		<div class="content">
			<button type="button" class="close_popup" data-dismiss="modal">×</button>
			<h3>Thông tin</h3>
			<div class="table_input">
				<h4>Dữ liệu cũ</h4>
				<div class="content_text content_old">
					ádafadasdasd
				</div>
			</div>
			<div class="table_input">
				<h4>Dữ liệu mới</h4>
				<div class="content_text content_new">
					ádafadasdasd
				</div>
			</div>
			<div class="button">
				<a class="btn btn-s-md btn-primary click_send" >Xác nhận</a>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){

			$(".show_popup").click(function(){
				data_old=$(this).attr("data_old");
				data_new=$(this).attr("data_new");
				id=$(this).attr("id");
				$(".content_old").html(data_old);
				$(".content_new").html(data_new);
				$(".click_send").attr('target_id',id);
				$(".popup").addClass("active");
				
			});
			$(".click_send").click(function(){
				id=$(this).attr("target_id");
				getMessage(id);
			});
			$(".close_popup").click(function(){

				$(".popup").removeClass("active");
			});
		});
		function getMessage(id) {
			  var urls='<?= route('retore')?>';
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {"_token": "{{ csrf_token() }}",'id':id},
				type:'POST',
				url:urls,
				success:function(data) {
					alert(data.messages);
					$(".popup").removeClass("active");               
					
				}
			});
		}
	</script>
	<style type="text/css">
		.popup{
			width: 100%;

			align-items: center;
			left: 0;
			top: 0;
			height: 100%;
			position: fixed;
			background: rgba(0,0,0,.5);
			overflow: hidden;
			opacity: 0;
			z-index: -1;
		}
		.popup.active{
			overflow: visible;
			opacity: 1;
			z-index: 999;
			display: flex;

		}
		.popup .content{
			width: 450px;
			max-width: 90%;
			margin: 0 auto;
			margin-top: -100%;
			background: #fff;
			border-radius: 5px;
			position: relative;
			transition: all .5s;
		}
		.popup.active .content{
			margin: 0 auto;
		}
		.popup .content h3{
			padding: 10px;
			margin: 0px;
			font-size: 30px;
			border-bottom: 1px solid #b7adad;
			background: #085f92;
			color: #fff;
			border-radius: 5px 5px 0px 0px;
		}
		.popup .content .table_input{
			padding: 0px;
			border: 1px solid #d6cece;
			border-top: 0px;
		}
		.popup .content h4{
			margin: 0px;
			padding: 10px;
			border-bottom: 1px solid #decece;
		}
		.popup .content .content_text{
			margin: 0px;
			padding: 10px;
		}
		.popup .content .button{
			text-align: right;
			padding: 10px;
		}
		.close_popup{
			position: absolute;
			right: 0;
			top: 0;
			padding: 10px;
			color: #000;
			background: transparent;
			border: 0px;
			font-size: 22px;
		}
	</style>
</form>