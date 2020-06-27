
<div class="form-group required">
 <div class="col-sm-2 control-label">
    <label>Tên</label>
</div>
<div class="col-sm-10">
    {{ Form::text('name',$model->name,['class'=>'form-control','placeholder'=>"Enter ..."])}}
    <span class="text-red"></span>
</div>
</div>


<div class="form-group required_a">
 <div class="col-sm-2 control-label">
    <label>Mô tả ngắn</label>
</div>
<div class="col-sm-10">
    {{Form::textarea('short_description', $model->short_description,['class'=>'form-control'])}}
    <span class="text-red"></span>
</div>
</div>
