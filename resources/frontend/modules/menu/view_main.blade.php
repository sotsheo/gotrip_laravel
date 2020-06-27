 
<?php if(isset($data) && $data){?>
   <ul class="flex-row">
    <?php foreach ($data as $m) {?>
        <li>
            <a href="<?= $m['link']?>">
                <?=$m['name']?>
            </a>
            <?php if($m['children']){?>
                <ul>
                 <?php foreach ($m['children'] as $key=>$v) {?>
                    <li>
                        <a href="<?= url($v['link'])?>"><?=$v['name']?></a>
                         <?php if($v['children']){?>
                            <ul>
                             <?php foreach ($v['children'] as $key=>$v2) {?>
                                <li>
                                    <a href=""><?=$v2['name']?></a>
                                </li>
                             <?php } ?>
                         </ul>
                        <?php } ?>
                    </li>
                 <?php } ?>
             </ul>
            <?php } ?>
        </li>
    <?php }?>
</ul>

<?php }?>