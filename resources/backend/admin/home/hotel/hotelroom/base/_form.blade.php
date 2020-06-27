<?php 

use App\Http\Model\province\Province_model;
use App\Http\Model\hotel\Hotel_model;
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
        <label>Khách sạn</label>
    </div>
    <div class="col-sm-10">
        {{Form::select('hotel_id', Hotel_model::getArrayHotel(),$model->hotel_id,['class'=>'form-control'])}}
    </div>
</div>

<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Giá phòng</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('price',$model->price,['class'=>'form-control number_input_price','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('price'))? $errors->first('price'):''; ?></span>
    </div>
</div>

<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Giá phòng (trẻ em)</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('price_children',$model->price_children,['class'=>'form-control number_input_price','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('price_children'))? $errors->first('price_children'):''; ?></span>
    </div>
</div>



<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Diện tích</label>
    </div>
    <div class="col-sm-10">
         {{ Form::text('acreage',$model->acreage,['class'=>'form-control','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('acreage'))? $errors->first('acreage'):''; ?></span>
    </div>
</div>

<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Giường đơn</label>
    </div>
    <div class="col-sm-10">
        {{Form::select('bed', range(0,10),$model->bed,['class'=>'form-control'])}}
        <span class="text-red"><?= ($errors->has('bed'))? $errors->first('bed'):''; ?></span>
    </div>
</div>


<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Giường đôi</label>
    </div>
    <div class="col-sm-10">
       {{Form::select('double_bed', range(0,10),$model->double_bed,['class'=>'form-control'])}}
        <span class="text-red"><?= ($errors->has('double_bed'))? $errors->first('double_bed'):''; ?></span>
    </div>
</div>



<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Kê thêm giường</label>
    </div>
    <div class="col-sm-10">
       {{Form::select('extra_bed', [0=>'Có ',1=>'Không '],$model->bed,['class'=>'form-control'])}}
        <span class="text-red"><?= ($errors->has('extra_bed'))? $errors->first('extra_bed'):''; ?></span>
    </div>
</div>

<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Giá kê thêm giường</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('price_extra_bed',$model->price_extra_bed,['class'=>'form-control number_input_price','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('price_extra_bed'))? $errors->first('price_extra_bed'):''; ?></span>
    </div>
</div>

<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Phụ thu ăn sáng</label>
    </div>
    <div class="col-sm-10">
       {{Form::select('breakfast', [0=>'Có ',1=>'Không '],$model->bed,['class'=>'form-control'])}}
        <span class="text-red"><?= ($errors->has('breakfast'))? $errors->first('breakfast'):''; ?></span>
    </div>
</div>

<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Giá  ăn sáng</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('price_breakfast',$model->price_breakfast,['class'=>'form-control number_input_price','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('price_breakfast'))? $errors->first('price_breakfast'):''; ?></span>
    </div>
</div>

<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Giá  ăn sáng(trẻ em)</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('price_breakfast_children',$model->price_breakfast_children,['class'=>'form-control number_input_price','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('price_breakfast_children'))? $errors->first('price_breakfast_children'):''; ?></span>
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
