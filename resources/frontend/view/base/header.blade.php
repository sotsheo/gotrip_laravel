<?php 
    use Illuminate\Support\Facades\Auth;
?>
<div class="menu-bar-mobile" tabindex="-1">
    <div class="logo-menu">
        <a href=""><img class="transition" src="images/logo.png"></a>
    </div>
    <div class="menu-bar-lv-1">
        <a class="a-lv-1" href="">Chọn giao diện</a>
        <div class="menu-bar-lv-2">
            <a class="a-lv-2" href=""><i class="fa fa-angle-right"></i>Bảng giá</a>
            <div class="menu-bar-lv-3">
                <a class="a-lv-3" href=""><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>Bảng giá</a>
            </div>
            <div class="menu-bar-lv-3">
                <a class="a-lv-3" href=""><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>Dịch vụ</a>
            </div>
            <div class="menu-bar-lv-3">
                <a class="a-lv-3" href=""><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>Blog</a>
            </div>
            <span class="span-lv-2 fa fa-angle-down"></span>
        </div>
        <div class="menu-bar-lv-2"><a class="a-lv-2" href=""><i class="fa fa-angle-right"></i>Bảng giá</a></div>
        <div class="menu-bar-lv-2"><a class="a-lv-2" href=""><i class="fa fa-angle-right"></i>Dịch vụ</a></div>
        <div class="menu-bar-lv-2"><a class="a-lv-2" href=""><i class="fa fa-angle-right"></i>Blog</a></div>
        <span class="span-lv-1 fa fa-angle-down"></span>
    </div>
    <div class="menu-bar-lv-1"><a href="">Bảng giá</a></div>
    <div class="menu-bar-lv-1"><a href="">Dịch vụ</a></div>
    <div class="menu-bar-lv-1">
        <a class="a-lv-1" href="">Tin tức</a>
        <div class="menu-bar-lv-2">
            <a class="a-lv-2" href=""><i class="fa fa-angle-right"></i>Bảng giá</a>
            <div class="menu-bar-lv-3">
                <a class="a-lv-3" href=""><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>Bảng giá</a>
            </div>
            <div class="menu-bar-lv-3">
                <a class="a-lv-3" href=""><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>Dịch vụ</a>
            </div>
            <div class="menu-bar-lv-3">
                <a class="a-lv-3" href=""><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>Tin tức</a>
            </div>
            <span class="span-lv-2 fa fa-angle-down"></span>
        </div>
        <div class="menu-bar-lv-2"><a class="a-lv-2" href=""><i class="fa fa-angle-right"></i>Bảng giá</a></div>
        <div class="menu-bar-lv-2"><a class="a-lv-2" href=""><i class="fa fa-angle-right"></i>Dịch vụ</a></div>
        <div class="menu-bar-lv-2"><a class="a-lv-2" href=""><i class="fa fa-angle-right"></i>Blog</a></div>
        <span class="span-lv-1 fa fa-angle-down"></span>
    </div>
    <div class="menu-bar-lv-1"><a href="">Về chúng tôi</a></div>
    <div class="menu-bar-lv-1"><a href="">Hỗ trợ</a></div>
</div>
<div class="shadow-open-menu"></div>
<div class="header">
    <div class="container">
        <div class="iconmenu">  <!-- data-wow-delay="4s" data-wow-duration="1s" -->
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="logo">
            <a href="<?= url('/')?>">
                <img src="<?= url($w->logo_root)?>" alt="<?=$w->name?>">
            </a>
        </div>
        <div class="nav-menu">
            <div class="main-menu">
                <!-- menu -->
                <?= App\Http\Controllers\frontend\widget\AllWidgetController::getDataWidget('view_main',1);?>
                
            </div>
        </div>
        <div class="group-right">
            <div class="hotline">
                <?php $phone=explode(',', $w->phone); ?>
                <?php if($phone){ ?>
                    <p>
                        <a href="tel:<?=$phone[0]?>"><img src="{{ asset('resources/assets/images/ic-phone.png')}}" alt=""><?=$phone[0]?></a>
                    </p>
                <?php } ?>
            </div>
            <?php if(!Auth::guard('users')->check()){ ?>
            <div class="account-box">
                <div class="user-login">
                    <a data-fancybox data-src="#login-form" href="javascript:;">
                        <div class="img">
                            <img class="default" src="{{ asset('resources/assets/images/user.png')}}" alt="">
                        </div>
                        <div class="title">
                            <h2>
                                Đăng nhập 
                            </h2>
                            <span>Đăng nhập</span>
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
    <div class="shadow-menu"></div>
</div>