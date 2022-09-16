 <?
if($this->session->userdata('rank') ==2) {
}
else{
	redirect('~team5/admin/jangbu');
}
?>
 <script>
	$(function(){
		$('#inday') .datetimepicker({
			locale: 'ko',
			format: 'YYYY-MM-DD',
			defaultDate: moment()
		});
		$('#exitday') .datetimepicker({
			locale: 'ko',
			format: 'YYYY-MM-DD',
			defaultDate: moment()
		});

		$("#inday")  .on("dp.change", function (e) {cal_days();});
		$("#exitday").on("dp.change", function (e) {cal_days();});
		//$("#room_no").on("chagne", function (e) {cal_days();});

	});

	function find_room(){
		window.open("/~team5/admin/findroom/lists/",""," resizable=yes, scrollbars=yes, width=1000, height=650");
	}
	function find_member(){
		window.open("/~team5/admin/findmember/lists",""," resizable=yes, scrollbars=yes, width=800, height=650");
	}
	function cal_days()
	{
		var inday = form1.txtInday.value;
		var exitday = form1.txtExitday.value;
		var inday_arr = inday.split("-");
		var exitday_arr = exitday.split("-");
		form1.roomCharge.value = 0;
		
		var inDate = new Date(inday_arr[0],inday_arr[1],inday_arr[2])			//Date형식으로 변경
		var exitDate = new Date(exitday_arr[0],exitday_arr[1],exitday_arr[2]);	//Date형식으로 변경

		if(inDate < exitDate){
			var times = exitDate.getTime() - inDate.getTime();
			var days = times / (60*60*24*1000);
			form1.days.value = days							//총 숙박일
			for(var i=0; i<days; i++){  
				if(inDate.getDay() == 1 || inDate.getDay() == 2){//0:금, 1:토 / 주말가격 적용
					form1.roomCharge.value = Number(form1.roomCharge.value) + 1;	
				}
				inDate.setDate(inDate.getDate()+1);
			}
			days = form1.days.value - form1.roomCharge.value;
			form1.totalPrice.value = (form1.roomPrice.value*0.8*form1.roomCharge.value)+(form1.roomPrice.value*days); 
		}else{
			alert("날짜가 잘못되었습니다");  //@@@@@@@@ inday랑 exitday 모두예외처리 해야됨 @@@@@@@@@@@@
			var todayDate = new Date();			
			var str = todayDate.getFullYear()+'-'+(todayDate.getMonth()+1)+'-'+todayDate.getDate();
			form1.txtInday.value = str;
			todayDate.setDate(todayDate.getDate()+1);
			var str = todayDate.getFullYear()+'-'+(todayDate.getMonth()+1)+'-'+todayDate.getDate();
			form1.txtExitday.value = str;
		}
	}

	function select_room()
	{
		//alert(form1.optionDetail.value);
		var days = form1.days.value - form1.roomCharge.value;
		form1.totalPrice.value = (form1.roomPrice.value*0.8*form1.roomCharge.value)+(form1.roomPrice.value*days);
	}
	$("#room_no").on("propertychange change keyup paste input",function(){
		alert("dhk!");
		return ;
	});
	/*$("#room_no").on('input',function(){
		alert("as!");
	});*/

	
	/*window.onload = function(){
		let observer = new MutationObserver((mutations) => {
			//mutations.forEach(function(mutation){
			//	console.log(mutation);
			//});
			alert('inday속성변경');
		})
		let target = document.getElementById('inday');
		let option = { 
			attributes: true,
			characterData: true,
			attributeOldValue: true
		};
		observer.observe(target,option);

	}*/


 </script>
		<!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
					<p></p>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">예약장부</h1>
				<div class="row">
                    <!-- DataTales Example -->
                    <div class="card shadow mr-4 col" style="padding:0px" >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">예약추가</h6>
                        </div>
                        <div class="card-body">
							<form name="form1" method="post" enctype="multipart/form-data" class="user">
							  <div class="row">
								  <div class="form-group col">
									<label>예약객실</label>
									<div class="row">
										<input type="hidden" name="room_no">
										<input type="text" class="form-control form-control-user mx-2 col-8" name="room_name" placeholder="예약객실" readonly>
										<input type="button"  value="찾기" onClick="find_room();" class="btn btn-user btn-primary col mr-3">
									</div>
										<?php if(form_error("room_no")==true) echo form_error("room_no"); ?>
								  </div>
								  <div class="form-group col">
									<label>예약자</label>
									<div class="row">
										<input type="hidden" name="member_no">
										<input type="text" class="form-control form-control-user mx-2 col-8" name="member_name" id="product" placeholder="예약자" readonly>
										<input type="button" value="찾기" onClick="find_member();" class="btn btn-user btn-primary col mr-3">
									</div>
										<?php if(form_error("member_no")==true) echo form_error("member_no"); ?>
								  </div>
							  </div>

							 <div class="row">
								  <div class="form-group col">
									<label>체크인</label>
									<div class="row">
										<div class="form-group  input-group date col"  id="inday">
												<input type="text" name="txtInday"id="txtInday" value=""class="form-control form-control-user">
												<div class="input-group-append">
													<div class="input-group-text">
														<div class="input-group-addon"><i class="far fa-calendar-alt fa-lg"></i></div>
													</div>
												</div>
											</div>
									</div>
										<?php if(form_error("txtInday")==true) echo form_error("txtInday"); ?>
								  </div>
									  <div class="form-group col">
										<label>체크아웃</label>
										<div class="row">
											<div class="form-group  input-group date col" id="exitday">
												<input type="text" name="txtExitday" id="txtExitday" value="<?=$exitday?>"class="form-control form-control-user" >
												<div class="input-group-append">
													<div class="input-group-text">
														<div class="input-group-addon"><i class="far fa-calendar-alt fa-lg"></i></div>
													</div>
												</div>
											</div>
										</div>
										<?php if(form_error("txtExitday")==true) echo form_error("txtExitday"); ?>
								  </div>
							  </div>
								
							<div class="row">
								 
								  <div class="form-group col">
									<label>선택 옵션</label>
									<input type="text" class="form-control form-control-user mx-2 col-12" name="roomDetailName" placeholder="선택 옵션" onKeyUp="cal_totalPrices();" readonly>
									</div>
										
									 
							  </div>

								<div class="row">
								 <div class="form-group col">
										<label>단가(방가격 + 옵션가격)</label>
										<input type="text" class="form-control form-control-user mx-2 col-12"  name="roomPriceDetail" placeholder="단가" readonly>
											<input type="hidden" name="roomCharge"  value ="0">
											<input type="hidden" name="optionPrice"  value ="0">
											<input type="hidden" name="roomPrice"  value ="0">
											<input type="hidden" name="optionDetail"  value ="start">
										
								  </div>
								  <div class="form-group col">
									<label>총 숙박일</label>
									<input type="text" class="form-control form-control-user mx-2 col-12" name="days" placeholder="숙박일" onKeyUp="cal_totalPrices();" readonly>
									</div>
										<?php if(form_error("days")==true) echo form_error("days"); ?>
									 
							  </div><hr>
							  <div class="row">
								  <div class="form-group col">
										<label>금액(금,토는 20% 할인)</label>
										
											<input type="text" class="form-control form-control-user mx-2 col-12" name="totalPrice"  placeholder="금액" readonly>
										</div>
										<?php if(form_error("totalPrice")==true) echo form_error("totalPrice"); ?>
							  </div>
								<hr>
							  <div class="form-group">
							  <label>비고</label>
								<input type="text" class="form-control form-control-user" name="bigo" placeholder="비고">
							  </div><hr>

							  <button type="submit" class="btn btn-user btn-block btn-primary">완료</button>
							</form>
                        </div>
                    </div>
						
	                </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
