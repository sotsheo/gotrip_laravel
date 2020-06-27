

<div class="form-group">
    <div class="col-sm-2 control-label">
        <label for="exampleInputFile">Hình ảnh </label>
    </div>
    <div class="col-sm-10">
        <input type="file"  name="attachment[]"  multiple class="filestyle" id="uploadfile" data-classButton="btn btn-default" data-classInput="form-control inline input-s" >
        <div id="sortable">
            <?php
            if(isset($images) && $images){
                foreach($images as $item){
                    ?>
                    <div style="float: left;margin-right: 10px;margin-top: 10px;" class="img_list">
                        <div class="contents">
                            <img src="<?= $item['path'].'/200x200/'.$item['name']?>"  class="img-thumbnail" style='height: 250px;width: 250px;'>
                            <button type="button" class="btn btn-block btn-danger" id="<?= $item['id']?>" data="<?= $item['id']?>"><i class="fa fa-fw fa-close"  >  </i></button>
                        </div>

                    </div>
                <?php }?>
            <?php }?>
        </div>

    </div>
</div>

<style>
    #sortable{
        width: 100%;
        float:left;
    }
    .img_list button {
        z-index: 99999 !important;
    }
    .img_list button i {
        z-index: 99999 !important;
    }
</style>

<script>
    $(document).ready(function(){
        $("#uploadfile").change(function(){
            // var formData = new FormData(this);
            var files = document.getElementById("uploadfile").files;
            if(files[0].name){
                  $('.full').addClass("active");
                upload(this);
            }
        });


        function removeImg(id) {
            var form_data = new FormData();
            form_data.append('id', id);
            form_data.append('_token', '{{csrf_token()}}');
            $('#loading').css('display', 'block');
            $.ajax({
                url: "{{route('removeImagesCombo')}}",
                data: form_data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data) {console.log(data)}
                        removes();
                    readloadaction();
                },
                error: function (xhr, status, error) {

                }
            });

        }
        function upload(img) {
            var form_data = new FormData();
            for (var i = 0; i < img.files.length; i++)
            {
                form_data.append('file'+i, img.files[i]);
            }
            form_data.append('id', <?=$model->id?>);
            form_data.append('file', img.files[0]);
            form_data.append('count', img.files.length);
            form_data.append('_token', '{{csrf_token()}}');
            $('#loading').css('display', 'block');
            $.ajax({
                url: "{{route('uploadImagesCombo')}}",
                data: form_data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data) {

                        jQuery.each(JSON.parse(data), function(index, item) {
                            htm="<div style='float: left;margin-right: 10px;margin-top: 10px;' class='img_list'>";
                            htm+="<img src='"+item['img_path']+'/200x200/'+item['img_name']+"'  class='img-thumbnail' style='height: 250px;width: 250px;'>";
                            htm+="<button type='button' class='btn btn-block btn-danger' ><i class='fa fa-fw fa-close' data='"+item['id']+"'></i></button>";
                            htm+="</div>";
                            $("#sortable").append(htm);
                            removes();
                            readloadaction();
                        });
                        $('.full').removeClass("active");

                    }
                },
                error: function (xhr, status, error) {

                }
            });
        }
        removes();
        readloadaction();
        function removes(){
            $(".img_list button").each(function(index){
                var id= $(this).attr('data');
                var ids= '#'+id;
                $(ids).click(function(){
                    var id= $(this).attr('data');
                    if(id){
                        removeImg(id);
                    }
                });
            });
        }

        function readloadaction(){
            $(".img_list button").each(function () {
                $(this).click(function () {
                    removes();
                    var str = $("#text_f").val();
                    $("#text_f").val(str);
                    if($("#text_f").val()==' '){
                        $("#text_f").val('');
                    }
                    $(this).parent().remove();
                });
            });
        }
    });
</script>