<?
	if (!$this->session->userdata('uid'))
		redirect('~team5/');
	
?>
 <script>
	

	
	

	function select_room()
	{
		//alert(form1.optionDetail.value);
		var days = form1.days.value - form1.roomCharge.value;
		form1.totalPrice.value = (form1.roomPrice.value*0.8*form1.roomCharge.value)+(form1.roomPrice.value*days);
	}
	

	function changeinDay()
	{
		var day_arr1 = form1.txtinday.value.split("/");
		form1.txtInday.value = day_arr1[2]+"_"+day_arr1[0]+"_"+day_arr1[1];
		var day_arr2 = form1.txtexitday.value.split("/");
		form1.txtExitday.value = day_arr2[2]+"_"+day_arr2[0]+"_"+day_arr2[1];
		cal_days();
	}
	function changeexitDay()
	{
		
		cal_days();
	}
	function cal_days()
	{
		var inday = form1.txtinday.value;
		var exitday = form1.txtexitday.value;
		var inday_arr = inday.split("/");
		var exitday_arr = exitday.split("/");
		form1.roomCharge.value = 0;
		form1.days.value = 0;
		var inDate = new Date(inday_arr[2],inday_arr[0],inday_arr[1])			//Date형식으로 변경
		var exitDate = new Date(exitday_arr[2],exitday_arr[0],exitday_arr[1]);	//Date형식으로 변경

		if(inDate < exitDate){
			var times = exitDate.getTime() - inDate.getTime();
			var days = times / (60*60*24*1000);
			form1.days.value = days							//총 숙박일 || inDate.getDay() == 1
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
			//alert(form1.txtInday.value);
			str = (todayDate.getMonth()+1)+'/'+todayDate.getDate() +'/'+todayDate.getFullYear();
			form1.txtinday.value = str;
			//alert(form1.txtinday.value);
			todayDate.setDate(todayDate.getDate()+1);

			str = todayDate.getFullYear()+'-'+(todayDate.getMonth()+1)+'-'+todayDate.getDate();
			form1.txtExitday.value = str;
			//alert(form1.txtExitday.value);
			str = (todayDate.getMonth()+1)+'/'+todayDate.getDate() +'/'+todayDate.getFullYear();
			form1.txtexitday.value = str;
			//alert(form1.txtexitday.value);
		}
	}
	function getCheckboxValue()  {
		const query = 'input[name="detail"]:checked';
		const selectedEls = document.querySelectorAll(query);
		  
		// 선택된 목록에서 value 찾기
		var result = "start";
		var price =0;
		selectedEls.forEach((el) => {
			result = result +"_"+ el.value;
			price = price +parseInt(el.id);
		});
		form1.optionDetail.value = result;
		form1.optionPrice.value = price;
		form1.roomPrice.value = parseInt(form1.roomPrice1.value) +parseInt(price);
		form1.roomPriceDetail.value =form1.roomPrice1.value +" + "+ price+" = "+form1.roomPrice.value;
		select_room();
		
	  
	 
	}
	



 </script>
   
	
	<!-- END nav -->

	
    <div class="hero-wrap js-fullheight" style="background-image: url('/~team5/back_img/bg_8.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-9 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
            <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="/~team5/main">Home</a></span> <span class="mr-2"><a href="/~team5/hotel">Hotel</a></span> <span>Hotel Single</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Reservation</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-degree-bg">
      <div class="container">
       <form name="form1" method="post" enctype="multipart/form-data" class="user">
							  <div class="row">
								  <div class="form-group col">
									<label>예약객실</label>
									
										<input type="hidden" value ="<?=$row->no?>" name="room_no">
										<input type="text" class="form-control form-control-user mx-2 col-12" name="room_name" placeholder="예약객실"value="<?=$row->name?>"readonly>
										
									
										<?php if(form_error("room_no")==true) echo form_error("room_no"); ?>
								  </div>
								  <div class="form-group col">
									<label>예약자</label>
									
										<input type="hidden" value = "<?=$this->session->userdata("no")?>" name="member_no">
										<input type="text" class="form-control form-control-user mx-2 col-12" name="member_name" value = "<?=$this->session->userdata("name")?>"  id="product" placeholder="예약자" readonly>
										
									
										<?php if(form_error("member_no")==true) echo form_error("member_no"); ?>
								  </div>
							  </div>
							  <?
								$time_now = date("m/d/Y");
								$three_days_ago = date("m/d/Y", strtotime($time_now."-3 days"));
							  ?>
							<div class="row">
								  <div class="form-group col">
									<label>체크인</label>
										<div class="form-group">
											<input type="text" name="txtinday"id="checkin_date" class="form-control form-control-user mx-2 col-12" value = "<?=$three_days_ago?>" placeholder="입실" onChange ="changeinDay()">
										</div>
									
										<?php if(form_error("txtinday")==true) echo form_error("txtinday"); ?>
								  </div>
								  <div class="form-group col">
									<label>체크아웃</label>
										<div class="form-group">
											<input type="text" name="txtexitday"id="checkin_date" class="form-control form-control-user mx-2 col-12" value = "<?=$time_now?>"  placeholder="퇴실" onChange ="changeexitDay()">
											<input type="hidden" name="txtInday"  value ="0">
											<input type="hidden" name="txtExitday"  value ="0">
										</div>
									
										<?php if(form_error("txtexitday")==true) echo form_error("txtexitday"); ?>
								  </div>
							  </div>

							<div class="row">
								 
								  <div class="form-group col">
									<label>선택 옵션</label>
									<div class="row">
									
									<?php
									
										foreach($selectedDetail as $row1)
										{	
											$price =number_format($row1->price);
											echo("&nbsp&nbsp&nbsp&nbsp<h4> $row1->name [$price] <input type='checkbox'style='zoom:2.0;' name='detail'id='$row1->price' value='$row1->no' onclick='getCheckboxValue()'/></h4>");
										}
									 ?>
									</div></div>
										
									 
							  </div>
								<?
									$roomPriceDetail = $row->price." +  0 = ".$row->price
								?>
								<div class="row">
								 <div class="form-group col">
										<label>단가(방가격 + 옵션가격)</label>
										<input type="text" class="form-control form-control-user mx-2 col-12"  name="roomPriceDetail"  value ="<?=$roomPriceDetail?>" placeholder="단가" readonly>
											<input type="hidden" name="roomCharge"  value ="0">
											<input type="hidden" name="optionPrice"  value ="0">
											<input type="hidden" name="roomPrice"  value ="<?=$row->price?>">
											<input type="hidden" name="roomPrice1"  value ="<?=$row->price?>">
											<input type="hidden" name="optionDetail"  value ="start">
										
								  </div>
								  <div class="form-group col">
									<label>총 숙박일</label>
									<input type="text" class="form-control form-control-user mx-2 col-12" name="days" placeholder="숙박일" value="3" onKeyUp="cal_totalPrices();" readonly>
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
    </section> <!-- .section -->


   