<?php 
use App\Http\Model\code\Code_model;
 ?>
<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Tên</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('name',$model->name,['class'=>'form-control','placeholder'=>"Enter ..."])}}

        <span class="text-red"><?= ($errors->has('name'))? $errors->first('name'):''; ?></span>
    </div>
</div>

<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Thời gian bắt đầu</label>
    </div>
    <div class="col-sm-10">
         {{ Form::text('time_start',date('H:i d/m/Y', $model->time_start),['class'=>'form-control pull-right datetimepicker','placeholder'=>"Enter ..."])}}

        <span class="text-red"><?= ($errors->has('time_start'))? $errors->first('time_start'):''; ?></span>
    </div>
</div>
<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Thời gian kết thúc </label>
    </div>
    <div class="col-sm-10">
         {{ Form::text('time_end',date('H:i d/m/Y', $model->time_end),['class'=>'form-control pull-right datetimepicker','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('time_end'))? $errors->first('time_end'):''; ?></span>
    </div>
</div>
<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Tiền tố đầu tiên</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('prefix',$model->prefix,['class'=>'form-control','placeholder'=>"Enter ..."])}}

        <span class="text-red"><?= ($errors->has('prefix'))? $errors->first('prefix'):''; ?></span>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Số lượng code</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('number_code',$model->number_code,['class'=>'form-control number_input_price','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('number_code'))? $errors->first('number_code'):''; ?></span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Loại giảm giá</label>
    </div>
    <div class="col-sm-10">
       {{Form::select('type', Code_model::getTypeArray(),$model->type,['class'=>'form-control'])}}
       <span class="text-red"><?= ($errors->has('type'))? $errors->first('type'):''; ?></span>
   </div>
</div>
<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Giảm giá </label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('price',$model->price,['class'=>'form-control number_input_price','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('price'))? $errors->first('price'):''; ?></span>
    </div>
</div>
