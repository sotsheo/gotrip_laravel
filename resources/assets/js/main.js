$(".btn-show-filter").click(function() {
    $(".hide-mobile-check").addClass('show');
    $('.shadow-open-filter').show();
});
$(".shadow-open-filter").click(function() {
    $(".hide-mobile-check").removeClass('show');
    $(".shadow-open-filter").fadeOut();
});

$('.tab-ul ul li a').click(function() {
    var getTabId = $(this).attr('id');
    $('.tab-ul ul li a,.tab-ul ul li').removeClass('active');
    $(this).addClass('active');
    $(this).parent().addClass('active');
    $('.content-day-intrip').slideUp();
    $('.content-' + getTabId).slideDown();

});

var myScrollFunc = function () {
  var y = window.scrollY;
  if (y > 0) {
    $("body").addClass("fixed");
  } else {
    $("body").removeClass("fixed");
  };
};
window.addEventListener("scroll", myScrollFunc);
$(window).scroll(function() {
    if ($(this).scrollTop() > 500) {
        $('.back-top-Top').fadeIn();
    } else {
        $('.back-top-Top').fadeOut();
    }
});

$(".col-filter-product .title-box").click(function() {
    $(".show-mobile").toggle(500);
 });

$(".back-top-Top").click(function() {
    $("html, body").animate({scrollTop: 0}, 1000);
 });

$(".search-icon").click(function() {
    $(".box-search-show").addClass("open");
});
$(".close").click(function() {
    $(".box-search-show").removeClass("open");
});
// creat menu sidebar
$(".menu-bar-lv-1").each(function(){
    $(this).find(".span-lv-1").click(function(){
        $(this).toggleClass('rotate-menu');
        $(this).parent().find(".menu-bar-lv-2").toggle(500);
    });
});
$(".menu-bar-lv-2").each(function(){
    $(this).find(".span-lv-2").click(function(){
        $(this).toggleClass('rotate-menu');
        $(this).parent().find(".menu-bar-lv-3").toggle(500);
    });
});
$(".shadow-open-menu").click(function() {
    $('.menu-bar-mobile').removeClass('menu-open');
    $(".shadow-open-menu").fadeOut();
    $(".iconmenu").toggleClass("open");
    $(".hide-mobile-check").removeClass('show');
    $('.wapper').removeClass('menu-open');
});
$(".iconmenu").click(function() {
    $(this).toggleClass("open");
    $('.menu-bar-mobile').toggleClass('menu-open');
    $(".shadow-open-menu").fadeToggle(500);
    $('.wapper').toggleClass('menu-open');
});

$(document).ready(function(){
    if ($(window).width() < 992 ) {
        $('.main-menu ul li').find('.span-lv-1').click(function(){
            if ($('.main-menu > ul > li').hasClass('active')) {
                $('.main-menu ul li').removeClass('active');
            } else{
                $('.main-menu ul li').removeClass('active');
                $(this).parent().toggleClass('active')
            }
            
        });
        $('.main-menu ul li').find('.span-lv-2').click(function(){
            if ($('.main-menu > ul > li > ul > li').hasClass('active')) {
                $('.main-menu > ul > li > ul > li').removeClass('active');
            } else{
                $('.main-menu > ul > li > ul > li').removeClass('active');
                $(this).parent().toggleClass('active')
            }
            
        });
    }

    setTimeout(function(){ 
        $('.loading').addClass('close-loading');
        $('.main-content').addClass('active');
    }, 2500);
});
