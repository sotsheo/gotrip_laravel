
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
        <label>Danh mục</label>
    </div>
    <div class="col-sm-10">
       {{Form::select('category_id[]', $category,$model->category_id,['class'=>'form-control chosen-select2 ','multiple'=>"multiple",'data-placeholder'=>"Lựa chọn danh mục..." ])}}
       <span class="text-red"><?= ($errors->has('category_id'))? $errors->first('category_id'):''; ?></span>
   </div>
</div>
<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Code</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('code',$model->code,['class'=>'form-control','placeholder'=>"Enter ..."])}}
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
        <label>Mô tả </label>
    </div>
    <div class="col-sm-10">
        {{Form::textarea('description', $model->description,['class'=>'form-control'])}}
        <span class="text-red"></span>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Giá bao gồm</label>
    </div>
    <div class="col-sm-10">
        {{Form::textarea('price_include', $model->price_include,['class'=>'form-control'])}}
        <span class="text-red"></span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Giá không bao gồm</label>
    </div>
    <div class="col-sm-10">
        {{Form::textarea('price_not_included', $model->price_not_included,['class'=>'form-control'])}}
        <span class="text-red"></span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Chính sách</label>
    </div>
    <div class="col-sm-10">
        {{Form::textarea('policy', $model->policy,['class'=>'form-control'])}}
        <span class="text-red"></span>
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
