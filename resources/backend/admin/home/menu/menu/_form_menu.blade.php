<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body">
        <div class="list_left">
         <div class="nav-tabs-custom">
             <ul class="nav nav-tabs">
               <?php $i=0;foreach($links as $link => $value){$i++;?>
                <li class="<?= ($i==1)?'active':'';?>"><a href="#tab_<?= $i;?>" data-toggle="tab">{{$link}}</a></li>
            <?php }?>
        </ul>
    </div>
    <div class="tab-content link_v2">
     <?php $i=0;foreach($links as $link => $value){$i++;?>
        <div class="tab-pane <?= ($i==1)?'active':'';?>" id="tab_<?= $i;?>">
            <div class="row" style="margin: 5px 0px">
                <?php
                foreach ($value as $key) {
                    ?>
                        <div class="col-md-12">
                            <div class="form-group" style="margin: 0px;">
                                <div class="radio ">
                                    <label style="font-weight: 700;"  class="radio-custom">
                                        <input  type="radio" name="links" value="{{$key['link']}}" {{($model->link==$key['link'])?'checked':''}} > 
                                        <i class="fa fa-circle-o {{($model->link==$key['link'])?'checked':''}}"></i>{{$key['name']}}
                                    </label>
                                </div>
                           
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <div style="padding: 5px 0px; text-align: right">
        <button type="button" class="btn btn-primary save_link" data-dismiss="modal">Lưu </button>
      </div>
</div>
</div>

</div>
</div>
</div>

<style type="text/css">
    .list_left .row{
        border: 1px solid #e6e5e5;
        padding: 0px;
        margin-top: 10px;
    }
    .list_left .row .col-md-3 {
        border-bottom: 1px solid #e6e5e5;
    }
    .list_left .row .col-md-3 .form-group{
        border: 0px;
        border-right: 1px solid #e6e5e5;
        padding: 10px 5px;
    }
    .list_left .row .col-md-3 .form-group .radio{
        margin: 0px;
    }
</style>