
@extends('view.view.main')
@section('title',$introduct->name)
@section("content")


<div class="page-news">
	<?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view_in',22);?>
			<div class="detail-news">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="box-detail">
								<h1>
									<?= $introduct->name?>
								</h1>
								<div class="sort-desc">
									<?= $introduct->short_description?>
								</div>
								<div class="content-standard-ck">
									<?= $introduct->description?>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
@endsection