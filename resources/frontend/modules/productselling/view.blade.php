@if(count($product)>0)
<div class="relate-product">
    <h2>Sản phẩm bán chạy</h2>
    <ul>
        <?php
        foreach ($product as $p){
            ?>
            <li>
                <div class="item-relate-product">
                    <div class="img-relate-product">
                     <a href="<?=url($p->link)?>">
                        <img class="hover-img" src="<?=url($p->img)?>" alt="{{$p->name}}">
                    </a>
                </div>
                <div class="title-relate-product">
                    <h3> <a href="<?=url($p->link)?>">{{ str_limit($p->name,30,'...') }}</a></h3>
                    <p class="price"><?=number_format($p->price ,0 ,'.' ,'.').' Đ'?> 
                        @if($p->price_market)
                        <span><?=number_format($p->price_market ,0 ,'.' ,'.').' Đ'?></span>
                    </p>
                    @endif
                </div>
            </div>
        </li>
        <?php }?>
    </ul>
</div>
@endif