 <?
if($this->session->userdata('rank') >=1) {
}
else{
	redirect('~team5/admin/login');
}
?>
 <style>
h4{
color:black
 }
 </style>
  <?php
	$tmp = $text1 ? "/text1/$text1/page/$page" : "/page/$page"; 
	
?>
		<!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid ">
					<p></p>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">예약관리</h1>
				<div class="row">
                    <!-- DataTales Example -->
                    <div class="card shadow mr-4 col" style="padding:0px" >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">예약상세</h6>
                        </div>
                        <div class="card-body ">
							<form name="form1" method="post" enctype="multipart/form-data" class="user">
							   <div class="row">
								  <div class="form-group col">
									 	<label>예약객실</label>
										<h4><?=$row->room_name?>(<?=$row->hotel_name?>)</h4>
								  </div>
								  <div class="form-group col">
										<input type="hidden" name="room_no" >
										<label>예약자</label>
										<h4><?=$row->member_name?></h4>
								  </div>
							  </div>
							   
							  <div class="row">
								  <div class="form-group col">
										<label>기간</label>
										<h4 ><?=$row->inday?> ~ <?=$row->exitday?> (<?=$row->days?>박)</h4>
								  </div>
								  <div class="form-group col">
									<div class="row mx-1">
									
										</div>
								  </div>
							  </div>
							 
							 
							<div class="form-group">
							  <label>선태 옵션</label>
							  <h4><?php
								$price = 0;
								foreach($selectedDetail as $row1){
									
									echo(" $row1->detail_name ($row1->detail_price) ");
									$price = $price + $row1->detail_price;
							
								}
								$roomPrice = $price + $row->room_price
							 ?></h4>
								
								<?
								//var roomprice = (5*totalprice)/((form1.roomCharge.value*4)+(5*days))
								
								?>
							  </div>
							<div style="height:24px"></div>
							  <div class="form-group">
								<label>방 단가</label>
								<h4><?=number_format($row->room_price)?> + <?=number_format($price)?> = <?=number_format($roomPrice)?> </h4>
								<div style="height:24px">
								</div>
							  </div>							  
	
								<div style="height:24px"></div>
							  <div class="form-group">
								<label>결제금액</label>
								<h4><?=number_format($row->price)?></h4>
								<div style="height:24px">
								</div>
							  </div>							  
							 
							  <div class="form-group">
							  <label>비고</label>
								<p><?=$row->bigo?></p>
							  </div>
								<div style="height:24px"></div>
								<?if($this->session->userdata("rank") == 2) {?><a href="/~team5/admin/jangbu/edit/no/<?=$row->no?><?=$tmp?>" class="btn btn-user btn-block btn-primary" type="button">수정</a><?}?>
							</form>
                        </div>
						</div>
					</div>
                </div>
                <!-- /.container-fluid -->
					<!--
					<div class="card shadow mr-4 col" style="padding:0px" >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">리뷰상세</h6>
                        </div>
                        <div class="card-body ">
							<form name="form1" method="post" enctype="multipart/form-data" class="user">
							   <div class="row">
							   
							   <div class="row">
									<table class="b">
										<tr>ㅣ
											<td width="30%">작성자</td>
											<td width="40%">누구요</td>
											<td width="30%">객실</td>
											<td>스위트룸</td>
										</tr>
										<tr>
											<td>예약번호</td>
											<td>123123</td>
										</tr>
										<tr>
											<td>후기제목</td>
										</tr>
										<tr>
											<td>후기내용</td>
										</tr>
									</table>
									</div>
							   
							</div>
						</div>
						<!---->
            </div>
            <!-- End of Main Content -->
