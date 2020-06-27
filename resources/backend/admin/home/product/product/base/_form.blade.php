

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
    <label>Code</label>
</div>
<div class="col-sm-10">
    {{ Form::text('code',$model->code,['class'=>'form-control','placeholder'=>"Enter ..."])}}
    <span class="text-red"></span>
</div>
</div>

<div class="form-group ">
   <div class="col-sm-2 control-label">
    <label>Url</label>
</div>
<div class="col-sm-10">
    {{ Form::text('url_seo',$model->url_seo,['class'=>'form-control','placeholder'=>"Enter ..."])}}
    
    <span class="text-red"></span>
</div>
</div>
<div class="form-group select_a">
   <div class="col-sm-2 control-label">
    <label>Sản phẩm gốc</label>
</div>
<div class="col-sm-10">
    {{Form::select('product_root', $product_root,$model->product_root,['class'=>'form-control'])}}
    
    <span class="text-red"><?= ($errors->has('product_root'))? $errors->first('product_root'):''; ?></span>
</div>
</div>
<div class="form-group select_a">
   <div class="col-sm-2 control-label">
    <label>Danh mục sản phẩm</label>
</div>
<div class="col-sm-10">
    {{Form::select('id_category', $category,$model->id_category,['class'=>'form-control'])}}
    
    <span class="text-red"><?= ($errors->has('id_category'))? $errors->first('id_category'):''; ?></span>
</div>
</div>

<div class="form-group ">
   <div class="col-sm-2 control-label">
    <label>Hãng sản xuất</label>
</div>
<div class="col-sm-10">
    {{Form::select('id_manufacturer', $manufacturer,$model->id_manufacturer,['class'=>'form-control'])}}
    
    <span class="text-red"></span>
</div>
</div>

<div class="form-group ">
   <div class="col-sm-2 control-label">
    <label>Giá bán</label>
</div>
<div class="col-sm-10">
    {{ Form::text('price',$model->price,['class'=>'form-control validate_price number','placeholder'=>"Enter ..."])}}
    
    <span class="text-red"></span>
</div>
</div>

<div class="form-group ">
   <div class="col-sm-2 control-label">
    <label>Giá thị trường</label>
</div>
<div class="col-sm-10">
    {{ Form::text('price_market',$model->price_market,['class'=>'form-control validate_price number','placeholder'=>"Enter ..."])}}
    
    <span class="text-red"></span>
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
    <label>Nội dung bài viết</label>
</div>
<div class="col-sm-10">
    {{Form::textarea('description', $model->description,['class'=>'form-control'])}}
</div>
</div>
<div class="form-group">
   <div class="col-sm-2 control-label">
    <label>Ghi chú</label>
</div>
<div class="col-sm-10">
    {{Form::textarea('note', $model->note,['class'=>'form-control'])}}
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
    <label>Sản phẩm nổi bật</label>
</div>
<div class="col-sm-10 control-label">
 <label class="switch">
   {{Form::checkbox('ishot', $model->ishot, $model->ishot)}}
   <span></span>
</label>
</div>
</div>
<div class="form-group">
 <div class="col-sm-2 control-label">
    <label>Sản phẩm bán chạy</label>
</div>
<div class="col-sm-10 control-label">
 <label class="switch">
   {{Form::checkbox('isselling', $model->isselling, $model->isselling)}}
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

<div class="form-group">
   <div class="col-sm-2 control-label">
    <label>Thứ tự</label>
</div>
<div class="col-sm-10">
    {{Form::text('orders', $model->orders,['class'=>'form-control'])}}
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

<div class="form-group">
   <div class="col-sm-2 control-label">
    <label>Thời gian public</label>
</div>
<div class="col-sm-10">
   
    {{ Form::text('public_at',date('d/m/Y', $model->public_at),['id'=>"datepickers",'class'=>'form-control pull-right datepicker-input','placeholder'=>"Enter ...",'data-date-format'=>"d/m/yyyy"])}}
</div>
</div>
<script type="text/javascript">
   function formatNumber(numbers,number_check=3,tach=','){
     numbers=numbers.toString().split(",").join("");
      // đảo ngược dữ liêu
      var reve=numbers.toString().split("").reverse().join("");
      // kiểm tra chuỗi có chia hết cho các 
    var dau=parseInt(reve.length/number_check);
    var count=dau*number_check;
    var text=reve;
      if(reve.length>number_check){
        text='';
        // kiem tra xem co bao nhieu dau 
        if(reve.length%number_check==0){
          dau-=1;
        }
        var check=0;
        
        reve.split("").forEach((val,index) => {
          if((index)%number_check==0 && dau && (index)>=number_check){
            
            text+=tach;
            dau--;
          }
          text+=val;
        });


      }
     return text.split("").reverse().join("");
   }
   $(".number").on("keypress keyup blur", function(event) {
        $(this).val(formatNumber($(this).val()));
            //this.value = this.value.replace(/[^0-9\.]/g,'');
          //$(this).val($(this).val().replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        //$(this).val(formatter.format(this.val()));
          if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
              event.preventDefault();
            }
          });
</script>