
    <div class="group_input">
        <h4 class="group_title">Thông tin</h4>
        <div class="content_p">
            <div class="form-group ">
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
                    <label>Số lượng</label>
                </div>
                <div class="col-sm-10">
                    {{ Form::text('number',$model->number,['class'=>'form-control','placeholder'=>"Enter ..."])}}
                
                <span class="text-red"><?= ($errors->has('number'))? $errors->first('number'):''; ?></span>
                </div>
            </div>
            

             <div class="form-group ">
                <div class="col-sm-2 control-label">
                     <label>Vị trí</label>
                </div>
                <div class="col-sm-10">
                    {{Form::textarea('stand', $model->stand,['class'=>'form-control'])}}
                
                    <span class="text-red"><?= ($errors->has('stand'))? $errors->first('stand'):''; ?></span>
                </div>
            </div>

           <div class="form-group ">
                <div class="col-sm-2 control-label">
                      <label>Yêu cầu</label>
                </div>
                <div class="col-sm-10">
                    {{Form::textarea('short_description', $model->short_description,['class'=>'form-control'])}}
                
                    <span class="text-red"><?= ($errors->has('stand'))? $errors->first('stand'):''; ?></span>
                </div>
            </div>

           <div class="form-group ">
                <div class="col-sm-2 control-label">
                       <label>Công việc </label>
                </div>
                <div class="col-sm-10">
                   {{Form::textarea('task', $model->task,['class'=>'form-control'])}}
                
                    <span class="text-red"><?= ($errors->has('stand'))? $errors->first('stand'):''; ?></span>
                </div>
            </div>

            <div class="form-group ">
                <div class="col-sm-2 control-label">
                    <label>Chính sách  </label>
                </div>
                <div class="col-sm-10">
                   {{Form::textarea('description', $model->description,['class'=>'form-control'])}}
                    <span class="text-red"><?= ($errors->has('stand'))? $errors->first('stand'):''; ?></span>
                </div>
            </div>

            <div class="form-group ">
                <div class="col-sm-2 control-label">
                    <label>Lương</label>
                </div>
                <div class="col-sm-10">
                   {{Form::select('satus_salary', [0=>'Thương lượng ',1=>'Cụ thể'],$model->satus_salary,['class'=>'form-control'])}}
                    <span class="text-red"><?= ($errors->has('stand'))? $errors->first('stand'):''; ?></span>
                </div>
            </div>
           
            <div class="form-group ">
                <div class="col-sm-2 control-label">
                      <label for="exampleInputFile">Hình ảnh</label>
                </div>
                <div class="col-sm-10">
                    <input type="file" class="filestyle" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline input-s"  name="img" value="{{ $model->img }}">
                    <?php if($model->img_root){ ?>
                    <img src="<?= url($model->img_root)?>" style="max-height: 150px;">
                    <?php }?>
                </div>
            </div>

           <div class="form-group ">
                <div class="col-sm-2 control-label">
                     <label>Trạng thái</label>
                </div>
                <div class="col-sm-10">
                     {{Form::select('state', [1=>'Hiện thị',0=>'Thương lượng '],$model->state,['class'=>'form-control'])}}
                </div>
            </div>

            <div class="form-group ">
                <div class="col-sm-2 control-label">
                     <label>Thứ tự</label>
                </div>
                <div class="col-sm-10">
                    {{ Form::text('orders',$model->orders,['class'=>'form-control','placeholder'=>"Enter ..."])}}
                </div>
            </div>

            <div class="form-group ">
                <div class="col-sm-2 control-label">
                    <label>Ngày bắt đầu</label>
                </div>
                <div class="col-sm-10">
                    
                  
                    {{ Form::text('time_start',date('d/m/Y', $model->time_start),['class'=>'form-control pull-right datetimepicker','placeholder'=>"Enter ..."])}}
                </div>
            </div>

            <div class="form-group ">
                <div class="col-sm-2 control-label">
                    <label>Ngày kết thúc</label>
                </div>
                <div class="col-sm-10">
                     
                    {{ Form::text('time_deadline',date('d/m/Y', $model->time_deadline),['class'=>'form-control pull-right datetimepicker','placeholder'=>"Enter ..."])}}
                </div>
            </div>

            
           
           

        </div>
    </div>

    <div class="group_input">
        <h4 class="group_title">Liên hệ</h4>
        <div class="content_p">
        <div class="form-group ">
                <div class="col-sm-2 control-label">
                    <label>Liên hệ với</label>
                </div>
                <div class="col-sm-10">
                     {{ Form::text('contact',$model->contact,['class'=>'form-control','placeholder'=>"Enter ..."])}}
                <span class="text-red"><?= ($errors->has('contact'))? $errors->first('contact'):''; ?></span>
                </div>
            </div>
        <div class="form-group ">
                <div class="col-sm-2 control-label">
                    <label>Email liên hệ</label>
                </div>
                <div class="col-sm-10">
                     {{ Form::text('email',$model->email,['class'=>'form-control','placeholder'=>"Enter ..."])}}
                <span class="text-red"><?= ($errors->has('email'))? $errors->first('email'):''; ?></span>
                </div>
            </div>
        <div class="form-group ">
                <div class="col-sm-2 control-label">
                    <label>Phone liên hệ</label>
                </div>
                <div class="col-sm-10">
                     {{ Form::text('phone',$model->phone,['class'=>'form-control','placeholder'=>"Enter ..."])}}
                <span class="text-red"><?= ($errors->has('email'))? $errors->first('email'):''; ?></span>
                </div>
            </div>
        <div class="form-group ">
                <div class="col-sm-2 control-label">
                    <label>Địa chỉ phỏng vấn</label>
                </div>
                <div class="col-sm-10">
                    {{ Form::text('address',$model->address,['class'=>'form-control','placeholder'=>"Enter ..."])}}
                <span class="text-red"><?= ($errors->has('email'))? $errors->first('email'):''; ?></span>
                </div>
        </div>
        
    </div>
</div>
