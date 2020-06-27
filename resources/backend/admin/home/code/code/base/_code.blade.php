 <div class="box-body" >
 	<table class="table table-striped m-b-none">
 		<thead>
 			<tr>
 				
 				<th>Mã code</th>
 				<th>Thời gian dùng</th>

 				<th>Đơn hàng xử dụng</th>
 			</tr>
 		</thead>
 		<tbody>
 			<?php foreach ($code_item as $key ):?>
 				<tr>
 					
 					<td>{{ $key->key }}</td>
 					
 					<td>{{ ($key->use_time)?date('H:s d/m/Y',$key->use_time):'Chưa xử dụng' }}</td>
 					<td></td>
 				</tr>
 			<?php endforeach;?>
 		</tbody>

 	</table>


 </div>