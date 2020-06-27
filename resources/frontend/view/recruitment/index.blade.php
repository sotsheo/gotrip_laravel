
@extends('view.view.main')
@section('title',$title)
@section("content")

    <div class="main main_in">
        @include('view/modules/breadcrumbs/view')
        <div class="list-news">

            <div class="layout">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 main_left">
                            <div class="group_left ">
                                <div class="row">
                                    @if(count($recruitment)>0) @foreach($recruitment as $n)
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <div class="item_news">
                                                <div class="img">
                                                    <a href="<?= url($n->link)?>" class="zom_img">
                                                        <img src="<?= $n->img_path.'/400x400/'.$n->img_name;?>"></a>
                                                    <p class="time">{{ date('d/m/Y',$n->date_created) }}</p>
                                                </div>
                                                <div class="text">
                                                    <a href="<?= url($n->link)?>"><h2>{{ str_limit($n->name,30,'...') }}</h2></a>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @endif
                                </div>
                                @include('view.modules.paginate.view',['paginator'=>$recruitment])
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 main_right">
                            <div class="group_right">
                                <?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view',15);?>
                                <?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view_2',16);?>
                                <?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view',17);?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection