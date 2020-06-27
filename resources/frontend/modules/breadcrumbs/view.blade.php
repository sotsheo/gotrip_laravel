<?php if(isset($breadcrumb) && $breadcrumb){?>
<div class="breadcrumb">
	<div class="container">
		
            <?php $i=0;foreach($breadcrumb as $b){$i++; ?>
				<a href="{{$b['link']}}" title="{{$b['name']}}">{{$b['name']}}
				<?php if($i<count($breadcrumb)){ ?>
					<span><i class="fa fa-angle-right"></i>
				<?php } ?>
				</a>
            <?php }?>
		
	</div>
</div>
<?php }?>
