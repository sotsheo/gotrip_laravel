<?php if(isset($data) && $data){?>
	<?php if(isset($data['limit'])){?>
		<div class="form-group limit">
			<div class="col-sm-2 control-label">
				<label>Limit</label>
			</div>
			<div class="col-sm-10">
				<input type="text" class="form-control" placeholder="Enter ..." name="limit" >
				<span class="text-red"></span>
			</div>
		</div>
	<?php }?>
	<?php if(isset($data['limit_category'])){?>
		<div class="form-group limit">
			<div class="col-sm-2 control-label">
				<label>Limit category</label>
			</div>
			<div class="col-sm-10">
				<input type="text" class="form-control" placeholder="Enter ..." name="limit_category" >
				<span class="text-red"></span>
			</div>
		</div>
	<?php }?>
	<?php if(isset($data['category'])){?>
		<div class="form-group  ">
			<div class="col-sm-2 control-label">
				<label>Number id</label>
			</div>
			<div class="col-sm-10">
				<select class="form-control" name="id_category" > 
					<?php foreach($data['category'] as $cat) { ?>
						<option value="<?php print_r($cat->id);?>"><?php print_r($cat->name);?></option>
					<?php }?>
				</select>
				<span class="text-red"></span>
			</div>
		</div>
	<?php }?>
<?php }?>
