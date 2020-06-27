
<form action="combo.html">
	
	<div class="form-search-trip">

		<div class="input-search">
			<input type="text" placeholder="Bạn muốn đi đâu?" name='to' value="" >
			<!-- cắm menu -->

		</div>
		<div class="t-datepicker date-ranger-search">

			<div class="t-check-in input-date">
				<input type="hiddens" class="t-input-check-in" value="<?=date('dd-mm-yyyy')?>" name="start">

				<div class="t-datepicker-day">
					<table class="t-table-condensed"></table>
				</div>
			</div>
			<div class="t-check-out input-date">
				<input type="hiddens" class="t-input-check-out" value="null" name="end">
				<label class="day_end">111</label>
			</div>

		</div>

		<div class="input-number-user">
			<i class="sprite sprite-ic-member"></i>
			<input type="text"  name='count' value="2" id="number_p">
			<input type="text"  name='count_chi' value="2" id="number_chi">
			<label> <span id="count_adults">2</span> người lớn, <span id="count_children">0</span> trẻ em</label>
			<span ><span id="room_id">1</span> Phòng</span>
			<div class="form_v">
				<ul>

					<li>
						<div class="item_v count_p">
							<div class="count_v">
								2
							</div>
							<div class="text_v" >
								<p>Người lớn</p>
								<span >Từ 12 tuổi trở lên</span>
							</div>
							<div class="number_v">
								<button class="prev_btn"> - </button>
								<button class="next_btn"> + </button>
							</div>
						</div>
					</li>
					<li>
						<div class="item_v count_chi">
							<div class="count_v" >
								0
							</div>
							<div class="text_v">
								<p>Trẻ em (0 - 11 tuổi)</p>
								<span>từ 0 đến 11 tuổi</span>
							</div>
							<div class="number_v">
								<button class="prev_btn"> - </button>
								<button class="next_btn"> + </button>
							</div>
						</div>

					</ul>
				</div>
			</div>
			<div class="input-submit">
				<button type="submit">
					TÌM KIẾM
				</button>
			</div>
		</div>
	</form>

	<link rel="stylesheet" type="text/css" href="https://t-datepicker.getqwerty.com/theme/css/layout-theme/theme-cyan.css" />
	<link rel="stylesheet" type="text/css" href="https://t-datepicker.getqwerty.com/theme/css/t-datepicker.min.css" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://t-datepicker.getqwerty.com/theme/js/t-datepicker.js"></script>

	<style type="text/css">
		.t-datepicker {
			clear: unset;
		}

		.t-special-day:before {
			border-color: transparent;
			border-top-color: #e91e63;
			border-right-color: #e91e63;
		}

		.t-special-day:before {
			content: '';
			height: 3px;
			width: 3px;
			top: 0;
			right: 0;
			position: absolute;
			display: block;
			border-width: 3px;
			border-style: solid;
			-webkit-box-sizing: content-box;
			-moz-box-sizing: content-box;
			box-sizing: content-box;
		}

		.day_in{
			position: absolute;
			bottom: 9px;
		}
		.t-dates.t-date-check-in ,.t-dates.t-date-check-out{
			padding: 19px 9px;
			font-weight: 700;
			height: 38px;
			font-size: 14px;
			box-sizing: border-box;
		}
		.section1 .search-trip .flex-center .form-search-trip .date-ranger-search .input-date i {
			font-size: 26px;
		}
		.section1 .search-trip .flex-center .form-search-trip .date-ranger-search .input-date {
			border: 0px;
		}
		.t-arrow-top {
			top: calc(100% - 20px);
			z-index: 9999;
		}
		.t-datepicker-day {
			top: 100%;
		}
		.t-year-check-out,.t-year-check-in{
			display: none;
		}
	</style>
   
	<script>
		$(document).ready(function(){


		var holiDays=<?=$data_month_now;?>
         //   console.log(holiDays);
         //console.log(activeDay());
         $('.t-datepicker').tDatePicker({
         	titleMonths: ['Th 1','Th 2','Th 3','Th 4','Th 5',
         	'Th 6','Th 7','Th 8','Th 9','Th 10','Th 11','Th 12'],
         	titleDays: ['T2','T3','T4','T5','T6','T7','CN'],
         	dateCheckIn: '<?=$time_from?>',
         	dateCheckOut: '<?=$time_to?>',
         	formatDate: 'yyyy-mm-dd',
         	titleDateRanges    : 'Đêm',
         	showDateTheme: 'yyyy-mm-dd',
            fnDataEvent: holiDays,
         	titleCheckIn: '',
         	titleCheckOut: '',
         	showFullDateRanges : true,
         	mergeDataEvent : true,
         	titleDateRange: 'Đêm',
         	toDayShowTitle: true,
         	titleToday: 'Hôm nay',
         	iconDate: '<i class="fa fa-calendar"></i><span class="day_in">111</span>',
         }).on('eventClickDay',function(e, dataDate){
         	var check_in=new Date(dataDate[0]);
         	var check_out=new Date(dataDate[1]);
         	$(".t-check-in .day_in").html(date(check_in));
         	$(".t-month-check-in").html(" Tháng "+(parseInt(check_in.getMonth())+1));
            //$(".t-year-check-in").html();
            $(".t-check-out .day_in").html(date(check_out));
            $(".t-month-check-out").html(" Tháng "+(parseInt(check_out.getMonth())+1));
            //$(".t-year-check-out").html();
        });
         str_from=$(".t-input-check-in").val();
         var dates = new Date(str_from.split("-")[0],parseInt(str_from.split("-")[1]-1),parseInt(str_from.split("-")[2]));
         $(".t-month-check-in").html(" Tháng "+parseInt(str_from.split("-")[1]));
         $(".t-check-in .day_in").html(date(dates));
         str_from=$(".t-input-check-out").val();
         var dates = new Date(str_from.split("-")[0],parseInt(str_from.split("-")[1]-1),parseInt(str_from.split("-")[2]));
         $(".t-month-check-out").html(" Tháng "+parseInt(str_from.split("-")[1]));
         $(".t-check-out .day_in").html(date(dates));



     });
		$(".input-number-user").click(function(){
			$(this).find(".form_v").toggleClass("active");
			return false;
		});
		$(".item_address").click(function(){
			name=$(this).parent("li").attr("name");
			$(".input-search").find("input").val(name);
		});
		$(".input-search").click(function(){
			$(this).find(".form_v").toggleClass("active");
			return false;
		});
		$(window).click(function() {
			$(".form_v").removeClass("active");
        // return false;
    });
		var today =  new Date();
    // console.log(new Date());
    // console.log(today);
    $("#t_to").html(date(today));
    $("#t_from").html(date(today));

    function date(today){
    	var weekday = new Array(7);
    	weekday[1]=  "Thứ hai";
    	weekday[2] = "Thứ ba";
    	weekday[3] = "Thứ tư";
    	weekday[4] = "Thứ năm";
    	weekday[5] = "Thứ sáu";
    	weekday[6] = "Thứ bảy";
    	weekday[0] = "Chủ nhật";
    	return weekday[today.getDay()]; 
    }


    $(document).ready(function(){
    	$(".number_vs").click(function(){
            //activeDay();
        });
    	var max_v=9;
    	var min_v=1;
    	var max_c=2;
    	$(".prev_btn").click(function(){
    		var counts=parseInt($(this).closest(".item_v").find(".count_v").html());
    		check=1;
    		if(counts){
    			if($(this).closest(".item_v").hasClass("count_p")){
    				count=parseInt($("#count_adults").html());
    				count--;
    				if(count && count>=min_v){
    					$("#count_adults").html(count);
    					check=0;
    					$(".count_p").find(".prev_btn").removeClass("hiddens");
    					$(".count_p").find(".next_btn").removeClass("hiddens");
    					$("#number_p").val(count);

    					if(count%2){
    						$(".room").find(".count_v").html(parseInt(count/2)+1);
    						$("#room_id").html(parseInt(count/2)+1);
    					}else{
    						$(".room").find(".count_v").html(parseInt(count/2));
    						$("#room_id").html(parseInt(count/2));
    					}
    					max_c=count;
    					$chidren=parseInt($("#count_children").html());
    					if($chidren>max_c){
    						$("#number_chi").val(max_c);
    						$("#count_children").html(max_c);
    						$(".count_chi .count_v").html(max_c);
    					}
    				}  
    			}
    			if($(this).closest(".item_v").hasClass("count_chi")){
    				count=parseInt($("#count_children").html());
    				count--;
    				if(count>=0){
    					$("#count_children").html(count);
    					check=0;
    					$(".count_chi").find(".prev_btn").removeClass("hiddens");
    					$(".count_chi").find(".next_btn").removeClass("hiddens");
    					$("#number_chi").val(count);
    				}
    			}
                    // nếu là phòng thì tự động tăng người lớn
                    if($(this).closest(".item_v").hasClass("room")){
                    	var val=parseInt($(this).closest(".item_v").find(".count_v").html());
                    	if((val-1)>0){
                    		val--;
                        //count=parseInt($(this).closest(".item_v").find(".count_v").html());
                        count=val*2;
                        // console.log(count/2);
                        $(this).closest(".item_v").find(".count_v").html(val);
                        $("#room_id").html(val);
                        $(".count_p").find(".count_v").html(count);
                        $(".count_p").find(".next_btn").removeClass("hiddens");
                        $(".count_p").find(".prev_btn").removeClass("hiddens");
                        $("#number_p").val(count);
                        $("#count_adults").html(count);
                        check=0;
                    }

                }
                if(!check){
                	counts--;
                	$(this).closest(".item_v").find(".count_v").html(counts);
                }
                else{
                	if($(this).closest(".item_v").hasClass("count_chi")){
                		$(".count_chi").find(".prev_btn").addClass("hiddens");
                	}
                	if($(this).closest(".item_v").hasClass("count_p")){
                		$(".count_p").find(".prev_btn").addClass("hiddens");
                	}
                }
                $("#room_id").html($(".room").find(".count_v").html());
            }
            return false;
        });

    	$(".next_btn").click(function(){
    		var counts=parseInt($(this).closest(".item_v").find(".count_v").html());
    		check=1;
    		if(counts>=0){
    			if($(this).closest(".item_v").hasClass("count_p")){
    				count=parseInt($("#count_adults").html());
    				count++;
    				if(count && count<=max_v){
    					$("#count_adults").html(count);
    					check=0;
    					$(".count_p").find(".next_btn").removeClass("hiddens");
    					$(".count_p").find(".prev_btn").removeClass("hiddens");
    					$("#number_p").val(count);
    					if(count%2){
    						$(".room").find(".count_v").html(parseInt(count/2)+1);
    						$("#room_id").html(parseInt(count/2)+1);
    					}else{
    						$(".room").find(".count_v").html(parseInt(count/2));
    						$("#room_id").html(parseInt(count/2));
    					}
    					max_c=count;
    					$chidren=parseInt($("#count_children").html());
    					if($chidren>max_c){
    						$("#number_chi").val(max_c);
    						$("#count_children").html(max_c);
    						$(".count_chi .count_v").html(max_c);
    					}
    				}  
    			}
    			if($(this).closest(".item_v").hasClass("count_chi")){
    				count=parseInt($("#count_children").html());
    				count++;
    				if(count && count<=max_c){
    					$("#count_children").html(count);
    					check=0;
    					$(".count_chi").find(".next_btn").removeClass("hiddens");
    					$(".count_chi").find(".prev_btn").removeClass("hiddens");
    					$("#number_chi").val(count);

    				}
    			}
    			if($(this).closest(".item_v").hasClass("room")){
                    // lấy số phòng
                    var val=parseInt($(this).closest(".item_v").find(".count_v").html());
                    if(val*2<max_v){
                    	val++;
                    	count=val*2;
                    	$(this).closest(".item_v").find(".count_v").html(val);
                    	$("#room_id").html(val);
                    	$(".count_p").find(".count_v").html(count);
                    	$(".count_p").find(".next_btn").removeClass("hiddens");
                    	$(".count_p").find(".prev_btn").removeClass("hiddens");
                    	$("#number_p").val(count);
                    	$("#count_adults").html(count);
                    	check=0;
                    }
                }
                if(!check){
                	counts++;
                	$(this).closest(".item_v").find(".count_v").html(counts);
                }
                else{
                	if($(this).closest(".item_v").hasClass("count_chi")){
                		$(".count_chi").find(".next_btn").addClass("hiddens");
                	}
                	if($(this).closest(".item_v").hasClass("count_p")){
                		$(".count_p").find(".next_btn").addClass("hiddens");
                	}
                }
            }
            $("#room_id").html($(".room").find(".count_v").html());
            return false;
        });
    	count_p=$("#number_p").val();
    	count_c=$("#number_chi").val();
    	$("#count_adults").html(count_p);
    	$(".count_p .count_v").html(count_p);
    	if(count_p%2){
            //$(".room").find(".count_v").html(parseInt(count/2)+1);
            $("#room_id").html(parseInt(count_p/2)+1);
        }else{
            //$(".room").find(".count_v").html(parseInt(count/2));
            $("#room_id").html(parseInt(count_p/2));
        }
        max_c=count_p;
        $("#count_children").html(count_c);
        $(".count_chi .count_v").html(count_c);
    });
</script>
<?php if(isset($_GET['id'])){?>
	<?php if(($count+$count_chi)%2 && ($count+$count_chi)>2){?>
		<div class="popup">
			<div class="content">
				<h3>Thông báo</h3>
				<p>Bạn có lựa chọn kê thêm giường vì số lượng phòng  không đủ cho số người hiện tại</p>
				<a  href="<?= Url::to(['/combo/order-combo/order', 'id' => $_GET['id'], 'room' => (isset($_GET['room']))?$_GET['room']:'','bed'=>1]) ?>">Lựa chọn</a>
				<a  href="<?= Url::to(['/combo/order-combo/order', 'id' => $_GET['id'], 'room' => (isset($_GET['room']))?$_GET['room']:'']) ?>">Không chọn</a>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".order_btn").click(function(){
					$(".popup").addClass("active");
					return false;
				});
			})
		</script>
		<style type="text/css">
			.popup{
				position: fixed;
				background: rgba(0,0,0,.5);

				left: 0;
				top: 0;
				width: 100%;

				display: flex;
				align-items: center;
				overflow: hidden;
				z-index: -1;
				opacity: 0;
				height: 0;
			}
			.popup.active {
				overflow: visible;
				z-index: 9999;
				opacity: 1;
				height: 100%;
			}
			.popup .content{
				width: 300px;
				background: #fff;

				transition: all 2s;
				margin-top: -100%;
			}
			.popup.active .content{
				margin: 0 auto;
			}
			.popup .content h3{
				text-align: center;
				margin: 0px;
				padding: 15px;
				background: #1A3863;
				color: #fff;
				font-size: 18px;
				text-transform: uppercase;
				font-weight: 700;
			}

			.popup .content p{
				color: #000000d9;
				padding: 10px 15px;
				text-align: center;
			}
			.popup .content a{
				display: inline-block;
				padding: 7px 15px;
				background: red;
				margin-left: 35px;
				margin-bottom: 15px;
				color: #fff;
				background: #1A3863;
			}
			.popup .content a:last-child{
				float: right;
				background: #0a651e;
				margin-right: 35px;
			}
		</style>
	<?php } ?>
	<?php } ?>