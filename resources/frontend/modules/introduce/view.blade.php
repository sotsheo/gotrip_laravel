<div class="video-intro-index">
	<div class="container">
		<div class="left-intro">
			<div class="title-standard">
				<h2><?= $data->name?></h2>
			</div>
			<p>
				<?= $data->short_description?>
			</p>
			<div class="button-style">
				<a href="">Xem thêm</a>
			</div>
		</div>
		<?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view',5);?>
	</div>
</div>