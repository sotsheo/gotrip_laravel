<form role="form" action="{{$route}}"   method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row group_sp">
        <div class="col-xs-3">
            <select class="form-control " id='select_form'>
                <option value="0">Lựa chọn support</option>
                @foreach($type_support as $key)
                    <option value="{{$key->id}}" name='name'>{{$key->name}}</option>
                @endforeach
            </select>
        </div>
        <?php $i=0?>
        @foreach($support as $sp)
            <?php $i++ ?>
            @foreach($type_support as $type)
                @if($type->id==$sp->id_type)
                    <div class='item_sp'>
                        <div class='col-xs-3'>
                            <input type='text' class='form-control'  name='item_type_{{ $i}}' value='{{ $type->name }}'></div>
                        <div class='col-xs-4'>
                            <input type='text' class='form-control'  name='item_name_{{ $i}}' value="{{ $sp->name }}">
                        </div>
                        <div class='col-xs-4'> <input type='text' class='form-control' name='item_link_{{ $i}}' value="{{ $sp->link }}">
                            <input type='text' class='form-control' name='item_type_id_{{ $i}}' style='display:none' value='{{ $sp->id_type }}'>
                        </div>
                        <div class='col-xs-1'><a href="{{ url('admin/support/delete') }}<?php echo('/'.$sp->id); ?>"><i class='fa fa-window-close' aria-hidden='true'></i></a>
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>
    <input type="number" name="count" value="0" style="display: none;" id="count">
    <button type="button" class="btn btn-block btn-info" id='add_item'>Thêm support</button>
    <button type="submit" class="btn btn-success pull-right"><i class="fa  fa-plus-circle"></i> {{$name}}<i></i>
    </button>

</form>