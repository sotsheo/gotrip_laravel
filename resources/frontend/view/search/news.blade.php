
@extends('view.view.main')
@section('title','Seach')
@section("content")

<div class="wapper hidden-main" id="main">
    @include('view/modules/banner/view_18')
    <div class="list-news">
       
        <div class="container">
            @if(strlen($t)>=2)
                <p>Kết quả cho tìm kiếm  '{{$t}}' là: {{count($news)}} bài viết</p>
            @else
                <p style="color: red">{{$t}}</p>
            @endif
            @if(count($news)>0)
            <div class="row multi-columns-row">
                @foreach($news as $n)
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="item-news">
                        <div class="img">
                            <a href="<?= url($n->link).$n->id?>"><img  class="hover-img" src="<?= url($n->img)?>" alt=""></a>
                            <span>{{ date('d/m/Y',$n->date_public) }}</span>
                        </div>
                        <div class="title">
                            <h3>
                                <a href="<?= url($n->link).$n->id?>">
                                    {{ str_limit($n->name,30,'...') }}
                                </a>
                            </h3>
                            <div class="time">
                                <span><i class="fa fa-clock-o"></i> {{ date('d/m/Y',$n->date_public) }}</span>
                                <span>|</span>
                                <span><i class="fa fa-user-circle"></i> {{ ($n->user==1)?'admin':$n->user }}</span>
                            </div>
                            {{ str_limit($n->short_description,150,'...') }}
                            <div class="button-style hascolor">
                                <a href="<?= url($n->link).$n->id?>">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @include('model.paginate.view',['paginator'=>$news])
            </div>
             @endif
            
            
        </div>
    </div>
</div>
@endsection