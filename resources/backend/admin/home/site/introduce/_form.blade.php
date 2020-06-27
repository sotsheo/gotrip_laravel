
<input type="text" class="form-control" placeholder="Enter ..." name="id" value="<?= ($model->id)?$model->id:'' ?>" style="display:none">
<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Tên</label>
    </div>
    <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter ..." name="name" value="<?= $model->name?>">
        <span class="text-red"></span>
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
<div class="form-group required_a">
    <div class="col-sm-2 control-label">
        <label>Mô tả ngắn</label>
    </div>
    <div class="col-sm-10">
        <textarea class="form-control" rows="3" placeholder="Enter ..." name="short_description">{{$model->short_description}}</textarea>
        <span class="text-red"></span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Mô tả</label>
    </div>
    <div class="col-sm-10">
        <textarea name="description" id="description" rows="10" cols="80" >{{$model->description}}</textarea>
    </div>
</div>
<div class="form-group ">
    <div class="col-sm-2 control-label">
        <label>Key</label>
    </div>
    <div class="col-sm-10">
        <textarea class="form-control" rows="3" placeholder="Enter ..." name="key">{{$model->key}}</textarea>
    </div>
</div>
