<?php if(count($news)){ ?>
<table class="table table-bordered add_news">
	<tr>
		<th style="width: 10px">#</th>
		<th>Tên</th>
		<th>Hình ảnh</th>
		<th></th>
	</tr>
	<?php
	$i=0;
	foreach($news as $p){
		$i++;

		?>
		<tr class='item_news' id='id_news{{$p->id}}'>
			<th style='width: 10px'>#</th>
			<td>{{$p->name}}</td>
			<td><img src="<?=url($p->img_path.'/200x200/'.$p->img_name)?>" alt="<?= $p->name?>" width="50px"></td>
			<td><a  data_id='{{$p->id}}' data_name='{{$p->name}}' data_cate='{{$p->name_product}}' id_news='id_news{{$p->id}}'><span class='badge bg-red'><i class='fa fa-fw fa-share'></span></i></a></td>
		</tr>
	<?php  }?>
</table>
<?php }else{ ?>
	<p>Không tìm thấy bài viết nào </p>
<?php } ?>