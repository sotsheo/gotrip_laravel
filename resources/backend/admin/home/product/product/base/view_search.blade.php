<?php if(count($products)){ ?>
<table class="table table-bordered add_product">
	<tr>
		<th style="width: 10px">#</th>
		<th>Tên</th>
		<th>Hình ảnh</th>
		<th></th>
	</tr>
	<?php $i=0;foreach($products as $p){$i++;?>
		<tr class='item_product' id='id_{{$p->id}}'>
			<th style='width: 10px'>#</th>
			<td>{{$p->name}}</td>
			<td><img src="<?=url($p->img_path.'/200x200/'.$p->img_name)?>" alt="<?= $p->name?>" width="50px"></td>
			<td><a  data_id='{{$p->id}}' data_name='{{$p->name}}' data_cate='{{$p->name_product}}' id_class='id_{{$p->id}}' href=""><span class='badge bg-red'><i class='fa fa-fw fa-share'></span></i></a></td>
		</tr>
	<?php  }?>
</table>
<?php }else{ ?>
	<p>Không tìm thấy sản phẩm nào </p>
<?php } ?>