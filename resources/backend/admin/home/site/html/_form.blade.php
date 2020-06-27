
<div class="form-group required">
	<div class="col-sm-2 control-label">
		<label>Tên</label>
	</div>
	<div class="col-sm-10">
		{{ Form::text('name',$model->name,['class'=>'form-control validate_price','placeholder'=>"Enter ..."])}}
		
		<span class="text-red"><?= ($errors->has('name'))? $errors->first('name'):''; ?></span>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-2 control-label">
		<label>Nội dung bài viết</label>
	</div>
	<div class="col-sm-10">
		{{Form::textarea('values', $model->values,['class'=>'form-control'])}}
	</div>
</div>

