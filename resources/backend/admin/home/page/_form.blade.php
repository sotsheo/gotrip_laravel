
<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Tên</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('name',$model->name,['class'=>'form-control','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('name'))? $errors->first('name'):''; ?></span>
    </div>
</div>

<div class="form-group ">
    <div class="col-sm-2 control-label">
        <label>Mô tả ngắn</label>
    </div>
    <div class="col-sm-10">
        {{Form::textarea('short_description', $model->short_description,['class'=>'form-control'])}}
        <span class="text-red"><?= ($errors->has('short_description'))? $errors->first('short_description'):''; ?></span>
    </div>
</div>

<div class="form-group ">
    <div class="col-sm-2 control-label">
        <label>Mô tả</label>
    </div>
    <div class="col-sm-10">
        {{Form::textarea('description', $model->description,['class'=>'form-control'])}}
        <span class="text-red"><?= ($errors->has('description'))? $errors->first('description'):''; ?></span>
    </div>
</div>

<div class="form-group has-warning">
    <div class="col-sm-2 control-label">
        <label>View detail</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('view_detail',$model->view_detail,['class'=>'form-control','placeholder'=>"Enter ..."])}}
        <span class="help-block">Hãy lưu ý khi sửa dụng</span>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-2 control-label">
        <label for="exampleInputFile">Hình ảnh</label>
    </div>
    <div class="col-sm-10">
        <input type="file" class="filestyle" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline input-s"  name="img" value="{{ $model->img }}">
        <?php
        if($model->img){
            ?>
            <img src="<?= url($model->img)?>" style="max-height: 150px;">
        <?php }?>
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

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Thứ tự</label>
        </div>
        <div class="col-sm-10">
        {{ Form::text('orders',$model->orders,['class'=>'form-control','placeholder'=>"Enter ..."])}}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Từ khóa</label>
    </div>
        <div class="col-sm-10">
        {{ Form::text('key_card',$model->key_card,['class'=>'form-control','placeholder'=>"Enter ..."])}}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Thời gian public</label>
    </div>
    <div class="col-sm-10">
    <div class="input-group date">
        
        {{ Form::text('public_at',date('d/m/Y', $model->public_at),['id'=>"datepickers",'class'=>'form-control pull-right datepicker-input','placeholder'=>"Enter ..."])}}
    </div>
</div>
</div>
