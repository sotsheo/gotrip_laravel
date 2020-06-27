

<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Tên</label>
    </div>
    <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter ..." name="name" value="{{ $model->name }}">
        <span class="text-red"><?= ($errors->has('name'))? $errors->first('name'):''; ?></span>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-2 control-label">
        <label for="exampleInputFile">Logo</label>
    </div>
    <div class="col-sm-10">
        <input type="file" class="filestyle" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline input-s"  name="logo" value="{{ $model->logo }}">
        <?php
        if($model->logo_root){
            ?>
            <img src="<?= url($model->logo_root)?>" style="max-height: 150px;">
        <?php }?>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-2 control-label">
        <label for="exampleInputFile">Icon</label>
    </div>
    <div class="col-sm-10">
        <input type="file" class="filestyle" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline input-s" name="icon" value="{{ $model->icon }}">
        <?php
        if($model->icon_root){
            ?>
            <img src="<?= url($model->icon_root)?>" style="max-height: 150px;">
        <?php }?>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-2 control-label">
        <label for="exampleInputFile">Icon Shortcut</label>
    </div>
    <div class="col-sm-10">
        <input type="file" class="filestyle" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline input-s"  name="icon_shortcut" value="{{ $model->icon }}">
        <?php
        if($model->icon_shortcut_root){
            ?>
            <img src="<?= url($model->icon_shortcut_root)?>" style="max-height: 150px;">
        <?php }?>
    </div>
</div>

<div class="form-group select_a">
    <div class="col-sm-2 control-label">
        <label>Kiểu web</label>
    </div>
    <div class="col-sm-10">
        <select class="form-control select2 district" name="type_website">
            <option value="1" {{ $model->type_website==1 ?'selected':'' }}>Tin tức</option>
            <option value="2" {{ $model->type_website==2 ?'selected':'' }}>Sản phẩm</option>
        </select>
        <span class="text-red"></span>
    </div>
</div>
<div class="form-group phone">
    <div class="col-sm-2 control-label">
        <label>Phone</label>
    </div>
    <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter ..." name="phone" value="{{ $model->phone }}" >
        <span class="text-red"></span>
    </div>
</div>
<div class="form-group email">
    <div class="col-sm-2 control-label">
        <label>Email</label>
    </div>
    <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter ..." name="email" value="{{$model->email}}">
        <span class="text-red"><?= ($errors->has('email'))? $errors->first('email'):''; ?></span>
    </div>
</div>
<div class="form-group phone">
    <div class="col-sm-2 control-label">
        <label>Phone admin</label>
    </div>
    <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter ..." name="phone_admin" value="{{ $model->phone_admin }}">
        <span class="text-red"></span>
    </div>
</div>
<div class="form-group email">
    <div class="col-sm-2 control-label">
        <label>Email admin</label>
    </div>
    <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter ..." name="email_admin" value="{{ $model->email_admin }}">
        <span class="text-red"><?= ($errors->has('email_admin'))? $errors->first('email_admin'):''; ?></span>
    </div>
</div>
<div class="form-group ">
    <div class="col-sm-2 control-label">
        <label>Page size</label>
    </div>
    <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter ..." name="page_size" value="{{ $model->page_size }}">
        <span class="text-red"></span>
    </div>
</div>
<div class="form-group ">
    <div class="col-sm-2 control-label">
        <label>Page size admin</label>
    </div>
    <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter ..." name="page_size" value="{{ $model->page_admin }}">
        <span class="text-red"></span>
    </div>
</div>
<div class="form-group">
   <div class="col-sm-2 control-label">
        <label>Css default</label>
    </div>
    <div class="col-sm-10 control-label">
       <label class="switch">
         {{Form::checkbox('default', $model->default, $model->default)}}
         <span></span>
     </label>
 </div>
</div>
<div class="form-group">
   <div class="col-sm-2 control-label">
        <label>Sử dụng sản phẩm liên quan</label>
    </div>
    <div class="col-sm-10 control-label">
       <label class="switch">
         {{Form::checkbox('product_together', $model->product_together, $model->product_together)}}
         <span></span>
     </label>
 </div>
</div>
<div class="form-group">
   <div class="col-sm-2 control-label">
        <label>Sử dụng sản phẩm qrcode</label>
    </div>
    <div class="col-sm-10 control-label">
       <label class="switch">
         {{Form::checkbox('product_qrcode', $model->product_qrcode, $model->product_qrcode)}}
         <span></span>
     </label>
 </div>
</div>

<div class="form-group ">
    <div class="col-sm-2 control-label">
        <label>Địa chỉ</label>
    </div>
    <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter ..." name="address" value="{{ $model->address }}">
        <span class="text-red"></span>
    </div>
</div>
<div class="form-group ">
    <div class="col-sm-2 control-label">
        <label>Map</label>
    </div>
    <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter ..." name="map" value="{{ $model->map }}">
        <span class="text-red"></span>
    </div>
</div>
