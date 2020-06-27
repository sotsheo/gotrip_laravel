

<select id='pagesize'>
	<option  hrefs="<?= $pagesize?>">Số sản phẩm hiển thị</option>
	<option  value="16"  hrefs="<?= $pagesize.'?pagesize=16'?>">Hiển thị 16 sản phẩm</option>
	<option value="8"  hrefs="<?= $pagesize.'?pagesize=8'?>">Hiển thị 8 sản phẩm</option>
</select>


<script type="text/javascript">
	$(document).ready(function(){
		$("#pagesize").change(function(){
			window.location.href=$(this).children("option:selected").attr('hrefs');

		});
	});
</script>