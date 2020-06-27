<div class="box-chat-product" id="chat">
	<div class="title-box">
		<h2>
			Hỏi đáp về sản phẩm
		</h2>
	</div>
	<form method="POST" action="product/<?=$id?>" >
		{{ csrf_field() }}
		<?php $errors=Session::has('validateRatting')?Session::get('validateRatting'):''; ?>
		<?php $model=Session::has('productRating')?Session::get('productRating'):$productrating; ?>
		<input  class="form-control" type="text" name="name" placeholder="Tên của bạn..." value="{{$model->name}}">
		 <span class="text-red"><?= ($errors && $errors->has('name'))? $errors->first('name'):''; ?></span>
		<input class="form-control" type="text" name="phone" placeholder="Số điện thoại ..." value="{{$model->phone}}">
		 <span class="text-red"><?= ($errors && $errors->has('phone'))? $errors->first('phone'):''; ?></span>
		<input class="form-control" type="text" name="email" placeholder="Email.." value="{{$model->email}}">
		 <span class="text-red"><?= ($errors && $errors->has('email'))? $errors->first('email'):''; ?></span>
		<input class="form-control" type="text" name="address" placeholder="Địa chỉ của bạn..." value="{{$model->address}}">
		 <span class="text-red"><?= ($errors && $errors->has('address'))? $errors->first('address'):''; ?></span>
		<textarea name="content" id="" cols="30" rows="10" placeholder="Mời bạn để lại đánh giá..." value="{{$model->content}}"></textarea>
		 <span class="text-red"><?= ($errors && $errors->has('content'))? $errors->first('content'):''; ?></span>
		<button type="submit">GỬI</button>
	</form>
</div>
<style type="text/css">
	.box-chat-product input{
		margin-bottom: 15px;
	}
	.box-chat-product input,.box-chat-product span{
		float: left;
		width: 100%;
	}
</style>