<div class="col-lg-12 ">
	<div class="col-lg-12 ">
		
			<a class="btn btn-success pull-right" href="{{ url('admin/combo/time/create/') }}<?php echo('/'.$model->id); ?>">Thêm mới</a>
		
	</div>
	<?php if($combotime){ ?>
		<?php foreach ($combotime as $key => $value) {?>
			<div class="col-lg-4 ">
				<section class="panel panel-default">
					<header class="panel-heading">
						<span class="pull-right">

							<a href="{{ url('admin/combo/time/update') }}<?php echo('/'.$value->id); ?>" target="_blank"><i class="fa fa-pencil icon-muted fa-fw m-r-xs"></i></a>

							<a href="{{ url('admin/combo/time/delete') }}<?php echo('/'.$value->id); ?>" target="_blank"><i class="fa fa-times icon-muted fa-fw"></i></a>                  
						</span>
						{{date('H:s d/m/Y',$value['time_start'])}}
					</header>
					<div class="box-body">
						<table class="table table-striped m-b-none">
							<thead>
								<tr>
									<th>Thời gian xuất phát</th>
									<th>Giá</th>                    
									
								</tr>
							</thead>
							<tbody>
								<tr>                    
									<td>
										{{date('H:s d/m/Y',$value['time_start'])}}
									</td>
									<td>{{number_format($value['price'])}}</td>
									
								</tr>

							</tbody>
						</table>
					</div>
				</section>
			</div>
		<?php } ?>
	<?php } ?>
</div>
