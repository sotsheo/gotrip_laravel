
<input type="text" class="form-control" placeholder="Enter ..." name="id" value="<?= ($model->id)?$model->id:'' ?>" style="display:none;">

<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Tên</label>
    </div>
    <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter ..." name="name"
        value="<?= $model->name;?>">
        <span class="text-red"><?= ($errors->has('name'))? $errors->first('name'):''; ?></span>
    </div>
</div>


<div class="form-group ">
    <div class="col-sm-2 control-label">
        <label>Mật khẩu</label>
    </div>
    <div class="col-sm-10">
        <input type="password" class="form-control" placeholder="Enter ..." name="password"
        value="<?= $model->name;?>">
        <span class="text-red"><?= ($errors->has('password'))? $errors->first('password'):''; ?></span>
    </div>
</div>

<div class="form-group select_a">
    <div class="col-sm-2 control-label">
        <label>Quyền</label>
    </div>
    <div class="col-sm-10">
        <select class="form-control" name="au_list">
            <option value="0">Chọn danh mục</option>
            <?php
            foreach($au as $item){
                ?>
                <option value="{{$item->id}}" <?= ($item->id==$model->au_list)? 'selected' : '' ?>>{{$item->name}}</option>
            <?php }?>
        </select>
        <span class="text-red"><?= ($errors->has('au_list'))? $errors->first('au_list'):''; ?></span>
    </div>
</div>
