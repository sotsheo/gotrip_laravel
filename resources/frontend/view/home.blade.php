@extends('view/main')
@section('title',$w->name)
@section('content')
<div class="section1">
	<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view_main',2);?>
	
	<div class="search-trip">
		<div class="flex-center">
			<div class="container">
				<!-- slogan -->
				<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view_slogan',3);?>
				
				<div class="tool-search-trip">
					<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view',12);?>
				
				</div>
			</div>
		</div>
	</div>
</div>
<div class="note-section-index">
	<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view_slogan',4);?>
</div>
<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view_camket',5);?>
<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view_dd',6);?>
<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view',7);?>
@stop