@extends('view.main')
@section('title',$news->name)
@section("content")
<div class="wapper hidden-main" id="main">
<?php

use App\Http\Controllers\Admin\News_controller;
$lienquan=News_controller::getRelatedPosts($news->id_category,$news->id,5);
?>
@include ('model/widget/view',['id'=>18])

<div class="page-news">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
						<div class="detail-news">
							<h1>
								{{$news->name}}
							</h1>
							<div class="time">
								<span><i class="fa fa-clock-o"></i> {{ date('d-m-Y', $news->date_public) }}</span>
								<span>|</span>
								<span><i class="fa fa-user-circle"></i> Nguyen huy</span>
							</div>
							<div class="sort-desc">
								<?=$news->short_description?>
							</div>
							<div class="content-detail content-standard-ck">
								<?=$news->description?>
							</div>
							<div class="tag-line">
								<div class="tag">
									<div class="hastag">
										<div class="tags"><i class="fa fa-tags" aria-hidden="true"></i>Tags</div>    
										<div class="tags_product">
											<a class="tag_title" title="" href="">thiết kế website</a>
											<a class="tag_title" title="" href="">chuyên nghiệp</a>
										</div>
									</div>
								</div>
								<div class="support-line">
									<p>
										Chia sẻ bài viết trên:
										<a href=""><i class="fa fa-facebook"></i></a>
										<a href=""><i class="fa fa-twitter"></i></a>
										<a href=""><i class="fa fa-instagram"></i></a>
									</p>
								</div>
							</div>
							@if(count($lienquan)>0)
							<div class="news-related">
								<div class="title-box">
									<h2>
										Tin tức liên quan
									</h2>
								</div>
								<div class="row">
									<div class="slide-news-related">
										<?php
											foreach($lienquan as $n){
										?>
											<div class="item-news">
												<div class="img">
													<a href=""><img  class="hover-img" src="<?= url($n->img)?>" alt=""></a>
												</div>
												<div class="title">
													<h3>
														<a href="{{ url($n->link) }}<?php echo($n->id); ?>">
															<?=$n->description?>
														</a>
													</h3>
													<div class="time">
														<span><i class="fa fa-clock-o"></i> 01/12/2018</span>
														<span>|</span>
														<span><i class="fa fa-user-circle"></i> Nguyen huy</span>
													</div>
													<?=$news->short_description?>
													<div class="button-style hascolor">
														<a href="{{ url($n->link) }}<?php echo($n->id); ?>">Xem chi tiết</a>
													</div>
												</div>
											</div>
										<?php }?>
									</div>
								</div>
							</div>
							@endif
						</div>
					</div>
					@include ('model/widget/view',['id'=>19])
				</div>
			</div>
		</div>
</div>
@endsection
