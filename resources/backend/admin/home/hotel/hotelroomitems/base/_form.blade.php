<?php 
use App\Http\Model\flight\Flight_model;
use App\Http\Model\flight\Airline_model;
use App\Http\Model\province\Province_model;
?>
<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Tên</label>
    </div>
    <div class="col-sm-10">
         {{ Form::text('name',$model->name,['class'=>'form-control ','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('type'))? $errors->first('type'):''; ?></span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Mô tả </label>
    </div>
    <div class="col-sm-10">
        {{Form::textarea('description', $model->description,['class'=>'form-control'])}}
        <span class="text-red"></span>
    </div>
</div>



<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Trạng thái</label>
    </div>
    <div class="col-sm-10">
        {{Form::select('status', [1=>'Hiện',0=>'Ẩn '],$model->status,['class'=>'form-control'])}}
    </div>
</div>
