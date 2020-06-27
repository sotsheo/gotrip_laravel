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