 
<?php
// get tất cả các hãng sản xuất có trong danh mục đó
use App\Http\Controllers\Admin\Product_controller;
$data =Product_controller::get_manufaturer(url()->current()); 
?>
@if(count($data)>0)
 <select id="sortmanufacturer">
 	<option selected="" value="0" hrefs="<?= $sortmanufacturer;?>" >Lọc theo hãng sản xuất</option>
 	@foreach($data as $m)
 		<option  value="0" hrefs="<?php echo($sortmanufacturer .'&sortmanufacturer='.$m->id)?>">{{ $m->name }}</option>
 	@endforeach
 </select>
<script type="text/javascript">
	$(document).ready(function(){
		$("#sortmanufacturer").change(function(){
			window.location.href=$(this).children("option:selected").attr('hrefs');

		});
	});
</script>
@endif
