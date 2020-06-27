
<table style="width:900px;max-width: 100%;">
	<tr style="background: #f3f3f3;border-bottom: #ccc 1px solid;">
		<th style="width:150px;padding:5px; color: #505050;">Tên khách hàng</th>
		<th style="padding:5px;color: #505050;">Email</th>
		<th style="padding:5px;color: #505050;">Số điện thoại</th>
		<th style="padding:5px;color: #505050;">Nội dung</th>
		<th style="padding:5px;color: #505050;">Link</th>
	</tr>

	<tr>
		<td style="padding:5px;color: #505050;"><?= $model->name?></td>
		<td style="padding:5px;color: #505050;"><?= $model->email?></td>
		<td style="padding:5px;color: #505050;"><a href="tel:<?= $model->phone?>" target="_blank"><?= $model->phone?></a></td>
		<td style="padding:5px;color: #505050;"><?= $model->content?></td>
		<td style="padding:5px;color: #505050;"><a href="{{ url('admin/cart/update/') }}<?= '/'.$model->id?>">Link</a></td>
	</tr>
</table>