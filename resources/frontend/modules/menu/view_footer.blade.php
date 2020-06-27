<?php if(isset($data) && $data){?>
	<?php foreach ($data as $m) {?>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="footer-menu">
		
		<h2>
			<?=$m['name']?>
		</h2>
		<?php if($m['children']){?>
			<ul>
				 <?php foreach ($m['children'] as $key=>$v) {?>
				<li>
					 <a href="<?= $v['link']?>"><?=$v['name']?></a>
				</li>
				<?php } ?>
			</ul>
		<?php } ?>
		
	</div>
</div>
<?php } ?>
<?php } ?>
