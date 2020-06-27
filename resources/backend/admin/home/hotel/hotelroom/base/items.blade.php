<div class="item_list" style="padding: 20px">
	<?php if($item){ ?>
		<?php foreach($item as $key=>$val){?>
			<div class="checkbox">
				<label>
					<input name="item[]" type="checkbox" class="ace ace-checkbox-2" value="<?=$val->id?>" 
					<?=isset($model->room_item[$val->id])?'checked':''?>>
						<span class="lbl"> <?=$val->name?></span>
				</label>
			</div>
		<?php } ?>
	<?php } ?>
</div>
<style type="text/css">
	.item_list {
		display: flex;
		align-items: center;
		flex-wrap: wrap;
	}
	.item_list .checkbox{
		width: 10%;
		padding: 5px;
	}
</style>
