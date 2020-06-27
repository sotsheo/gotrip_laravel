
<div class="form-group ">
   <div class="col-sm-2 control-label">
    <label>Tên</label>
</div>
<div class="col-sm-10">
 {{ Form::text('name',$model->name,['class'=>'form-control ','placeholder'=>"Enter ..."])}}
 <span class="text-red"><?= ($errors->has('name'))? $errors->first('name'):''; ?></span>
</div>
</div>
<div class="form-group">
   <div class="col-sm-2 control-label">
    <label>Danh mục sản phẩm</label>
</div>
<div class="col-sm-10">
    <select class="form-control" name="id_parent">
        <option value="0">Chọn danh mục cha</option>
        <?php foreach ($category as $key ):?>
            <option value="{{ $key->id }}" <?= ($key->id==$model->id_parent)? 'selected' : '' ?>>{{ $key->name }}</option>
        <?php endforeach;?>
    </select>
</div>
</div>

<div class="form-group ">
   <div class="col-sm-2 control-label">
    <label>Mô tả ngắn</label>
</div>
<div class="col-sm-10">
    {{Form::textarea('short_description', $model->short_description,['class'=>'form-control'])}}
    <span class="text-red"></span>
</div>
</div>
<div class="form-group">
   <div class="col-sm-2 control-label">
    <label>Mô tả</label>
</div>
<div class="col-sm-10">
    {{Form::textarea('description', $model->description,['class'=>'form-control'])}}
</div>
</div>
<div class="form-group">
   <div class="col-sm-2 control-label">
    <label for="exampleInputFile">Hình ảnh</label>
</div>
<div class="col-sm-10">
      <input type="file" class="filestyle" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline input-s"  name="img" value="{{ $model->img }}">
    <?php if($model->img_root){ ?>
        <img src="<?= $model->img_path.'/200x200/'.$model->img_name?>" style="max-height: 150px;">
    <?php }?>
</div>
</div>
<div class="form-group">
   <div class="col-sm-2 control-label">
    <label>Trạng thái</label>
</div>
<div class="col-sm-10">
    {{Form::select('status', [1=>'Hiện',0=>'Ẩn'],$model->status,['class'=>'form-control'])}}
</div>
</div>


<div class="form-group">
   <div class="col-sm-2 control-label">
        <label>Hiển thị ở trang chủ</label>
    </div>
    <div class="col-sm-10 control-label">
       <label class="switch">
         {{Form::checkbox('ishome', 1, $model->ishome)}}
         <span></span>
     </label>
 </div>
</div>
<div class="form-group has-warning">
   <div class="col-sm-2 control-label">
    <label>View detail</label>
</div>
<div class="col-sm-10">
   {{ Form::text('view_detail',$model->view_detail,['class'=>'form-control validate_price','placeholder'=>"Enter ..."])}}
   <span class="help-block">Hãy lưu ý khi sửa dụng</span>
</div>
</div>

<div class="form-group has-warning">
   <div class="col-sm-2 control-label">
    <label>View</label>
</div>
<div class="col-sm-10">
   {{ Form::text('view_detail',$model->view_detail,['class'=>'form-control validate_price','placeholder'=>"Enter ..."])}}
   <span class="help-block">Hãy lưu ý khi sửa dụng</span>
</div>
</div>

<div class="form-group ">
   <div class="col-sm-2 control-label">
    <label>Thứ tự</label>
</div>
<div class="col-sm-10">
    {{ Form::text('orders',$model->orders,['class'=>'form-control validate_price','placeholder'=>"Enter ..."])}}
</div>
</div>

<div class="form-group">
   <div class="col-sm-2 control-label">
    <label>Từ khóa</label>
</div>
<div class="col-sm-10">
    {{Form::textarea('key_card', $model->key_card,['class'=>'form-control'])}}
</div>
</div>



