<?php 

use App\Http\Model\province\Province_model;
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
<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Sao</label>
    </div>
    <div class="col-sm-10">
        {{Form::select('star', [1=>'1',2=>'2',3=>'3',4=>'4',5=>'5'],$model->star,['class'=>'form-control'])}}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Mô tả </label>
    </div>
    <div class="col-sm-10">
        {{Form::textarea('overview', $model->overview,['class'=>'form-control'])}}
        <span class="text-red"></span>
    </div>
</div>


<div class="form-group">
    <div class="col-sm-2 control-label">
        <label for="exampleInputFile">Hình ảnh</label>
    </div>
    <div class="col-sm-10">
       <input type="file" class="filestyle" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline input-s"  name="img" value="{{ $model->img }}">
       <?php if($model->img_root){ ?>
        <img src="<?= url($model->img_root)?>" style="max-height: 150px;">
    <?php }?>
    <span class="text-red"><?= ($errors->has('img_root'))? $errors->first('img_root'):''; ?></span>
</div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Thành phố </label>
    </div>
    <div class="col-sm-10">
     {{Form::select('province_id', Province_model::getArrayProvince(),$model->province_id,['class'=>'form-control'])}}
      <span class="text-red"><?= ($errors->has('province_id'))? $errors->first('province_id'):''; ?></span>
 </div>
</div>

<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Địa chỉ</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('address',$model->address,['class'=>'form-control','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('address'))? $errors->first('address'):''; ?></span>
    </div>
</div>

<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Điện thoại</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('phone',$model->phone,['class'=>'form-control','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('phone'))? $errors->first('phone'):''; ?></span>
    </div>
</div>

<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Email</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('email',$model->email,['class'=>'form-control','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('email'))? $errors->first('email'):''; ?></span>
    </div>
</div>

<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Map</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('map',$model->map,['class'=>'form-control','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('map'))? $errors->first('map'):''; ?></span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Hot</label>
    </div>
    <div class="col-sm-10">
       <label class="switch">
           {{Form::checkbox('ishot', 1,true)}}
           <span></span>
       </label>
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
