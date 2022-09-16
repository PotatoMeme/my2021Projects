<?
	$tmp = $text1 ? "/text1/$text1/page/$page" : "/page/$page";
	
?>
<style>
	.radioGroup
	{
		border:1px solid #d1d3e2;
		margin-top:1rem;
		padding:1rem;
		border-radius:1rem;
	}
</style>
		<!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
					<p></p>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">객실관리</h1>
				<div class="row">
                    <!-- DataTales Example -->
                    <div class="card shadow mr-4 col" style="padding:0px" >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">객실확인</h6>
                        </div>
                        <div class="card-body">
							<form name="form1" method="post" enctype="multipart/form-data">
							  <div class="form-group">
								<label>No.</label>
								<h4 style="color:black"><?=$row->no?></h4>
							  </div>
							  <div class="form-group">
								<label>호텔명</label>
								<h4 style="color:black"><?=$row->hotel_name?></h4>
							  </div>
							  <div class="form-group">
								<label>객실명</label>
								<h4 style="color:black"><?=$row->name?></h4>
							  </div>
							  <div class="form-group">
								<label>단가</label>
								<h4 style="color:black"><?=number_format($row->price);?></h4>
							  </div>
							  <div class="form-group">
								<label>최대인원</label>
								<h4 style="color:black"><?=number_format($row->max_member);?></h4>
							  </div>
							 
							  <div class="form-group">
								<label>비고</label>
								<h4 style="color:black"><?=$row->bigo? "$row->bigo" : "-"?></h4>
							  </div>

							  <div class="radioGroup mb-4">
							 <label >옵션</label></br>
							 <?php
								foreach($seldetail_name as $row1){
									echo("<h5>$row1->detail_name</h5>");
								}
							 ?>
							 </div>

							 <div class="form-group">
								  <div class="row">
									  <? 
									  $i=0;//onClick="zoomPicFunc('1');"
									  while(!empty($pic[$i])){ //공백은 출력하지 않음
									  ?>
									  <div class="col-2">
										<label>사진</label>
											<h4 style="color:black"><?=$pic[$i]?></h4>
											<a id="PicBtn" href="#ZoomPic" data-toggle='modal' class='btn btn-sm' onClick="zoomPicFunc('<?=$pic[$i]?>');" >
											<?php
												echo("<img src='/~team5/imgs/room_img/thumb/$pic[$i]' width='200' class='img-fluid img-thumbnail'>");
												$i++;
											echo("</a>
											</div>");
											}?>
								  </div>
							  </div>

								<?if($this->session->userdata("rank") == 2) {?>
							  <a href="/~team5/admin/room/edit/no/<?=$row->no?><?=$tmp?>" class="btn btn-primary" type="button">수정</a><?}?>
							</form>
                        </div>
                    </div>	
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

<?
	
?>
