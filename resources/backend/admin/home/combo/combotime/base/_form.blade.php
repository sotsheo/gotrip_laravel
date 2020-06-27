<?php 
use App\Http\Model\flight\Flight_model;
use App\Http\Model\hotel\Hotel_model;
use App\Http\Model\hotel\HotelRoom_model;
use App\Http\Model\flight\Airline_model;
use App\Http\Model\province\Province_model;
?>
<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Khách sạn</label>
    </div>
    <div class="col-sm-10">
       {{Form::select('hotel_id', Hotel_model::getArrayHotel(),$model->hotel_id,['class'=>'form-control','id'=>'hotel'])}}
       
       <span class="text-red"><?= ($errors->has('hotel_id'))? $errors->first('hotel_id'):''; ?></span>
   </div>
</div>
<script type="text/javascript">
    $("#hotel").change(function(){
        getMessage('<?= route('getHotelRoom')?>');
    });
    function getMessage(urls) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {"_token": "{{ csrf_token() }}",'hotel_id':$("#hotel").find('option:selected').val()},
            type:'POST',
            url:urls,
            success:function(data) {
                if(data){
                    htm='<select class="form-control" name="hotel_room_id">';
                    jQuery.each(JSON.parse(data), function(index, item) {
                        htm+='<option value="'+index+'">'+item+'</option>';  
                    });
                   htm+='</select>';
                   $("#hotel_room").html(htm);
                }                
                else{
                
             }
            }
        });
    }

</script>
<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Phòng</label>
    </div>
    <div class="col-sm-10">
        <div id='hotel_room'>
             {{Form::select('hotel_room_id', $hotel_room,$model->hotel_room_id,['class'=>'form-control'])}}
        </div>
       
        <span class="text-red"><?= ($errors->has('hotel_room_id'))? $errors->first('hotel_room_id'):''; ?></span>
    </div>
</div>

<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Chuyến bay</label>
    </div>

    <div class="col-sm-10">
        {{Form::select('planes_from_id', Flight_model::getAllType(Flight_model::DIRECTER_GO),$model->planes_from_id,['class'=>'form-control'])}}
        <span class="text-red"><?= ($errors->has('planes_from_id'))? $errors->first('planes_from_id'):''; ?></span>
    </div>
</div>

<div class="form-group required">
    <div class="col-sm-2 control-label">
        <label>Chuyến về</label>
    </div>
    <div class="col-sm-10">
        {{Form::select('planes_to_id', Flight_model::getAllType(Flight_model::DIRECTER_BACK),$model->planes_to_id,['class'=>'form-control'])}}
        <span class="text-red"><?= ($errors->has('planes_to_id'))? $errors->first('planes_to_id'):''; ?></span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Thành phố đi</label>
    </div>
    <div class="col-sm-10">
       {{Form::select('province_from', Province_model::getArrayProvince(),$model->province_from,['class'=>'form-control'])}}
       <span class="text-red"><?= ($errors->has('province_id_from'))? $errors->first('province_id_from'):''; ?></span>
   </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Thành phố tới</label>
    </div>
    <div class="col-sm-10">
       {{Form::select('province_to', Province_model::getArrayProvince(),$model->province_to,['class'=>'form-control'])}}
       <span class="text-red"><?= ($errors->has('province_to'))? $errors->first('province_to'):''; ?></span>
   </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Địa điểm khởi hành</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('address_from_text',$model->address_from_text,['class'=>'form-control','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('name'))? $errors->first('name'):''; ?></span>
    </div>
</div>
<div class="form-group">
 <div class="col-sm-2 control-label">
    <label>Thời gian khởi hành</label>
</div>
<div class="col-sm-10">
    <div class="input-group date">

        {{ Form::text('time_start',date('H:i d/m/Y', $model->time_start),['class'=>'form-control pull-right datetimepicker','placeholder'=>"Enter ..."])}}
        
        <span class="text-red"><?= ($errors->has('time_start'))? $errors->first('time_start'):''; ?></span>
    </div>
</div>
</div>
<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Số người đã đặt hàng</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('number_order',$model->number_order,['class'=>'form-control','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('number_order'))? $errors->first('number_order'):''; ?></span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Loại combo</label>
    </div>
    <div class="col-sm-10">
       {{Form::select('type_combo', [1=>'Loại 1',2=>'Loại 2'],$model->type_combo,['class'=>'form-control'])}}
       <span class="text-red"><?= ($errors->has('type_combo'))? $errors->first('type_combo'):''; ?></span>
   </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Giá</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('price',$model->price,['class'=>'form-control number_input_price','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('price'))? $errors->first('price'):''; ?></span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Giá trẻ em</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('price_children',$model->price_children,['class'=>'form-control number_input_price','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('price_children'))? $errors->first('price_children'):''; ?></span>
    </div>
</div>



<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Loại giảm giá</label>
    </div>
    <div class="col-sm-10">
       {{Form::select('price_type', [1=>'Giá %',2=>'Giá cụ thể '],$model->price_type,['class'=>'form-control'])}}
       <span class="text-red"><?= ($errors->has('price_type'))? $errors->first('price_type'):''; ?></span>
   </div>
</div>
<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Giá</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('price_sale',$model->price_sale,['class'=>'form-control number_input_price','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('price_sale'))? $errors->first('price_sale'):''; ?></span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Giá trẻ em</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('price_sale_2',$model->price_sale_2,['class'=>'form-control number_input_price','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('price_sale_2'))? $errors->first('price_sale_2'):''; ?></span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Số lượng ngày</label>
    </div>
    <div class="col-sm-10">
       {{Form::select('time_day', range(0,20),$model->time_day,['class'=>'form-control'])}}
       <span class="text-red"><?= ($errors->has('time_day'))? $errors->first('time_day'):''; ?></span>
   </div>
</div>



<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Số lượng đêm</label>
    </div>
    <div class="col-sm-10">
       {{Form::select('time_night', range(0,20),$model->time_night,['class'=>'form-control'])}}
       <span class="text-red"><?= ($errors->has('time_night'))? $errors->first('time_night'):''; ?></span>
   </div>
</div>

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label>Thứ tự</label>
    </div>
    <div class="col-sm-10">
        {{ Form::text('order',$model->order,['class'=>'form-control','placeholder'=>"Enter ..."])}}
        <span class="text-red"><?= ($errors->has('order'))? $errors->first('order'):''; ?></span>
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
