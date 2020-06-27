<div class="content_id_<?=$i?>">
	<?php if($time){ ?>
		<?php foreach($time as $t){ ?>
			<div class="form-group">
				<div class="col-sm-2">
					<input type="hidden"   class="form-control " name="time_<?=$i?>[]" value='<?=$t->id?>'>
					<input type="text"  placeholder="Thời gian" class="form-control time_item_<?=$i?>" name="day_<?=$i?>[]"  value='<?=$t->time?>'>
				</div>
				<div class="col-sm-3">
					<input type="text" id="form-field-1" placeholder="Nội dung" class="form-control" name="day_conten_<?=$i?>[]" value='<?=$t->content?>'>
				</div>
				<div class="col-sm-3">
					<input type="text" id="form-field-1" placeholder="Địa chỉ" class="form-control" name="day_address_<?=$i?>[]" value='<?=$t->address?>'>
				</div>
				<div class="col-sm-3">
					<input type="text" id="form-field-1" placeholder="Thời gian lưu lại" class="form-control" name="day_time_<?=$i?>[]" value='<?=$t->time_to_stay?>'>
				</div>
				<div class="col-sm-1">
					<button class="btn btn-xs btn-danger" id_remove='<?=$t->id?>'>
						<i class="ace-icon fa fa-trash-o bigger-120"></i>
					</button>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
</div>
<div class="form-group">
	<div class="col-sm-3" style="text-align: left;">
	<button class="btn btn-sm btn-warning" id="btn_click_<?=$i?>" count="<?=$i?>">
		<span class="bigger-110 no-text-shadow" >Thêm danh sách</span>
	</button>
	</div>
</div>


<script>
$(document).ready(function() {
	$(".btn-danger").each(function(){
		$(this).click(function(){
			if($(this).attr("id_remove")){
				var tem=$(this).closest('.form-group')
				$.ajax({
                    data: {id:$(this).attr("id_remove")},
                    type:'POST',
                    url:'<?= yii\helpers\Url::to(['combo/delete-info']); ?>',
                    success:function(data) {
                        if(data.code==200){
                            tem.remove();
                        }
                   }
                });   
			}else{
				$(this).closest('.form-group').remove();
			}
			
			return false;
		});
	});
	
	 if (!ace.vars['old_ie']) $('.time_item_<?=$i?>').datetimepicker({
    	format: 'HH:mm ',//use this option to display seconds
        icons: {
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-arrows ',
            clear: 'fa fa-trash',
            close: 'fa fa-times'
        }
    }).next().on(ace.click_event, function() {
        $(this).prev().focus();
    });
});

	
    $("#btn_click_<?=$i?>").click(function(){
    	var html='<div class="form-group"><div class="col-sm-2"><input type="text"  placeholder="Thời gian" class="form-control time_item_<?=$i?>" name="day_<?=$i?>[]"  ></div><div class="col-sm-3"><input type="text" id="form-field-1" placeholder="Nội dung" class="form-control" name="day_conten_<?=$i?>[]" ></div><div class="col-sm-3"><input type="text" id="form-field-1" placeholder="Địa chỉ" class="form-control" name="day_address_<?=$i?>[]" ></div><div class="col-sm-3"><input type="text" id="form-field-1" placeholder="Thời gian lưu lại" class="form-control" name="day_time_<?=$i?>[]"></div><div class="col-sm-1"><button class="btn btn-xs btn-danger"><i class="ace-icon fa fa-trash-o bigger-120"></i></button></div></div>'
    	$(".content_id_<?=$i?>").append(html);
	  	
    	return false;
    });
</script>