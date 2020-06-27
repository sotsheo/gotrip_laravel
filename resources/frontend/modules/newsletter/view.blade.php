

@include('modules.flase.view')
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="newsletter">
		<h2>
			<?= $widget->name?>
		</h2>
		<p>
			<?= $widget->text_head?>
		</p>
		<form  class="contact_email" role="form" action="{{route('send')}}"   method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}
			<?php $errors=Session::has('validateNewsLetter')?Session::get('validateNewsLetter'):''; ?>
			<input type="text" placeholder="Nhập e-mail của bạn" id="email" type="email" maxlength="100" value="" name="email">
			<span class="text-red"><?= ($errors && $errors->has('email'))? $errors->first('email'):''; ?></span>
			<input type="submit" value="ĐĂNG KÝ">
		</form>

	</div>
</div>