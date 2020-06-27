<?php

use App\Http\Model\hotel\HotelAddress_model;
$address=HotelAddress_model::where(['hotel_id'=>$model->id])->get();
?>
<div class="content_id">
	<?php if($address){ ?>
		<?php foreach ($address as $key) {?>
			<div class="form-group">
				<div class="col-sm-3">
					<input type="text"  placeholder="Địa danh" class="form-control" name="name_address[]" value='<?=$key->name?>' />
				</div>
				<div class="col-sm-2">
					<input type="text"  placeholder="Địa chỉ từ" class="form-control from" name="from[]" value='<?=$key->address_from?>' />
				</div>
				<div class="col-sm-2">
					<input type="text"  placeholder="Địa chỉ tới" class="form-control to" name="to[]" value='<?=$key->address_to?>'/>
				</div>
				<div class="col-sm-2">
					<input type="text"  placeholder="Số km" class="form-control input" name="km[]" value='<?=$key->number_km?>' />
				</div>
				<div class="col-sm-1">
					<button class="btn btn-xs btn-success btn_search" >
						<i class="ace-icon fa fa-search bigger-120"></i>
					</button>
				</div>
				<div class="col-sm-1">
					<button class="btn btn-xs btn-danger btn_remove" id_remove='<?=$key->id?>'>
						<i class="ace-icon fa fa-trash-o bigger-120"></i>
					</button>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
</div>
<div class="form-group">
	<div class="col-sm-3" style="text-align: left;">
		<button class="btn btn-sm btn-warning" id="btn_click" count="">
			<span class="bigger-110 no-text-shadow" >Thêm danh sách</span>
		</button>
	</div>
</div>
<script>
	$(document).ready(function() {
		call();
		call_remove();
		function call(){
			$(".content_id .btn_search").each(function(){
				$(this).click(function(){
					var parent=$(this).closest(".form-group");
					var from=parent.find(".from").val();
					var to=parent.find(".to").val();
					getKm(from,to,parent);
					return false;
				});
			});
		}
		function call_remove(){
			$(".content_id .btn_remove").each(function(){
				$(this).click(function(){
					var parent=$(this).closest(".form-group");
					var id=$(this).attr("id_remove");
					removeKm(id,parent)
					return false;
				});
			});
		}
		
		$("#btn_click").click(function(){
			var html='<div class="form-group"><div class="col-sm-3"><input type="text"  placeholder="Địa danh" class="form-control" name="name_address[]" value="" /></div><div class="col-sm-2"><input type="text"  placeholder="Địa chỉ từ" class="form-control from" name="from[]" value="" ></div><div class="col-sm-2"><input type="text"  placeholder="Địa chỉ tới" class="form-control to" name="to[]" value=""></div><div class="col-sm-2"><input type="text"  placeholder="Số km" class="form-control input" name="km[]" value="" ></div ><div class="col-sm-1"><button class="btn btn-xs btn-success btn_search" ><i class="ace-icon fa fa-search bigger-120"></i></button></div><div class="col-sm-1"><button class="btn btn-xs btn-danger" ><i class="ace-icon fa fa-trash-o bigger-120"></i></button></div></div>';
			$(".content_id").append(html);
			call();
			return false;
		});

	});
	function removeKm(id,parent){
		$.ajax({
			data: {"_token": "{{ csrf_token() }}",'id':id},
			type:'GET',
			url:'<?= route('removeKm'); ?>',
			success:function(data) {
				if(data.code==200){
					parent.remove();
				}else{
					alert("Không thể xóa!")
				}
				
			}
		});   
	}
	function getKm(from,to,parent){
		$.ajax({
			data: {"_token": "{{ csrf_token() }}",'from':from,'to':to},
			type:'GET',
			url:'<?= route('getKm'); ?>',
			success:function(data) {
				if(data.code==200){
					parent.find(".input").val(data.messages);
				}else{
					alert("Không tìm thấy địa chỉ!")
				}
				
			}
		});   
	}
	
	
</script>