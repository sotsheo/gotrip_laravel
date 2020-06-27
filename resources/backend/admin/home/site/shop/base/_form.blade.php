
<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Tên</label>
    </div>
    <div class="col-sm-10 control-label">
        <input type="text" class="form-control" placeholder="Enter ..." name="name"
        value="<?= $model->name;?>">
        <span class="text-red"><?= ($errors->has('name'))? $errors->first('name'):''; ?></span>
    </div>
</div>
<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Địa chỉ</label>
    </div>
    <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Enter ..." name="address"
        value="<?= $model->address;?>">
        <span class="text-red"><?= ($errors->has('address'))? $errors->first('address'):''; ?></span>
    </div>
</div>
<div class="form-group select_a">
    <div class="col-sm-2 control-label">
        <label>Thành phố</label>
    </div>
    <div class="col-sm-10">
        <select class="form-control select2 district" name="province">
            <option value="0">Chọn danh mục</option>
            <?php
            foreach($province as $item){
                ?>
                <option value="{{$item->id_name}}"  <?= ($item->id_name==$model->province) ? 'selected' : '' ?>>{{$item->name}}</option>
            <?php }?>
        </select>
        <span class="text-red"></span>
    </div>
</div>
<div class="form-group required city_group <?=isset($district ) ?'active':''?>">
    <div class="col-sm-2 control-label">
        <label>Tỉnh thành </label>
    </div>
    <div class="col-sm-10">
        <select class="form-control select2 city" name="district">
            <?php
            if(isset($district ) && $district ){
                foreach($district as $item){
                    ?>
                    <option value="{{$item->id_name}}" <?= ($item->id_name==$model->district) ? 'selected' : '' ?>>{{$item->name}}</option>
                <?php } } ?>
            </select>
        </div>
    </div>

    <div class="form-group required">
        <div class="col-sm-2 control-label">
            <label>Map</label>
        </div>
        <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Enter ..." name="map"
            value="<?= $model->map;?>">
            <span class="text-red"><?= ($errors->has('city'))? $errors->first('map'):''; ?></span>
        </div>
    </div>


    <div class="form-group ">
        <div class="col-sm-2 control-label">
            <label>Mô tả ngắn</label>
        </div>
        <div class="col-sm-10">
            <textarea class="form-control" rows="3" placeholder="Enter ..." name="short_description" id="short_description"><?= $model->short_description?></textarea>
            <span class="text-red"><?= ($errors->has('short_description'))? $errors->first('short_description'):''; ?></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">
            <label for="exampleInputFile">Hình ảnh</label>
        </div>
        <div class="col-sm-10">
            <input type="file" id="exampleInputFile" name="img">
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
            <select class="form-control" name="state">
                <option value="0" <?= ($model->state) ? 'selected' : '' ?>>Hiện thị</option>
                <option value="1" <?= ($model->state==1) ? 'selected' : '' ?>>Ẩn</option>
            </select>
        </div>
    </div>

    <div class="form-group ">
        <div class="col-sm-2 control-label">
            <label>Thứ tự</label>
        </div>
        <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Enter ..." name="orders" value="<?= $model->orders;?>">
            <span class="text-red"><?= ($errors->has('order'))? $errors->first('order'):''; ?></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">
            <label>Từ khóa</label>
        </div>
        <div class="col-sm-10">
            <textarea class="form-control" rows="3" placeholder="Enter ..." name="key_card"><?= $model->key_card;?></textarea>
        </div>
    </div>
    

    <script>
      $(function () {
    //Initialize Select2 Elements
    // $('.select2').select2()});
</script>
<style type="text/css">
    .city_group{
        display: none;
    }
    .city_group.active{
        display: block;
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){
        $('.district').change(function(){
            var provice=$(this).find(':selected').val();
            if(provice){    
                $.ajax({

                    url: "{{route('getDistrictShop')}}",
                    data: {'provice':provice,"_token": "{{ csrf_token() }}"},
                    type: 'POST',
                    success: function (data) {
                       var html='';
                       if(data){
                        jQuery.each(data, function(index, item) {

                            html+="<option value='"+item['id_name']+"'>"+item['name']+'</option>';
                        });
                        $('.city_group').addClass('active');
                        $('.city option').each(function() {
                            $(this).remove();
                        });
                        $('.city').append(html);
                        $('.select2').select2();
                    }

                },
                error: function (xhr, status, error) {

                }
            });
            }
        });
    });
</script>