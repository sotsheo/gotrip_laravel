
@extends('view.view.main')
@section('title',$title)
@section("content")

<div class="page-news">
    <?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view_in',22);?>
    <div class="detail-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box-detail">
                        <h1>
                            Liên hệ
                        </h1>
                       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1072.8832699649943!2d105.76512552615567!3d21.008808387727175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31345306bcfb09cd%3A0x5c91bf4fa1b07254!2zQ8O0bmcgVHkgVE5ISCBUcnV54buBbiBUaMO0bmcgUXXhu5FjIFThur8gVuG6oW4gQW4!5e1!3m2!1sen!2s!4v1560775596495!5m2!1sen!2s" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection