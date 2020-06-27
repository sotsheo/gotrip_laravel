@extends('view.view.main')
@section('title',$recruitment->name)
@section("content")

    <div class="main main_in">
        @include('view/modules/breadcrumbs/view')
        <div class="list-news">

            <div class="layout">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 main_left">
                            <div class="group_left ">
                                <div class="detail_news">
                                    <h2 class="title_news"> <?= $recruitment->name?> </h2>
                                    <?= $recruitment->description?>
                                </div>

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 main_right">
                            <div class="group_right">
                                <?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view', 15);?>
                                <?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view_2', 16);?>
                                <?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view', 17);?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection