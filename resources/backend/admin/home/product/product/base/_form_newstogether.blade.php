 <div class="col-md-6">
 	<div class="box">
 		<div class="search_target form-group " style="border: 0px;">
			<div class="searchs" style="display: flex;width: 350px;max-width: 100%" >
				<div class="">
					 <input type="text"  class=" form-control input_news_search" placeholder="Nhập tên bài viết..." width="90%">
				</div>
				<button class="btn btn-success btn_news_search" style="width: 10%"><i class="fa fa-search icon-search"></i></button>
				
			</div>
			
		</div>
 		<div class="box-body list_news_add">
 			<table class="table table-bordered add_news">
 				<tr>
 					<th style="width: 10px">#</th>
 					<th>Tên</th>
 					<th>Hình ảnh</th>
 					<th></th>
 				</tr>
 				<?php $i=0;foreach($news_out as $p){ $i++;?>
 					<tr class='item_news' id='id_news{{$p->id}}'>
 						<th style='width: 10px'>#</th>
 						<td>{{$p->name}}</td>
 						<td><img src="<?=url($p->img_path.'/200x200/'.$p->img_name)?>" alt="<?= $p->name?>" width="50px"></td>
 						<td><a  data_id='{{$p->id}}' data_name='{{$p->name}}' data_cate='{{$p->name_product}}' id_news='id_news{{$p->id}}'><span class='badge bg-red'><i class='fa fa-fw fa-share'></span></i></a></td>
 					</tr>
 				<?php  }?>
 			</table>
 		</div>
 	</div>
 </div>
 <div class="col-md-6">
 	<div class="box">
 		<div class="box-body">
 			<table class="table table-bordered remove_news">
 				<tr>
 					<th style="width: 10px">#</th>
 					<th>Tên</th>
 					<th>Hình ảnh</th>
 					<th></th>
 				</tr>
 				<?php
 				foreach($news_int as $p){
 					$i++;
 					?>
 					<tr class='item_news' id='id_news{{$p->id}}'>
 						<th style='width: 10px'>#</th>
 						<td>{{$p->name}}</td>
 						<td><img src="<?=url($p->img_path.'/200x200/'.$p->img_name)?>" alt="<?= $p->name?>" width="50px"></td>
 						<td><a  data_id='{{$p->id}}' data_name='{{$p->name}}' data_cate='{{$p->name_product}}' id_news='id_news{{$p->id}}'><span class='badge bg-red'><i class='fa fa-fw fa-trash-o'></i></span></a></td>
 					</tr>
 				<?php }?>
 			</table>
 		</div>
 	</div>
 </div>
 <script>              

 	$(".box-body form .btn-success").click(function(){
 		var check=0;
 		$(".form-group.required").each(function(){
 			if($(this).children("input").val()==''){
 				$(this).children(".text-red").text("Trường thông tin này không được để trống");
 				check=1;
 			}
 		});
 		$(".form-group.required_a").each(function(){
 			if(!$(this).children("textarea").val()){
 				$(this).children(".text-red").text("Trường thông tin này không được để trống");
 				check=1;
 			}
 		});

 		$(".form-group.select_a").each(function(){
 			if($(this).children("select").val()==0){
 				$(this).children(".text-red").text("Trường thông tin này không được để trống");
 				check=1;
 			}
 		});
 		if(check==1){
 			return false;
 		}
 	});
 	$(".img_list button").each(function(){

 		$(this).click(function(){
 			var str=$("#text_f").val();
 			str=str.replace($(this).attr("data"), "");
 			$("#text_f").val(str);
 			$(this).parent().remove();
 		});
 	});
 	var check=0;
 	click_add_news();
 	click_close_news();
 	$(".btn_news_search").click(function(){
 		search_news($(".input_news_search").val(),'.list_news_add');

 		return false;
 	});
 	function search_news(name,datas) {
 		$.ajax({
 			type:'POST',
 			url:"<?= route('getNewsTogether')?>",
 			data: {
 				name: name,
 				"_token": "{{ csrf_token() }}",
 			},
 			success:function(data) {
 				if(data.code==200){
 					$(datas).html(data.messages);
 					click_add_news();
 				}
 			}
 		});
 	}
 	function click_add_news(){
 		$(".add_news .item_news a").each(function(index){
 			$(this).click(function(){
 				getNews($(this).attr('data_id'),'add');
 				var classid=$(this).attr("id_news");
 				var html=$("#"+classid+"").html();
 				console.log($(this).attr("id_news"));
 				$(".remove_news").append("<tr class='item_news' id='"+$(this).attr("id_news")+"'>"+html+"</tr>");
 				$("#"+classid+"").remove();
 				click_close_news();
 				return false;
 			}); 
 		});
 	}

 	function click_close_news(){
 		$(".remove_news .item_news a").each(function(index){
 			$(this).click(function(){
 				getNews($(this).attr('data_id'),'delete');
 				var classid=$(this).attr("id_news");
 				$("#"+classid+"").remove();
 				click_add_news();
 				return false;
 			}); 
 		});
 	}
 	function getNews(id_news,type) {
 		$.ajax({
 			
 			type:'POST',
 			url:"<?= route('addnewsTogether')?>",
 			data: {
 				
 				id_news:id_news,
 				id:"<?= $model->id?>",
 				type:type,
 				"_token": "{{ csrf_token() }}",
 			},
 			success:function(data) {
 				console.log(data);
 			}
 		});
 	}

 </script>