<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese" rel="stylesheet">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="<?= url($w->logo_root)?>" />
    @if(isset($meta))
    <?php echo($meta)?>
    @endif
    <link href="{{ asset('resources/assets/css/vensdor/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{ asset('resources/assets/css/vensdor/font-awesome.css')}}" rel="stylesheet" />
    <link href="{{ asset('resources/assets/css/vensdor/animate.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/vensdor/slick.css')}}"/>
    <link rel="stylesheet" href="{{ asset('resources/assets/css/vensdor/jquery.fancybox.min.css')}}" />
    <link href="{{ asset('resources/assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{ asset('resources/assets/css/thanh_fix.css')}}" rel="stylesheet" />
    <script src="{{ asset('resources/assets/js/jquery.min.js')}}" type="text/javascript"></script>

</head>
<body>

    @include('view/base/header')
    <div class="wapper" id="main">
        @yield('content')
    </div>
    @include('view/base/footer')

    <script src="{{ asset('resources/assets/js/wow.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('resources/assets/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{ asset('resources/assets/js/slick.js')}}"></script>
    <script src="{{ asset('resources/assets/js/masonry.pkgd.min.js')}}"></script>
    <script src="{{ asset('resources/assets/js/main.js')}}" type="text/javascript"></script>
     
    <script>
        $('data-fancybox').fancybox({
        // Options will go here
    });
        $('.banner-main').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            arrows:false,
            infinite: true,
            speed: 1500,
        // autoplay: true,
        // autoplaySpeed: 3000,
        // fade: true,
        // cssEase: 'linear'
    });
        $('.slider-testimonial').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            arrows:false,
            infinite: true,
            speed: 1500,
        // autoplay: true,
        // autoplaySpeed: 3000,
        // fade: true,
        // cssEase: 'linear'
    });
        $('.slider-wine').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: false,
            arrows:false,
            infinite: true,
            speed: 1500,
            autoplay: true,
            autoplaySpeed: 3000,
        // fade: true,
        // cssEase: 'linear'
    });
        $('.slider-instar-images').slick({
            dots: false,
            arrows:false,
            infinite: true,
            speed: 22000,
            slidesToScroll: 7,
            slidesToShow: 7,
            autoplay: true,
            autoplaySpeed: 200,
            cssEase: 'linear',
            pauseOnHover:false,
            variableWidth: true
        });
        $('data-fancybox').fancybox();
    </script>
    <script>
        $(document).ready(function(e){
            wow = new WOW(
            {
                animateClass: 'animated',
            offset:       100,          // default
            mobile:       false,
            callback:     function(box) {
              console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
          }
      }
      );
            wow.init();
        });
    </script>
    

</body>