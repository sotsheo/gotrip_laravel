
@if(count($products) && isset($products))
<div class="related-product">
    <div class="title-box">
        <h2>
            Sản phẩm liên quan
        </h2>
    </div>
    <div class="row">
        <div class="slider-related-product">
            <?php foreach($products as $p){?>
                <div class="item-product">
                    <div class="img">
                         <a href="<?=url($p->link)?>">
                            <img class="hover-img" src="<?=url($p->img_path.'/1000x1000/'.$p->img_name)?>" alt="{{$p->name}}">
                        </a>
                    </div>
                    <div class="title">
                        <h3>
                             <a href="<?=url($p->link)?>">{{ str_limit($p->name,30,'...') }}</a>
                        </h3>
                        <?php if($p->price){?>
                        <p class="price"><?=number_format($p->price ,0 ,'.' ,'.').' Đ'?>  </p>
                        <?php }?>
                    </div>
                </div>
                <?php }?>
        </div>
    </div>
</div>
@endif