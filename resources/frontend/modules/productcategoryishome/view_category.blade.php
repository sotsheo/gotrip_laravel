@if(count($category)>0)
 <div class="categories-menu">
    <h2>
        <?= $widget->name?>
    </h2>
    <ul>
        <?php foreach ($category as $cate) {?>
            <li><a href="<?= url($cate->link)?>">{{ $cate->name }}</a></li>
        <?php }?>
   </ul>
</div>

@endif