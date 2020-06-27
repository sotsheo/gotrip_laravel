@extends('view.main')
@section('title','Đại lý')
@section("content")
<?php $d_v=(isset($_GET['district']))?$_GET['district']:'';$p_v=(isset($_GET['province']))?$_GET['province']:'';?>
<div class="wapper hidden-main" id="main">
		<div class="banner-inpage">
			<img src="images/banner-inpage.jpg" alt="">
		</div>
		<div class="breadcrumb">
			<div class="container">
				<a href="">Trang chủ</a>
				<span>//</span>
				<p>Giới thiệu</p>
			</div>
		</div>
		<div class="daily-page">
            <div class="container">
				<div class="title-standard center">
					<h2>Đại lý phân phối</h2>
				</div>
            	<div class="filter-store">
            		<div class="row">
            			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            				<select name="province" id="filter_province">
            					<option value="">Chọn thành phố / tỉnh</option>
            					<?php foreach($province as $p){?>
            						<option value="{{$p->id_name}}" {{($p->id_name==$p_v)?"selected":''}}>{{$p->name}}</option>
            					<?php }?>
            				</select>
            			</div>
            			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            				<select name="district" id="filter_district">
            					<option value="">Chọn thành quận / huyện</option>
            					<?php foreach($district as $d){?>
            						<option value="{{$d->id_name}}" {{($d->id_name==$d_v)?"selected":''}}>{{$d->name}}</option>
            					<?php }?>
            				</select>
            			</div>
            			
            		</div>
            	</div>
            	<div class="list-store">
            		<div class="map">
            			<div class="mapIframe">
            				<?php foreach($shop as $s){?>
            				<iframe src="<?=$s->map?>" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            				<?php break;}?>
            			</div>
            		</div>
            		<div class="list-item">
            			<?php $i=0;foreach($shop as $s){$i++;?>
	            			<div class="item-store changesrc <?= ($i==1)?'active':''?>" map='<?= $s->map?>'>
	            				<?= $s->name?>                     
	            			</div>
            			<?php }?>
            		</div>
            	</div>
            </div>
        </div>
		<!-- banner support -->
		<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view_support',13);?>


		<!-- banner đối tác -->
		<?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view_patter',14);?>
	</div>
	<script type="text/javascript">
		<?php ?>
		$(document).ready(function(){
			$("#filter_province").change(function(){
				window.location.href=('<?= $url=url()->current()?>?province='+$(this).children("option:selected").val());
			});
			$("#filter_district").change(function(){
				 window.location.href=('<?= $url=url()->full()?>&district='+$(this).children("option:selected").val());
			});
		});
	</script>
	@endsection