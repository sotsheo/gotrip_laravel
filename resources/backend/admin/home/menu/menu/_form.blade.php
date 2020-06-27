

<div class="form-group required">
   <div class="col-sm-2 control-label">
    <label>Tên</label>
</div>
<div class="col-sm-10">
    <input type="text" class="form-control" placeholder="enter ..." name="name" value="{{$model->name}}">
    <span class="text-red"><?= ($errors->has('name'))? $errors->first('name'):''; ?></span>
</div>
</div>

<div class="form-group">
   <div class="col-sm-2 control-label">
    <label>chọn menu cha</label>
</div>
<div class="col-sm-10">
     {{Form::select('id_parent', $category,$model->id_parent,['class'=>'form-control'])}}
</div>
</div>
<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Đường dẫn</label>
    </div>
    <div class="col-sm-10">
        <div class="col-sm-2">
            <label class="radio-custom">
                <input type="radio" class="type" name="type" value="1" {{($model->type==1)?'checked':''}} >
                 <i class="fa fa-circle-o"></i><span> Link tới web</span>
            </label>
        </div>
        <div class="col-sm-2">
            <label class="radio-custom">
                <input type="radio" class="type" name="type" value="2" {{($model->type==2)?'checked':''}}>
                <i class="fa fa-circle-o"></i><span> Link ngoài web</span>
            </label>
        </div>
        <div class=" out_web {{($model->type==1)?'hidden':''}}">
            <input type="text" class="form-control link_root" placeholder="Link ..." name="link" value="{{$model->link}}">
        </div>
        <br>
        <div class="col-sm-12 in_web {{($model->type==2)?'hidden':''}}">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Lựa chọn
            </button>
     </div>
     @include('admin/home/menu/menu/_form_menu',['links'=>$links])

     <script type="text/javascript">
        $(document).ready(function(){
            $(".link_v2 input[type=radio]").click(function(){
                $(".link_root").val($(this).val());

            });
            $(".col-sm-10 .type").each(function(){
               
                $(this).click(function(){
                    var val=$(this).val();
                    if(val==1){
                        $(".out_web").addClass("hidden");
                        $(".in_web").removeClass("hidden");
                    }else{
                        $(".in_web").addClass("hidden");
                        $(".out_web").removeClass("hidden");
                    }
                });
                
            });
            
        });
     </script>
 </div>
</div>
<div class="form-group ">
   <div class="col-sm-2 control-label">
    <label>Mô tả ngắn</label>
</div>
<div class="col-sm-10">
    <textarea class="form-control" rows="3" placeholder="enter ..." name="short_description">{{$model->short_description}}</textarea>
    <span class="text-red"></span>
</div>
</div>



<div class="form-group">
   <div class="col-sm-2 control-label">
    <label for="exampleinputfile">Hình ảnh</label>
</div>
<div class="col-sm-10">
   <input type="file" class="filestyle" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline input-s"  name="img" value="{{ $model->img }}">
   <?php
   if($model->img_root){
    ?>
    <img src="<?= url($model->img_root)?>" style="max-height: 150px;">
<?php }?>
</div>
</div>
<div class="form-group">
   <div class="col-sm-2 control-label">
    <label for="exampleinputfile">Icon</label>
</div>
<div class="col-sm-10">
   <input type="file" class="filestyle" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline input-s"  name="icon" value="{{ $model->icon }}">
   <?php
   if($model->icon_root){
    ?>
    <img src="<?= url($model->icon_root)?>" style="max-height: 150px;">
<?php }?>
</div>
</div>
<div class="form-group">
   <div class="col-sm-2 control-label">
    <label>Trạng thái</label>
</div>
<div class="col-sm-10">
    <select class="form-control" name="state">
        <option value="0" <?= (!$model->state) ? 'selected' : '' ?>>Hiện thị</option>
        <option value="1" <?= ($model->state==1) ? 'selected' : '' ?>>Ẩn</option>
    </select>
</div>
</div>

<div class="form-group">
   <div class="col-sm-2 control-label">
    <label>Thứ tự</label>
</div>
<div class="col-sm-10">
    <input type="text" class="form-control" placeholder="enter ..." name="orders" value="{{ $model->orders }}">
</div>
</div>

