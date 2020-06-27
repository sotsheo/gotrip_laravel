<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('public/layout_admin/css/bootstrap.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('public/layout_admin/css/animate.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('public/layout_admin/css/font-awesome.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('public/layout_admin/css/font.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('public/layout_admin/js/calendar/bootstrap_calendar.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('public/layout_admin/css/app.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('public/layout_admin/js/datepicker/datepicker.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('public/layout_admin/css/radio.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('public/layout_admin/js/bootstrap-datetimepicker.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('public/layout_admin/js/select2/select2.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('public/layout_admin/js/select2/theme.css')}}" type="text/css" />
<link rel="stylesheet" href="{{ asset('public/layout_admin/chosen.min.css')}}" type="text/css" />
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->

<script src="{{ asset('public/layout_admin/js/jquery.min.js')}}"></script>
<script src="{{ asset('public/layout_admin/ckeditor/ckeditor.js')}}"></script>
<script src="{{ asset('public/layout_admin/ckfinder/ckfinder.js')}}"></script>
<script type="text/javascript">
  var baseUrl = '<?= url('/public/layout_admin/') ?>';
</script>
<style type="text/css">
  body {
    font-family: 'Roboto', sans-serif;
  }
  .wrapper{
    padding: 0px;
  }
  .content-wrapper {
    background-color: #e1eff9;
  }
  .group_input{

    background: #e0e0e0;
    margin-bottom: 20px;
  }
  .group_input .content_p{
    padding:10px;
  }
  .group_input h4{
    font-size: 18px;
    text-transform: uppercase;
    /* background: #fbe9e9; */
    padding: 15px 5px;
    font-weight: 700;
    color: #609a03f5;
    margin-bottom: 15px;
    border-bottom: 1px solid #aba6a6;
  }
  .add_v{
    padding: 10px;
  }
  .nav-primary li > a > i {
    line-height: 40px;
  }
  /*.nav-primary ul.nav > li > a {
    padding: 9px 15px;
    font-weight: 500;
  }*/
  .form-group {
    /*border-style: dashed;*/
    padding: 10px 0px;
    border-bottom: 1px solid #e8e8e8;
    margin: 0px;
  }
  form .form-group:after {
    display: table;
    content: " ";
  }
  form .form-group:after {clear: both;}
  form .form-group {
    margin-right: -15px;
    margin-left: -15px;
  }
  .tab-content  .tab-pane {
    display: none;
  }
  .tab-content  .active {
    display: block;
  }

  .tab-content form>.form-group{
    margin: 0px;
  }
  @media (min-width: 768px){
    .app, .app body {
      overflow: hidden;
    }
    .nav-tabs.nav-justified > li {
      display: inline-block;
      width: auto;
    }
  }


</style>