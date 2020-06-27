

<div class="form-group required">
	<div class="col-sm-2 control-label">
		<label>Bảng</label>
	</div>
	<div class="col-sm-10">
		<select class="form-control table_change" name='table'>
			@foreach($table_list as $key=>$val)
			<option value='{{$key}}'>{{$val}}</option>
			@endforeach
		</select>
	</div>
</div>

<div class="form-group select_a">
	<div class="col-sm-2 control-label">
		<label>Thời gian</label>
	</div>
	<div class="col-sm-10">
		<select class="form-control time_change" name='date'>
			<option value=''>Lựa chọn ngày</option>
		</select>
	</div>
</div>
<div class="form-group select_a">
	<div class="col-sm-2 control-label">
		<label>Loại</label>
	</div>
	<div class="col-sm-10">
		<select class="form-control" name='type'>
			<option value='1'>Khôi phục</option>
			<option value='2'>Xóa vĩnh viễn</option>
		</select>
	</div>
</div>


<script type="text/javascript">
	function getMessage(urls,table) {
		$.ajax({
			data: {"_token": "{{ csrf_token() }}",'table':table},
			type:'POST',
			url:urls,
			success:function(data) {
				if(data.code==200){
					html='';
					$.each(data.messages,function(index, value){
						html+="<option value='"+index+"'>"+index+'</option>';
						
					});
					$(".time_change").html(html);
				}
			}
		});
	}

	$(document).ready(function(){
		$(".table_change").change(function(){
			var val=$(this).find("option:selected").val();
			if(val){
				getMessage("<?= route('getDate')?>",val);
			}
		});
	});
</script>