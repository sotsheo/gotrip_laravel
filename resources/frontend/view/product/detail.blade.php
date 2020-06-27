
@extends('view.main')
@section('title',$product->name)
@section("content")
<div class="product-page">
	<div class="page-product-detail">
		<div class="container">
			@include('modules/breadcrumbs/view')
			<div class="pad-white" style="margin-bottom: 15px;">
				<div class="detail-product-box">
					<div class="title-detail-product">
						<h1>
							<?=$product->name?>
						</h1>

						<div class="star-review">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<a href="">(Xem <?=$product->number_ratting?> đánh giá)</a>
						</div>
					</div>
					<div class="img-detail-product">
						<div class="app-figure" id="zoom-fig">
							<div class="big-img">
								<a id="Zoom-1" class="MagicZoom" data-options="selectorTrigger: click; transitionEffect: false;zoomDistance: 20;zoomWidth:520px; zoomHeight:500px;variableZoom: true" title="Show your product in stunning detail with Magic Zoom Plus." href="images/detail-product.jpg" >
									<img src="" alt=""/>
								</a>
							</div>
							<div class="thumb-img">
								<div id="owl-detail" class="selectors">
									@if($images){ 
										@foreach($images as $img) 
											<a data-zoom-id="Zoom-1" href="{{url($img->img_path.'/400x400/'.$img->img_name)}}" data-image="{{url($img->img_path.'/400x400/'.$img->img_name)}}" >
												<img src="{{url($img->img_path.'/400x400/'.$img->img_name)}}"/>
											</a>
										@endforeach
									@endif
								</div>
							</div>

							<!-- <div class="note-img">
								<img src="images/zoom.png" alt=""> Rê chuột lên hình để phóng to
							</div> -->
						</div>
					</div>
					<div class="infor-product">
						<div class="bottom-infor-product">
							<div class="option-infor-product">
								<div class="price-product">
									@if($product->price)
									<p>
										Giá: <b><?=number_format($product->price ,0 ,'.' ,'.').' Đ'?></b> 
										@if($product->price_market)
											<del><?=number_format($product->price_market ,0 ,'.' ,'.').' Đ'?></del>
										@endif
									</p>
									@endif
								</div>
                                        <!-- <div class="quality-product-detail">
                                            <label>Số lượng:</label>
                                            <div class=" pull-left flex-row">
                                                <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty > 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="fa fa-minus"></i></button>
                                                <input onkeypress="isAlphaNum(event);" type="text" title="Số lượng" value="1" maxlength="12" id="qty" name="quantity" class="input-text" oninput="validity.valid||(value='');">
                                                <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items-count" type="button"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div> -->

                                        <div class="sort-km-desc">
                                        	<?= $product->note?>
                                        </div>
                                        <div class="btn-buynow">
                                        	<a href="<?=url('/order/add/').'/'.$product->id?>">
                                        		<span>MUA NGAY</span>
                                        		Giao hàng tận nơi hoặc nhận tại siêu thị
                                        	</a>
                                        </div>
                                        <div class="btn-add-tocart">
                                        	<a href="">
                                        		THÊM VÀO GIỎ HÀNG <img src="images/ic-cart.png" alt="">
                                        	</a>
                                        </div>
                                        <div class="hotline-contact">
                                        	<p>
                                        		Gọi đặt mua: <a href="tel:1800.9050">1800.9050</a> (miễn phí)
                                        	</p>
                                        </div>
                                    </div>
                                    <div class="contact-store-product">
                                    	<a href="">
                                    		<img src="images/ic-map-marker.png" alt=""> Kiểm tra có hàng tại cửa hàng gần bạn ?
                                    	</a>
                                    	<div class="camket-store">
                                    		<div class="item-camket-store">
                                    			<div class="img">
                                    				<a href="">
                                    					<img src="images/unboxing.png" alt="">
                                    				</a>
                                    			</div>
                                    			<div class="title">
                                    				<p>
                                    					Trong hộp có: <a href="">cáp mang</a>, <a href="">cáp sạc</a>, <a href="">dây nối</a>, <a href="">dắc cắm</a>
                                    				</p>
                                    			</div>
                                    		</div>
                                    		<div class="item-camket-store">
                                    			<div class="img">
                                    				<a href="">
                                    					<img src="images/award.png" alt="">
                                    				</a>
                                    			</div>
                                    			<div class="title">
                                    				<p>Bảo hành chính hãng 12 tháng</p>
                                    			</div>
                                    		</div>
                                    		<div class="item-camket-store">
                                    			<div class="img">
                                    				<a href="">
                                    					<img src="images/change.png" alt="">
                                    				</a>
                                    			</div>
                                    			<div class="title">
                                    				<p>Lỗi là đổi mới trong vòng 1 tháng sử dụng  
                                    					tại các cử hàng của DSS trên toàn quốc 
                                    					<a href="">Xem chi tiết</a>
                                    				</p>
                                    			</div>
                                    		</div>
                                    	</div>
                                    	<div class="baohanh">
                                    		<a href="">Xem camera DDL thế hệ mới</a>
                                    		<p>
                                    			Giá dưới:  <b>3.000.000 đ</b>
                                    		</p>
                                    		<p>
                                    			Bảo hành tới 14 tháng
                                    		</p>
                                    	</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="phukien-buynow">
                        	<div class="title-box">
                        		<h2>
                        			Ưu đãi khi mua phụ kiện cùng Camera an ninh 
                        		</h2>
                        	</div>
                        	<div class="list-phukien">
                        		<div class="item-phukien">
                        			<div class="img">
                        				<a href="">
                        					<img src="images/phukien1.png" alt="">
                        				</a>
                        			</div>
                        			<div class="title">
                        				<h3>
                        					<a href="">Ổ cắm camera an ninh</a>
                        				</h3>
                        				<p>
                        					250.000 đ
                        				</p>
                        			</div>
                        		</div>
                        		<div class="item-phukien">
                        			<div class="img">
                        				<a href="">
                        					<img src="images/phukien2.png" alt="">
                        				</a>
                        			</div>
                        			<div class="title">
                        				<h3>
                        					<a href="">Đầu chuyển dắc cắm </a>
                        				</h3>
                        				<p>
                        					250.000 đ
                        				</p>
                        			</div>
                        		</div>
                        		<div class="item-phukien">
                        			<div class="img">
                        				<a href="">
                        					<img src="images/phukien3.png" alt="">
                        				</a>
                        			</div>
                        			<div class="title">
                        				<h3>
                        					<a href="">Điều khiển camera</a>
                        				</h3>
                        				<p>
                        					250.000 đ
                        				</p>
                        			</div>
                        			<a href="">Chọn điều khiển khác </a>
                        		</div>
                        		<div class="item-phukien">
                        			<div class="img">
                        				<a href="">
                        					<img src="images/phukien4.png" alt="">
                        				</a>
                        			</div>
                        			<div class="title">
                        				<h3>
                        					<a href="">Thẻ nhớ camera</a>
                        				</h3>
                        				<p>
                        					250.000 đ
                        				</p>
                        			</div>
                        			<a href="">Chọn thẻ nhớ khác</a>
                        		</div>
                        	</div>
                        	<div class="total-price">
                        		<p>
                        			Tổng tiền:
                        		</p>
                        		<b>
                        			1.000.000đ <del>1.100.000đ</del>
                        		</b>
                        		<div class="btn-buynow">
                        			<a href="">
                        				<span>MUA 4 SẢN PHẨM</span>
                        				Tiết kiệm 100.000 đ
                        			</a>
                        		</div>
                        	</div>
                        </div>
                    </div>
                    <div class="desc-product">
                    	<div class="left-box-side">
                    		<div class="content-desc-product">
                    			<h2>
                    				Đặc điểm nổi bật
                    			</h2>
                    			<div class="tiny-sort-desc">
                    				<p>
                    					Camera “Speed Dome Di Động” chuyên dụng, sử dụng cho những sự kiện, những khu vực không có điện, có mạng, xe tuần đường... MSB L200 của DSS
                    				</p>
                    				<img src="images/detail.jpg" alt="">
                    				<p>
                    					Camera “Speed Dome Di Động” chuyên dụng, sử dụng cho những sự kiện, những khu vực không có điện, có mạng, xe tuần đường... MSB L200 của DSS
                    				</p>
                    				<p>
                    					Camera “Speed Dome Di Động” chuyên dụng, sử dụng cho những sự kiện, những khu vực không có điện, có mạng, xe tuần đường... MSB L200 của DSS
                    				</p>
                    				<div class="btn-show-all">
                    					Đọc thêm <i class="fa fa-angle-down"></i>
                    				</div>
                    			</div>
                    			<div class="product-sample">
                    				<div class="title-box">
                    					<h2>
                    						So sánh với các sản phẩm tương tự
                    					</h2>
                    				</div>
                    				<div class="row">
                    					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 item-col-5">
                    						<div class="item-hot-product">
                    							<div class="img">
                    								<div class="sale-bel">
                    									<span>GIẢM 50%</span>
                    								</div>
                    								<a href="">
                    									<img class="hover-img" src="images/product1.png" alt="">
                    								</a>
                    							</div>
                    							<div class="title">
                    								<h2>
                    									<a href="">DH-HAC-HDBW2231EP</a>
                    								</h2>
                    								<div class="price">
                    									<p>
                    										1.650.000 đ
                    									</p>
                    									<del>2.300.000</del>
                    								</div>
                    								<div class="desc">
                    									<p>
                    										Tặng sạc dự phòng thông minh 10.000 mAh. 
                    									</p>
                    								</div>
                    							</div>
                    						</div>
                    					</div>
                    					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 item-col-5">
                    						<div class="item-hot-product">
                    							<div class="img">
                    								<div class="sale-bel">
                    									<span>GIẢM 50%</span>
                    								</div>
                    								<a href="">
                    									<img class="hover-img" src="images/product5.png" alt="">
                    								</a>
                    							</div>
                    							<div class="title">
                    								<h2>
                    									<a href="">DH-HAC-HDBW2231EP</a>
                    								</h2>
                    								<div class="price">
                    									<p>
                    										1.650.000 đ
                    									</p>
                    									<del>2.300.000</del>
                    								</div>
                    								<div class="desc">
                    									<p>
                    										Tặng sạc dự phòng thông minh 10.000 mAh. 
                    									</p>
                    								</div>
                    							</div>
                    						</div>
                    					</div>
                    					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 item-col-5">
                    						<div class="item-hot-product">
                    							<div class="img">
                    								<div class="sale-bel">
                    									<span>GIẢM 50%</span>
                    								</div>
                    								<a href="">
                    									<img class="hover-img" src="images/product2.png" alt="">
                    								</a>
                    							</div>
                    							<div class="title">
                    								<h2>
                    									<a href="">DH-HAC-HDBW2231EP</a>
                    								</h2>
                    								<div class="price">
                    									<p>
                    										1.650.000 đ
                    									</p>
                    									<del>2.300.000</del>
                    								</div>
                    								<div class="desc">
                    									<p>
                    										Tặng sạc dự phòng thông minh 10.000 mAh. 
                    									</p>
                    								</div>
                    							</div>
                    						</div>
                    					</div>
                    					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 item-col-5">
                    						<div class="item-hot-product">
                    							<div class="img">
                    								<div class="sale-bel">
                    									<span>GIẢM 50%</span>
                    								</div>
                    								<a href="">
                    									<img class="hover-img" src="images/product3.png" alt="">
                    								</a>
                    							</div>
                    							<div class="title">
                    								<h2>
                    									<a href="">DH-HAC-HDBW2231EP</a>
                    								</h2>
                    								<div class="price">
                    									<p>
                    										1.650.000 đ
                    									</p>
                    									<del>2.300.000</del>
                    								</div>
                    								<div class="desc">
                    									<p>
                    										Tặng sạc dự phòng thông minh 10.000 mAh. 
                    									</p>
                    								</div>
                    							</div>
                    						</div>
                    					</div>
                    				</div>
                    			</div>
                    		</div>
                    		<div class="ctn-review-product">
                    			<div class="title-review-detail">
                    				<h2>KHÁCH HÀNG NHẬN XÉT</h2>
                    			</div>
                    			<div class="rate-review-star">
                    				<div class="flex-rate-review">
                    					<div class="number-star">
                    						<p>
                    							Đánh Giá Trung Bình
                    						</p>
                    						<h3>
                    							3.5/5
                    						</h3>
                    						<div class="star-review">
                    							<img src="images/star.png" alt="">
                    							<img src="images/star.png" alt="">
                    							<img src="images/star.png" alt="">
                    							<img src="images/star-o.png" alt="">
                    							<img src="images/star-o.png" alt="">
                    						</div>
                    						<span>
                    							(20 nhận xét)
                    						</span>
                    					</div>
                    					<div class="process-star">
                    						<div class="cus-width">
                    							<div class="pull-left">
                    								<div class="pull-left" style="width:40px; line-height:1;">
                    									<div class="title-process">5 <img src="images/Star.png"></div>
                    								</div>
                    								<div class="pull-left" style="width:250px;;">
                    									<div class="progress">
                    										<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: 100%">
                    											<span class="sr-only">80% Complete (danger)</span>
                    										</div>
                    									</div>
                    								</div>
                    								<div class="pull-right count-review" style="margin-left:10px;">40%</div>
                    							</div>
                    							<div class="pull-left">
                    								<div class="pull-left" style="width:40px; line-height:1;">
                    									<div class="title-process">4 <img src="images/Star.png"></div>
                    								</div>
                    								<div class="pull-left" style="width:250px;;">
                    									<div class="progress">
                    										<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="4" style="width: 60%">
                    											<span class="sr-only">60% Complete (danger)</span>
                    										</div>
                    									</div>
                    								</div>
                    								<div class="pull-right count-review" style="margin-left:10px;">15%</div>
                    							</div>
                    							<div class="pull-left">
                    								<div class="pull-left" style="width:40px; line-height:1;">
                    									<div class="title-process">3 <img src="images/Star.png"></div>
                    								</div>
                    								<div class="pull-left" style="width:250px;;">
                    									<div class="progress">
                    										<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="3" style="width: 40%">
                    											<span class="sr-only">40% Complete (danger)</span>
                    										</div>
                    									</div>
                    								</div>
                    								<div class="pull-right count-review" style="margin-left:10px;">15%</div>
                    							</div>
                    							<div class="pull-left">
                    								<div class="pull-left" style="width:40px; line-height:1;">
                    									<div class="title-process">2 <img src="images/Star.png"></div>
                    								</div>
                    								<div class="pull-left" style="width:250px;;">
                    									<div class="progress">
                    										<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="2" style="width: 20%">
                    											<span class="sr-only">20% Complete (danger)</span>
                    										</div>
                    									</div>
                    								</div>
                    								<div class="pull-right count-review" style="margin-left:10px;">15%</div>
                    							</div>
                    							<div class="pull-left">
                    								<div class="pull-left" style="width:40px; line-height:1;">
                    									<div class="title-process">1 <img src="images/Star.png"></div>
                    								</div>
                    								<div class="pull-left" style="width:250px;;">
                    									<div class="progress">
                    										<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="1" style="width: 0%">
                    											<span class="sr-only">0% Complete (danger)</span>
                    										</div>
                    									</div>
                    								</div>
                    								<div class="pull-right count-review" style="margin-left:10px;">15%</div>
                    							</div>
                    						</div>
                    					</div>
                    					<div class="btn-comment">
                    						<a href="#chat">Gửi đánh giá của bạn</a>
                    					</div>
                    				</div>
                    			</div>

                                <!-- đánh giá  -->
                    			<div class="list-comment-review">
                    				<div class="item-comment-review-lv1">
                    					<div class="header-item-comment-lv1">
                    						<h3>Nguyễn Thảo</h3>
                    					</div>
                    					<div class="ctn-item-comment-lv1">
                    						<div class="ctn-cmt-review">
                    							<p>
                    								<img src="images/star.png" alt="" height="15px">
                    								<img src="images/star.png" alt="" height="15px">
                    								<img src="images/star.png" alt="" height="15px">
                    								<img src="images/star-o.png" alt="" height="15px">
                    								<img src="images/star-o.png" alt="" height="15px">
                    								Tôi rất thích sản phẩm này, chất lượng và hữu ích, các bạn nhân viên kỹ thuật hướng rất tận tình, tôi rất yên từ ngày lắp camera, mọi thứ trong nhà đều được giám sát. Khi đi làm tôi vẫn có thể theo dõi nhà mình thông qua điện 
                    								thoại,rất tiện lợi và hữu ích... Tôi cũng đã đề nghị khu phố lắp camera để giữ gìn trật tự an ninh khu vực
                    							</p>
                    						</div>
                    					</div>
                    					<div class="list-tool-cmt">
                    						<a href="">Trả lời</a>
                    						<a href=""><img src="images/like.png" alt="">Thích</a>
                    						<span class="time-comment">10/8/2016</span>
                    					</div>
                    				</div>
                    				<div class="item-comment-review-lv1">
                    					<div class="header-item-comment-lv1">
                    						<h3>Nguyễn Thảo</h3>
                    					</div>
                    					<div class="ctn-item-comment-lv1">
                    						<div class="ctn-cmt-review">
                    							<p>
                    								<img src="images/star.png" alt="" height="15px">
                    								<img src="images/star.png" alt="" height="15px">
                    								<img src="images/star.png" alt="" height="15px">
                    								<img src="images/star-o.png" alt="" height="15px">
                    								<img src="images/star-o.png" alt="" height="15px">
                    								Tôi rất thích sản phẩm này, chất lượng và hữu ích, các bạn nhân viên kỹ thuật hướng rất tận tình, tôi rất yên  <br>
                    							</p>
                    							<img src="images/whole-foods-min.jpg" alt="">
                    						</div>
                    					</div>

                    					<div class="list-tool-cmt">
                    						<a href="">Trả lời</a>
                    						<a href=""><img src="images/like.png" alt="">Thích</a>
                    						<span class="time-comment">10/8/2016</span>
                    					</div>
                    				</div>
                    				<div class="paginate-comment">
                    					<ul>
                    						<li>
                    							<a href="">1</a>
                    						</li>
                    						<li>
                    							<a href="">2</a>
                    						</li>
                    						<li>
                    							<a href="">3</a>
                    						</li>
                    						<li>
                    							<a href="">4</a>
                    						</li>
                    					</ul>
                    				</div>
                    			</div>
                                <!-- form đánh giá  -->
                    			<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view',18);?>
                    		</div>
                    	</div>
                    	<div class="right-box-side">
                    		<div class="tskt-product">
                    			<div class="title-box">
                    				<h2>
                    					Thông số kỹ thuật
                    				</h2>
                    			</div>
                    			<table>
                    				<tr>
                    					<td style="min-width: 130px">Độ phân giải:</td>
                    					<td><b>1920x1080/30fps</b>  2 MPixel cảm biến STARVIS CMOS kích thước 1/2.8” </td>
                    				</tr>
                    				<tr>
                    					<td>Chống nước:</td>
                    					<td><a href="">IP67</a></td>
                    				</tr>
                    				<tr>
                    					<td>Hỗ trợ thẻ nhớ:</td>
                    					<td>Micro SD  memory</td>
                    				</tr>
                    				<tr>
                    					<td>Hỗ trợ thẻ nhớ:</td>
                    					<td>Micro SD  memory</td>
                    				</tr>
                    				<tr>
                    					<td>Kết nối:</td>
                    					<td>Onvif 2.4 tương thích tất cả các đầu ghi camera trên thị trường</td>
                    				</tr>
                    				<tr>
                    					<td>Công nghệ hỗ trợ:</td>
                    					<td>ePoE. Chuẩn Poe(802.3af)(Class0) <br> Công nghệ “Starlight” với độ nhạy sáng cực thấp 0.001Lux/F1.0(ảnh màu) </td>
                    				</tr>
                    			</table>
                    			<div class="btn-view-infor">
                    				<a  href="javascript:void(0);" data-toggle="modal" data-target="#thongsoKythuat">Xem thông số kĩ thuật chi tiết</a>
                    			</div>
                    		</div>
                    		<div class="hot-product-right">
                    			<div class="title-box">
                    				<h2>
                    					Bài viết về camera an ninh
                    				</h2>
                    			</div>
                    			<div class="list-product-right">
                    				<div class="item-product-right">
                    					<div class="img">
                    						<a href="">
                    							<img src="images/sm-new1.jpg" alt="">
                    						</a>
                    					</div>
                    					<div class="title">
                    						<h3>
                    							<a href="">Camera an ninh dần trở thành 1 phương pháp an ninh phổ biến</a>
                    						</h3>
                    					</div>
                    				</div>
                    				<div class="item-product-right">
                    					<div class="img">
                    						<a href="">
                    							<img src="images/sm-new2.jpg" alt="">
                    						</a>
                    					</div>
                    					<div class="title">
                    						<h3>
                    							<a href="">Lắp đặt camera đúng cách, an toàn và hiệu quả</a>
                    						</h3>
                    					</div>
                    				</div>
                    				<div class="item-product-right">
                    					<div class="img">
                    						<a href="">
                    							<img src="images/sm-new3.jpg" alt="">
                    						</a>
                    					</div>
                    					<div class="title">
                    						<h3>
                    							<a href="">Camera giao thông mang lại hiệu quả trong việc xử phạt</a>
                    						</h3>
                    					</div>
                    				</div>
                    			</div>
                    		</div>
                    		<div class="hot-product-right">
                    			<div class="title-box">
                    				<h2>
                    					Hướng dẫn về camera an ninh
                    				</h2>
                    			</div>
                    			<div class="list-product-right">
                    				<div class="item-product-right">
                    					<div class="img">
                    						<a href="">
                    							<img src="images/sm-new4.jpg" alt="">
                    						</a>
                    					</div>
                    					<div class="title">
                    						<h3>
                    							<a href="">Camera an ninh dần trở thành 1 phương pháp an ninh phổ biến</a>
                    						</h3>
                    					</div>
                    				</div>
                    				<div class="item-product-right">
                    					<div class="img">
                    						<a href="">
                    							<img src="images/sm-new5.jpg" alt="">
                    						</a>
                    					</div>
                    					<div class="title">
                    						<h3>
                    							<a href="">Lắp đặt camera đúng cách, an toàn và hiệu quả</a>
                    						</h3>
                    					</div>
                    				</div>
                    				<div class="item-product-right">
                    					<div class="img">
                    						<a href="">
                    							<img src="images/sm-new6.jpg" alt="">
                    						</a>
                    					</div>
                    					<div class="title">
                    						<h3>
                    							<a href="">Camera giao thông mang lại hiệu quả trong việc xử phạt</a>
                    						</h3>
                    					</div>
                    				</div>
                    			</div>
                    		</div>
                    		<div class="hot-product-right">
                    			<div class="title-box">
                    				<h2>
                    					Phụ kiện camera
                    				</h2>
                    			</div>
                    			<div class="list-product-right">
                    				<div class="item-product-right">
                    					<div class="img">
                    						<a href="">
                    							<img src="images/product4.png" alt="">
                    						</a>
                    					</div>
                    					<div class="title">
                    						<h3>
                    							<a href="">Dây cáp camera</a>
                    						</h3>
                    						<b>
                    							680.000đ <del>-200.000đ  </del>
                    						</b>
                    					</div>
                    				</div>
                    				<div class="item-product-right">
                    					<div class="img">
                    						<a href="">
                    							<img src="images/phukien2.png" alt="">
                    						</a>
                    					</div>
                    					<div class="title">
                    						<h3>
                    							<a href="">Điều khiển từ xa</a>
                    						</h3>
                    						<b>
                    							680.000 đ
                    						</b>
                    					</div>
                    				</div>
                    				<div class="item-product-right">
                    					<div class="img">
                    						<a href="">
                    							<img src="images/phukien3.png" alt="">
                    						</a>
                    					</div>
                    					<div class="title">
                    						<h3>
                    							<a href="">Pin camera</a>
                    						</h3>
                    						<b>
                    							680.000 đ
                    						</b>
                    					</div>
                    				</div>

                    				<div class="item-product-right">
                    					<div class="img">
                    						<a href="">
                    							<img src="images/phukien4.png" alt="">
                    						</a>
                    					</div>
                    					<div class="title">
                    						<h3>
                    							<a href="">Pin camera</a>
                    						</h3>
                    						<b>
                    							680.000 đ
                    						</b>
                    					</div>
                    				</div>
                    			</div>
                    		</div>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="thongsoKythuat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        	<div class="modal-dialog" role="document">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h2>
        					CAMERA AN NINH DHHI
        				</h2>
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        					<span aria-hidden="true">&times;</span>
        				</button>
        			</div>
        			<div class="img">
        				<img src="images/detail-product.jpg" alt="">
        			</div>
        			<div class="list-option">
        				<img src="images/thongso.jpg" alt="">
        				<ul>
        					<li>
        						Độ phân giải <b>2 MPixel cảm biến STARVIS CMOS kích thước 1/2.8”</b>
        					</li>
        					<li>
        						Chống ngược sáng WDR()120dB, chế độ ngày đêm ICR, chống nhiễu hình ảnh 3DNR, tự động cân bằng trắng AWB, tự động bù sáng AGC, chống ngược sáng BLC
        					</li>
        					<li>
        						Công nghệ “Starlight” với độ nhạy sáng cực thấp 0.001Lux/F1.0(ảnh màu) - Cho hình ảnh có màu trong môi trường ánh sáng cực thấp. Smart IR cho phép chuyển chế độ chính xác và nhanh nhạy
        					</li>
        					<li>
        						Chuẩn kết nối Onvif 2.4 tương thích tất cả các đầu ghi camera trên thị trường
        					</li>
        					<li>
        						Chuẩn chống nước IP67 , IK10, Micro SD Memory
        					</li>
        					<li>
        						Công nghệ ePOE Giải pháp bổ xung cho điểm yếu của camera IP truyền thống là không  đi dây cáp mạng được xa, với dòng công nghệ mới ePoE khắc phục được vấn đề trên, chúng có khả năng truyền dẫn tín hiệu, 800m với băng thông 10Mbps và 300m với băng thông 100mbps
        					</li>
        					<li>
        						Đèn hồng ngoại LED, tiết kiệm điện, khoảng cách chiếu xa hồng ngoại 30m
        					</li>
        				</ul>
        			</div>
        		</div>
        	</div>
        </div>
        <script type="text/javascript">
        	$('#owl-detail').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: true,
        dots:false,
        infinite: false,
        responsive: [
            {
                breakpoint: 500,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 1920,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1
                }
            }
        ]
    });
        </script>
        @endsection
