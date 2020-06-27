<div class="form-group ">
    <div class="col-sm-2 control-label">
        <label>Meta keywords</label>
    </div>
    <div class="col-sm-10">
        {{Form::textarea('meta_keywords', $model->meta_keywords,['class'=>'form-control'])}}

        <span class="text-red"><?= ($errors->has('meta_keywords'))? $errors->first('meta_keywords'):''; ?></span>
    </div>
</div>
<div class="form-group ">
    <div class="col-sm-2 control-label">
        <label>Meta description</label>
    </div>
    <div class="col-sm-10">
        {{Form::textarea('meta_description', $model->meta_description,['class'=>'form-control'])}}

        <span class="text-red"><?= ($errors->has('meta_description'))? $errors->first('meta_description'):''; ?></span>
    </div>

</div>
<div class="form-group ">
    <div class="col-sm-2 control-label">
        <label>Meta title</label>
    </div>
    <div class="col-sm-10">
            {{Form::textarea('meta_title', $model->meta_title,['class'=>'form-control'])}}
        <span class="text-red"><?= ($errors->has('meta_title'))? $errors->first('meta_title'):''; ?></span>
    </div>
</div>
