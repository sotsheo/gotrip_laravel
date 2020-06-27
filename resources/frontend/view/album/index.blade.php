
@extends('view.view.main')
@section('title','Album')
@section("content")

<div class="wapper hidden-main" id="main">
	<?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view_in',22);?>
	
	<!-- banner support -->
	<?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view_support',13);?>


	<!-- banner đối tác -->
	<?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view_patter',14);?>
</div>
@endsection