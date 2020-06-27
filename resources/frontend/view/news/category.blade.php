
@extends('view.view.main')
@section('title',$category->name)
@section("content")
<div class="wapper hidden-main" id="main">
	<?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view_in',22);?>
	<div class="product-page">
		<div class="container">
			<div class="section05">
				<div class="title-standard center">
					<h2>
						<?= $category->name?>
					</h2>
					
				</div>
				<div class="list-news-index list-news">
					<div class="row multi-columns-row">
						<?php foreach($news as $new){?>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="item-news">
									<div class="img-item-news">
										<a href="{{url($new->link)}}">
											<img src="{{url($new->img_path.'/400x400/'.$new->img_name)}}" 
											alt="{{$new->name}}">
										</a>
										<div class="timeline">
											<p>
												<span><i class="fa fa-clock-o"></i>  {{date('d-m-Y', $new->date_public)}}</span>
												<span><i class="fa fa-user-circle"></i> Đăng bởi: Admin</span>
												<span><i class="fa fa-comment-o"></i> {{$new->viewed}}</span>
											</p>
										</div>
									</div>
									<div class="title-item-news">
										<h3>
											<a href="{{url($new->link)}}">{{ $new->name}}</a>
										</h3>
										<p>
											{{$new->short_description}}
										</p>
										
									</div>
								</div>
							</div>
						<?php }?>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection