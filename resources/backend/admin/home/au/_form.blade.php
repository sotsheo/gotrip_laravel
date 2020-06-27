
{{ csrf_field() }}
<input type="text" class="form-control" placeholder="Enter ..." name="id" value="<?= ($model->id)?$model->id:'' ?>" style="display:none;">
<div class="form-group">
  <div class="col-sm-2 control-label">
    <label>Tên</label>
</div>
<div class="col-sm-10">
  <input type="text" name="name" value="{{$model->name}}" class="form-control">
</div>
</div>
<div class="form-group">
   <div class="col-sm-12">
    <?php if($model->id){?>
      <div class="row">
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5" >
            <div class="form-group">
              <label>Router</label>
              <select multiple="" class="form-control" style="min-height: 150px;" id="router_all">
                <?php foreach($au as $a){$check=0;?>
                  <?php foreach($getau as $as){if($as->id==$a->id) {$check=1; break;}}?>
                  <?php if($check==0){?>
                    <option value="{{$a->id}}">{{$a->name}}</option>
                <?php }?>
            <?php }?>

        </select>
    </div>
</div>

<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="display: flex;align-items: center;flex-wrap: wrap;">
    <div class="" style="width: 100%;text-align: center;">
        <button type="button" class="btn bg-maroon margin" id="add_router">>></button>
    </div>
    <div class="" style="width: 100%;text-align: center;">
        <button type="button" class="btn bg-navy btn-flat margin"><<</button>
    </div>
</div>
<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
    <div class="form-group">
      <label>Router active</label>
      <select multiple="" class="form-control" style="min-height: 150px;" id="router_remove">
        <?php foreach($getau as $a){?>
            <option value="{{$a->id}}">{{$a->name}}</option>
        <?php }?>

    </select>
</div>
</div>
<?php }?>
</div>
</div>



<script type="text/javascript">
    $(document).ready(function(){
        $("#add_router").click(function(){

            $.ajax({

                data: {'data':$("#router_all").val(),"_token": "{{ csrf_token() }}","id":"<?= $model->id?>"},
                type:'POST',
                url:'<?= route('addRouter')?>',
                success:function(data) {  
                    $("#router_all").find("option:selected").remove();
                }                
            });
            $.ajax({

                data: {'data':$("#router_remove").val(),"_token": "{{ csrf_token() }}","id":"<?= $model->id?>"},
                type:'POST',
                url:'<?= route('moveRouter')?>',
                success:function(data) {  
                    $("#router_all").find("option:selected").remove();
                }                
            });
            
            
        });
    });
</script>