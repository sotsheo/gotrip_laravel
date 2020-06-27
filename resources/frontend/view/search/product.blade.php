
@extends('view.view.main')
@section('title',$t)
@section("content")

<div class="wapper hidden-main" id="main">
		@include('view/modules/banner/view_18')
		<div class="product-page">
			<div class="shadow-open-filter"></div>
            <div class="container">
                 @if(strlen($t)>=2)
                    <p>Kết quả cho tìm kiếm  '{{$t}}' là: {{count($product)}} sản phẩm</p>
                    @else
                        <p style="color: red">{{$t}}</p>
                    @endif
                <div class="row mar-10">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pad-10">
                        <div class="filter-review-detail">
                            <div class="title-categories-page">
                                <h3>
                                    Tất cả sản phẩm
                                </h3>
                            </div>
                            <div class="filter-review filter-list-product">
                            	<div class="btn-show-filter">
                            		Bộ lọc sản phẩm
                            	</div>
                                <select>
                                    <option selected="" value="default">Sắp xếp theo</option>
                                    <option value="alpha-asc">A → Z</option>
                                    <option value="alpha-desc">Z → A</option>
                                    <option value="price-asc">Giá tăng dần</option>
                                    <option value="price-desc">Giá giảm dần</option>
                                    <option value="created-desc">Hàng mới nhất</option>
                                    <option value="created-asc">Hàng cũ nhất</option>
                                </select>
                                <select>
                                    <option selected="" value="default">Hiển thị 16 sản phẩm</option>
                                    <option value="alpha-asc">Hiển thị 8 sản phẩm</option>
                                </select>
                            </div>
                        </div>
                        <div class="list-product-categories">
                        	<div class="row multi-columns-row">
                        		@if(count($product)>0)
	                        		@foreach($product as $p)
			                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
			                                <div class="item-product">
												<div class="img">
													<a href="<?=url($p->link).$p->id?>">
														<img class="hover-img" src="<?=url($p->img)?>" alt="{{$p->name}}">
													</a>
												</div>
												<div class="title">
													<h3>
														<a href="<?=url($p->link).$p->id?>">{{ str_limit($p->name,30,'...') }}</a>
													</h3>
													<p class="price"><?=number_format($p->price ,0 ,'.' ,'.').' Đ'?> 
                                                        @if($p->price_market)
                                                        <span><?=number_format($p->price_market ,0 ,'.' ,'.').' Đ'?></span>
                                                         </p>
                                                        @endif
												</div>
											</div>
			                            </div>
		                            @endforeach
		                         @endif 
                        	</div>
                           @include('model.paginate.view',['paginator'=>$product])
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
@endsection