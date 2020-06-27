<?php 
use App\Http\Model\flight\Flight_model;
use App\Http\Model\flight\Airline_model;
use App\Http\Model\province\Province_model;
?>
<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Loại</label>
    </div>
    <div class="col-sm-10">
        {{Form::select('type', Flight_model::getType(),$model->type,['class'=>'form-control'])}}
        <span class="text-red"><?= ($errors->has('type'))? $errors->first('type'):''; ?></span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Thành phố đi</label>
    </div>
    <div class="col-sm-10">
     {{Form::select('province_id_from', Province_model::getArrayProvince(),$model->province_id_from,['class'=>'form-control'])}}
      <span class="text-red"><?= ($errors->has('province_id_from'))? $errors->first('province_id_from'):''; ?></span>
 </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Thành phố tới</label>
    </div>
    <div class="col-sm-10">
     {{Form::select('province_id_to', Province_model::getArrayProvince(),$model->province_id_to,['class'=>'form-control'])}}
      <span class="text-red"><?= ($errors->has('province_id_to'))? $errors->first('province_id_to'):''; ?></span>
 </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Địa điểm khởi hành</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('address_from_text',$model->address_from_text,['class'=>'form-control','placeholder'=>"Enter ..."])}}
         <span class="text-red"><?= ($errors->has('name'))? $errors->first('name'):''; ?></span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Địa điểm tới</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('address_to_text',$model->address_to_text,['class'=>'form-control','placeholder'=>"Enter ..."])}}
         <span class="text-red"><?= ($errors->has('address_to_text'))? $errors->first('address_to_text'):''; ?></span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Hãng bay</label>
    </div>
    <div class="col-sm-10">
     {{Form::select('airline_id', Airline_model::getArrayAirline(),$model->airline_id,['class'=>'form-control'])}}
      <span class="text-red"><?= ($errors->has('airline_id'))? $errors->first('airline_id'):''; ?></span>
 </div>
</div>

<div class="form-group">
   <div class="col-sm-2 control-label">
        <label>Thời gian khởi hành</label>
    </div>
<div class="col-sm-10">
    <div class="input-group date">

        {{ Form::text('time_from',date('H:s d/m/Y', $model->time_from),['class'=>'form-control pull-right datetimepicker','placeholder'=>"Enter ..."])}}
         <span class="text-red"><?= ($errors->has('time_from'))? $errors->first('time_from'):''; ?></span>
    </div>
</div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Thời gian kết thúc</label>
    </div>
    <div class="col-sm-10">
            <div class="input-group date">
                {{ Form::text('time_to',date('H:s d/m/Y', $model->time_to),['class'=>'form-control pull-right datetimepicker','placeholder'=>"Enter ..."])}}
                 <span class="text-red"><?= ($errors->has('time_to'))? $errors->first('time_to'):''; ?></span>
            </div>
    </div>
</div>



<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Giá</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('price',$model->price,['class'=>'form-control number_input_price','placeholder'=>"Enter ..."])}}
         <span class="text-red"><?= ($errors->has('price'))? $errors->first('price'):''; ?></span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Giá trẻ em</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('price_children',$model->price_children,['class'=>'form-control number_input_price','placeholder'=>"Enter ..."])}}
         <span class="text-red"><?= ($errors->has('price_children'))? $errors->first('price_children'):''; ?></span>
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
