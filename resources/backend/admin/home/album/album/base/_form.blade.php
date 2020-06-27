

<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Tên</label>
    </div>
    <div class="col-sm-10 control-label">
        {{ Form::text('name',$model->name,['class'=>'form-control','placeholder'=>"enter ..."])}}
        <span class="text-red"><?= ($errors->has('name'))? $errors->first('name'):''; ?></span>
    </div>
</div>
<div class="form-group select_a">
    <div class="col-sm-2 control-label">
        <label>Danh mục</label>
    </div>
    <div class="col-sm-10 control-label">
        {{Form::select('id_category', $category,$model->id_category,['class'=>'form-control'])}}
        <span class="text-red"><?= ($errors->has('id_category'))? $errors->first('id_category'):''; ?></span>
    </div>
</div>

<div class="form-group ">
    <div class="col-sm-2 control-label">
        <label>Mô tả ngắn</label>
    </div>
    <div class="col-sm-10 control-label">
        {{Form::textarea('short_description', $model->short_description,['class'=>'form-control'])}}
        <span class="text-red"><?= ($errors->has('short_description'))? $errors->first('short_description'):''; ?></span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label for="exampleinputfile">Hình ảnh</label>
    </div>
    <div class="col-sm-10 control-label">
       <input type="file" class="filestyle" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline input-s"  name="img" value="{{ $model->img }}">
        <?php
        if($model->img_root){
            ?>
            <img src="<?= url($model->img_root)?>" style="max-height: 150px;">
        <?php }?>
    </div>
</div>
<div class="form-group">
   <div class="col-sm-2 control-label">
    <label>Nổi bật</label>
</div>
<div class="col-sm-10 control-label">
 <label class="switch">
   {{Form::checkbox('ishot', $model->ishome, false)}}
   <span></span>
</label>
</div>
</div>
<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>trạng thái</label>
    </div>
    <div class="col-sm-10">
     {{Form::select('status', [1=>'hiện',0=>'ẩn '],$model->status,['class'=>'form-control'])}}
 </div>
</div>


<div class="form-group ">
    <div class="col-sm-2 control-label">
        <label>Thứ tự</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('orders',$model->orders,['class'=>'form-control','placeholder'=>"enter ..."])}}
        <span class="text-red"><?= ($errors->has('order'))? $errors->first('order'):''; ?></span>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Từ khóa</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('key_card',$model->key_card,['class'=>'form-control','placeholder'=>"enter ..."])}}
    </div>
</div>



