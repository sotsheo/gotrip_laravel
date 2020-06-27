
<div class="full " style="">
    <div class="donut"></div>
</div>

</style>
<script src="{{ asset('public/layout_admin/js/app.js')}}"></script>
<script src="{{ asset('public/layout_admin/js/fuelux/fuelux.js')}}"></script>
<script src="{{ asset('public/layout_admin/js/app.plugin.js')}}"></script>
<script src="{{ asset('public/layout_admin/js/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('public/layout_admin/js/charts/easypiechart/jquery.easy-pie-chart.js')}}"></script>
<script src="{{ asset('public/layout_admin/js/charts/sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{ asset('public/layout_admin/js/charts/flot/jquery.flot.min.j')}}s"></script>
<script src="{{ asset('public/layout_admin/js/charts/flot/jquery.flot.tooltip.min.js')}}"></script>
<script src="{{ asset('public/layout_admin/js/charts/flot/jquery.flot.resize.js')}}"></script>
<script src="{{ asset('public/layout_admin/js/charts/flot/jquery.flot.grow.js')}}"></script>
<script src="{{ asset('public/layout_admin/js/charts/flot/demo.js')}}"></script>
<script src="{{ asset('public/layout_admin/js/datepicker/bootstrap-datepicker.js')}}"></script>


<script src="{{ asset('public/layout_admin/js/calendar/bootstrap_calendar.js')}}"></script>
<script src="{{ asset('public/layout_admin/js/slider/bootstrap-slider.js')}}"></script>
<!-- <script src="{{ asset('public/layout_admin/js/calendar/demo.js')}}"></script> -->
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('public/layout_admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('public/layout_admin/js/jquery.js')}}"></script>
<script src="{{ asset('public/layout_admin/js/jquery-ui.js')}}"></script>
<script src="{{ asset('public/layout_admin/js/file-input/bootstrap-filestyle.min.js')}}"></script>
<script src="{{ asset('public/layout_admin/js/moment.min.js')}}"></script>
<script src="{{ asset('public/layout_admin/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{ asset('public/layout_admin/js/combodate/combodate.js')}}"></script>
<script src="{{ asset('public/layout_admin/js/select2/select2.min.js')}}"></script>
<script src="{{ asset('public/layout_admin/chosen.jquery.min.js')}}"></script>
<!-- AdminLTE App -->


<script>
    $('.chosen-select2').select2(); 
    $('.chosen-select').chosen({allow_single_deselect:true}); 
	$(document).ready(function() {


		$('.datetimepicker').datetimepicker({
            format: 'HH:ss DD/MM/YYYY',//use this option to display seconds
            icons: {
            	time: 'fa fa-clock-o',
            	date: 'fa fa-calendar',
            	up: 'fa fa-chevron-up',
            	down: 'fa fa-chevron-down',
            	previous: 'fa fa-chevron-left',
            	next: 'fa fa-chevron-right',
            	today: 'fa fa-arrows ',
            	clear: 'fa fa-trash',
            	close: 'fa fa-times'
            }
        }).next().on('click', function() {
        	$(this).prev().focus();
        });

        $(function () {
        	$("#sortable").sortable();
        	$("#sortable").disableSelection();
        });
    });
</script>
<style type="text/css">
    .full{
        opacity: 0;
        z-index: -1;
    }
    .full.active{
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        position: fixed;
        background: rgba(0,0,0,.5);
        z-index: 9999;
        top: 0;
        left: 0;
        opacity: 1;
    }
    .full.active .donut {
        width: 5rem;
        height: 5rem;
        margin: 0 auto;
        border-radius: 50%;
        border: 0.3rem solid rgba(151, 159, 208, 0.3);
        border-top-color: #9a4a73;
        -webkit-animation: 1.5s spin infinite linear;
        animation: 1.5s spin infinite linear;
    }
    @keyframes spin{
         100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
	.bootstrap-filestyle .input-s{
		background: transparent;
		border: 0px;
         display: none !important;
	}
    .input-s{

    }
	.bootstrap-filestyle label{
		float: left;
	}
	.form-group img{
		display: block;
		margin: 10px 0px;
		border: 1px solid #c3c3;
		padding: 5px;
	}
	.page{
		padding: 0px 15px;
		text-align: right;
	}
	.select2-container .select2-selection--single { height: auto; }
    .select2-container, .select2-drop, .select2-search, .select2-search input {
        /*height: 45px;*/
        border: 0px;
        padding: 0px;
    }
    .bootstrap-filestyle{
        float: left;
        margin: 5px;
        width: 100%;
    }
  /*  .chosen-container-multi .chosen-choices li.search-choice .search-choice-close:before {
    content: "\f00d";
    display: inline-block;
    color: #888;
    font-family: FontAwesome;
    font-size: 13px;
    position: absolute;
    right: 2px;
    top: -1px;
}*/
</style>
<script>
	function formatNumber(numbers,number_check=3,tach=','){
		numbers=numbers.toString().split(",").join("");
        // đảo ngược dữ liêu
        var reve=numbers.toString().split("").reverse().join("");
         // kiểm tra chuỗi có chia hết cho các 
         var dau=parseInt(reve.length/number_check);
         var count=dau*number_check;
         var text=reve;
         if(reve.length>number_check){
         	text='';
            // kiem tra xem co bao nhieu dau 
            if(reve.length%number_check==0){
            	dau-=1;
            }
            var check=0;
            reve.split("").forEach((val,index) => {
            	if((index)%number_check==0 && dau && (index)>=number_check){
            		text+=tach;
            		dau--;
            	}
            	text+=val;
            });
        }
        return text.split("").reverse().join("");
    }
    $(document).ready(function(){
        //  /$("#flight-price").val(formatNumber($(this).val()));
            // $("#flight-price").keypress(function(){
            //  //console.log(format_curency($(this).val()));

            // });
            $('.number_input_price').each(function(){
            	$(this).on("keypress keyup blur", function(event) {
	            	$(this).val(formatNumber($(this).val()));
	            	if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
	            		event.preventDefault();
	            	}
            	});
            });
            
           
        });
 </script>

