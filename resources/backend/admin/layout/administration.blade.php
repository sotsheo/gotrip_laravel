<li class="header">Tin tức</li>
{{-- Bài viết --}}
<li class=" treeview ">
    <a href="#">
        <i class="fa fa-dashboard"></i> <span>Quản lý bài viết</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <?php if(in_array('admin/category_news',$au)){?>
        <li class="active"><a href="{{ url('admin/category_news')}}"><i class="fa fa-circle-o"></i> Danh mục bài
                viết</a></li>
        <?php }?>
        <?php if(in_array('admin/news',$au)){?>
        <li><a href="{{ url('admin/news')}}"><i class="fa fa-circle-o"></i>Bài viết</a></li>
        <?php }?>
        <?php if(in_array('admin/pagecontent',$au)){?>
        <li><a href="{{ url('admin/pagecontent')}}"><i class="fa fa-circle-o"></i>Bài nội dung</a></li>
        <?php }?>
    </ul>
</li>