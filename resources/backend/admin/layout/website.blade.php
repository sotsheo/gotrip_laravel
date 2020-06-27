
<aside class="bg-dark  lter aside-md hidden-print" id="nav">          
  <section class="vbox">

    <section class="w-f scrollable">
      <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">

        <!-- nav -->
        <nav class="nav-primary hidden-xs">
          <ul class="nav">

          <?php if(in_array('admin/news',$au)){?>
            <li class="{{(checkUrl(['admin/category_news','admin/news','admin/pagecontent']))?'menu-open active':''}}">
              <a href="#news"  >
                <i class="fa fa-file icon">
                  <b class="bg-warning"></b>
                </i>
                <span class="pull-right">
                  <i class="fa fa-angle-down text"></i>
                  <i class="fa fa-angle-up text-active"></i>
                </span>
                <span>Quản lý bài viết</span>
              </a>
              <ul class="nav lt">
                <?php if(in_array('admin/category_news',$au)){?>
                  <li class="{{(checkUrl(['admin/category_news']))?'active':''}}">
                    <a href="{{ url('admin/category_news')}}" >                                                        
                      <i class="fa fa-angle-right"></i>
                      <span>Danh mục bài viết</span>
                    </a>
                  </li>
                <?php } ?>

                <?php if(in_array('admin/news',$au)){?>
                  <li class="{{(checkUrl(['admin/news']))?'active':''}}">
                    <a href="{{ url('admin/news')}}" >                                                        
                      <i class="fa fa-angle-right"></i>
                      <span>Bài viết</span>
                    </a>
                  </li>
                <?php } ?>

                <?php if(in_array('admin/pagecontent',$au)){?>
                  <li class="{{(checkUrl(['admin/pagecontent']))?'active':''}}">
                    <a href="{{ url('admin/pagecontent')}}" >                                                        
                      <i class="fa fa-angle-right"></i>
                      <span>Trang nội dung</span>
                    </a>
                  </li>
                <?php } ?>
              </ul>
            </li>
          <?php } ?>

         
          <?php if(in_array('admin/banner',$au)){?>
            <li class=" {{(checkUrl(['admin/banner','admin/category_banner']))?'menu-open active':''}}">
                <a href="#banner"  >
                  <i class="fa fa-picture-o icon">
                    <b class="bg-warning"></b>
                  </i>
                  <span class="pull-right">
                    <i class="fa fa-angle-down text"></i>
                    <i class="fa fa-angle-up text-active"></i>
                  </span>
                  <span>Quản lý banner</span>
                </a>
                <ul class="nav lt">
                  <?php if(in_array('admin/category_banner',$au)){?>
                    <li class="{{(checkUrl(['admin/category_banner']))?'active':''}}">
                      <a href="{{ url('admin/category_banner')}}" >                                                        
                        <i class="fa fa-angle-right"></i>
                        <span>Danh mục banner</span>
                      </a>
                    </li>
                  <?php } ?>

                  <?php if(in_array('admin/banner',$au)){?>
                    <li class="{{(checkUrl(['admin/banner']))?'active':''}}">
                      <a href="{{ url('admin/banner')}}" >                                                        
                        <i class="fa fa-angle-right"></i>
                        <span>Banner</span>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
            </li>
          <?php } ?>

          <!-- video -->
          <?php if(in_array('admin/video',$au)){?>
            <li class=" {{(checkUrl(['admin/video','admin/category_video']))?'menu-open active':''}}">
                <a href="#video"  >
                  <i class="fa fa-play-circle icon">
                    <b class="bg-success"></b>
                  </i>
                  <span class="pull-right">
                    <i class="fa fa-angle-down text"></i>
                    <i class="fa fa-angle-up text-active"></i>
                  </span>
                  <span>Quản lý video</span>
                </a>
                <ul class="nav lt">
                  <?php if(in_array('admin/category_video',$au)){?>
                    <li class="{{(checkUrl(['admin/category_video']))?'active':''}}">
                      <a href="{{ url('admin/category_video')}}" >                                                        
                        <i class="fa fa-angle-right"></i>
                        <span>Danh mục video</span>
                      </a>
                    </li>
                  <?php } ?>

                  <?php if(in_array('admin/video',$au)){?>
                    <li class="{{(checkUrl(['admin/video']))?'active':''}}">
                      <a href="{{ url('admin/video')}}" >                                                        
                        <i class="fa fa-angle-right"></i>
                        <span>Video</span>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
            </li>
          <?php } ?>

          


         

          <?php if(in_array('admin/setting',$au)){?>
            <li class=" treeview {{(checkUrl(['admin/setting','admin/introduce','admin/support','admin/html','admin/shop']))?'menu-open active':''}}">
              <a href="#album"  >
                <i class="fa fa-columns icon">
                  <b class="bg-warning"></b>
                </i>
                <span class="pull-right">
                  <i class="fa fa-angle-down text"></i>
                  <i class="fa fa-angle-up text-active"></i>
                </span>
                <span>Cấu hình website</span>
              </a>
              <ul class="nav lt">


                <?php if(in_array('admin/setting',$au)){?>
                  <li class="{{(checkUrl(['admin/setting']))?'active':''}}">
                    <a href="{{ url('admin/setting')}}" >                                                        
                      <i class="fa fa-angle-right"></i>
                      <span>Cấu hình web</span>
                    </a>
                  </li>
                <?php } ?>

                <?php if(in_array('admin/introduce',$au)){?>
                  <li class="{{(checkUrl(['admin/introduce']))?'active':''}}">
                    <a href="{{ url('admin/introduce')}}" >                                                        
                      <i class="fa fa-angle-right"></i>
                      <span>Trang giới thiệu</span>
                    </a>
                  </li>
                <?php } ?>

                <?php if(in_array('admin/html',$au)){?>
                  <li class="{{(checkUrl(['admin/html']))?'active':''}}">
                    <a href="{{ url('admin/html')}}" >                                                        
                      <i class="fa fa-angle-right"></i>
                      <span>Quản lý nội dung tĩnh</span>
                    </a>
                  </li>
                <?php } ?>
              </ul>
            </li>
          <?php } ?>

          <!-- vé máy bay -->
          <?php if(in_array('admin/flight',$au)){?>
            <li class=" {{(checkUrl(['admin/flight']))?'menu-open active':''}}">
                <a href="#flight"  >
                  <i class="fa  fa-ticket icon">
                    <b class="bg-success"></b>
                  </i>
                  <span class="pull-right">
                    <i class="fa fa-angle-down text"></i>
                    <i class="fa fa-angle-up text-active"></i>
                  </span>
                  <span>Quản lý vé</span>
                </a>
                <ul class="nav lt">
                  <?php if(in_array('admin/flight',$au)){?>
                    <li class="{{(checkUrl(['admin/flight']))?'active':''}}">
                      <a href="{{ url('admin/flight')}}" >                                                        
                        <i class="fa fa-angle-right"></i>
                        <span>Quản lý vé</span>
                      </a>
                    </li>
                  <?php } ?>

              

                  <?php if(in_array('admin/flight/airline',$au)){?>
                    <li class="{{(checkUrl(['admin/flight/airline']))?'active':''}}">
                      <a href="{{ url('admin/flight/airline')}}" >                                                        
                        <i class="fa fa-angle-right"></i>
                        <span>Quản lý hãng bay</span>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
            </li>
          <?php } ?>

           <!-- vé máy bay -->
          <?php if(in_array('admin/combo',$au)){?>
            <li class=" {{(checkUrl(['admin/combo']))?'menu-open active':''}}">
                <a href="#combo"  >
                  <i class="fa fa-credit-card icon">
                    <b class="bg-success"></b>
                  </i>
                  <span class="pull-right">
                    <i class="fa fa-angle-down text"></i>
                    <i class="fa fa-angle-up text-active"></i>
                  </span>
                  <span>Quản lý combo</span>
                </a>
                <ul class="nav lt">
                  <?php if(in_array('admin/combo',$au)){?>
                    <li class="{{(checkUrl(['admin/combo']))?'active':''}}">
                      <a href="{{ url('admin/combo')}}" >                                                        
                        <i class="fa fa-angle-right"></i>
                        <span>Quản lý combo</span>
                      </a>
                    </li>
                  <?php } ?>
                  <?php if(in_array('admin/combo/category',$au)){?>
                    <li class="{{(checkUrl(['admin/combo/category']))?'active':''}}">
                      <a href="{{ url('admin/combo/category')}}" >                                                        
                        <i class="fa fa-angle-right"></i>
                        <span>Quản lý danh mục</span>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
            </li>
          <?php } ?>

          <!-- hotel -->
          <?php if(in_array('admin/hotel',$au)){?>
            <li class=" {{(checkUrl(['admin/hotel']))?'menu-open active':''}}">
                <a href="#hotel"  >
                  <i class="fa fa-calendar-o icon">
                    <b class="bg-success"></b>
                  </i>
                  <span class="pull-right">
                    <i class="fa fa-angle-down text"></i>
                    <i class="fa fa-angle-up text-active"></i>
                  </span>
                  <span>Quản lý khách sạn</span>
                </a>
                <ul class="nav lt">
                  <?php if(in_array('admin/hotel',$au)){?>
                    <li class="{{(checkUrl(['admin/hotel']))?'active':''}}">
                      <a href="{{ url('admin/hotel')}}" >                                                        
                        <i class="fa fa-angle-right"></i>
                        <span>Quản lý khách sạn</span>
                      </a>
                    </li>
                  <?php } ?>
                  <?php if(in_array('admin/hotel/items',$au)){?>
                    <li class="{{(checkUrl(['admin/hotel/items']))?'active':''}}">
                      <a href="{{ url('admin/hotel/items')}}" >                                                        
                        <i class="fa fa-angle-right"></i>
                        <span>Quản lý tiện ích khách sạn</span>
                      </a>
                    </li>
                  <?php } ?>
                  <?php if(in_array('admin/hotel/room',$au)){?>
                    <li class="{{(checkUrl(['admin/hotel/room']))?'active':''}}">
                      <a href="{{ url('admin/hotel/room')}}" >                                                        
                        <i class="fa fa-angle-right"></i>
                        <span>Quản lý phòng</span>
                      </a>
                    </li>
                  <?php } ?>
                  <?php if(in_array('admin/hotel/room/items',$au)){?>
                    <li class="{{(checkUrl(['admin/hotel/room/items']))?'active':''}}">
                      <a href="{{ url('admin/hotel/room/items')}}" >                                                        
                        <i class="fa fa-angle-right"></i>
                        <span>Quản lý tiện ích phòng</span>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
            </li>
          <?php } ?>


          <!-- order  -->
          <?php if(in_array('admin/cart',$au)){?>
            <li class="{{(checkUrl(['admin/cart']))?'active':''}}">
              <a href="{{ url('admin/cart')}}" >
                                                              
                <i class="fa fa-angle-right"></i>
                <span>Quản lý đặt hàng</span>
              </a>
            </li>
          <?php } ?>

          <?php if(in_array('admin/code',$au)){?>
            <li class="{{(checkUrl(['admin/code']))?'active':''}}">
              <a href="{{ url('admin/code')}}" >
                                                              
                <i class="fa fa-angle-right"></i>
                <span>Quản lý mã code</span>
              </a>
            </li>
          <?php } ?>

         

          <?php if(in_array('admin/history',$au)){?>
            <li class="{{(checkUrl(['admin/history']))?'active':''}}">
              <a href="{{ url('admin/history')}}" >
                                                              
                <i class="fa fa-angle-right"></i>
                <span>Lịch sử</span>
              </a>
            </li>
          <?php } ?>


          <?php if(in_array('admin/menu',$au)){?>
            <li class="{{(checkUrl(['admin/menu']))?'active':''}}" >
              <a href="{{ url('admin/menu')}}">
               
                <i class="fa fa-align-justify icon">
                  <b class="bg-info"></b>
                </i>
                <span>Quản lý menu</span>
              </a>
            </li>
          <?php }?>

          <?php if(in_array('admin/widget',$au)){?>
            <li class="{{(checkUrl(['admin/widget']))?'active':''}}" >
              <a href="{{ url('admin/widget')}}">
                <i class="fa fa-pencil icon">
                  <b class="bg-info"></b>
                </i>
                <span>Quản lý widget</span>
              </a>
            </li>
          <?php }?>

          <?php if(in_array('admin/newsletter',$au)){?>
            <li class="{{(checkUrl(['admin/newsletter']))?'active':''}}" >
              <a href="{{ url('admin/newsletter')}}">
                @if(count($data)>0)
                <b class="badge bg-danger pull-right">{{count($data)}}</b>
                @endif

                <i class="fa fa-envelope-o icon">
                  <b class="bg-success"></b>
                </i>
                <span>Đăng ký nhận bản tin</span>
              </a>
            </li>
          <?php }?> 
          </ul>
        </nav>
        <!-- / nav -->
      </div>
    </section>
    <footer class="footer lt hidden-xs b-t b-light">
      <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-default btn-icon">
        <i class="fa fa-angle-left text"></i>
        <i class="fa fa-angle-right text-active"></i>
      </a>
    </footer>

  </section>
</aside>


