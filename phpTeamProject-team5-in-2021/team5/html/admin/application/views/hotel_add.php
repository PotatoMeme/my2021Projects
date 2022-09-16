<br>
<?
if($this->session->userdata('rank') ==2) {
}
else{
	redirect('~team5/admin/hotel');
}
?>
<br>
<script>
	
	function find_buisnessman()
	{
		window.open("/~team5/admin/findbuisnessman","","resizable = yes,scrollbars=yes,width=500,height=600");
	}
</script>
<!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid ">
					<p></p>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">호텔관리</h1>
				<div class="row">
                    <!-- DataTales Example -->
                    <div class="card shadow mr-4 col" style="padding:0px" >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">호텔추가</h6>
                        </div>
                        <div class="card-body ">
							<form name="form1" method="post" enctype="multipart/form-data" class="user">
							  							  
							 
							  
							  <div class="row">
								<div class="form-group col">
								<input type="text" class="form-control form-control-user" name="name" placeholder="호텔명">
										<div style="height:24px">
										<?php if(form_error("name")==true) echo form_error("name"); ?>
										</div>
								  </div>
							

								  <div class="form-group col ">
										<select class="form-control forma" name="area_no" style="font-size: .8rem; border-radius: 10rem ; height:3.2rem ;">
										<option value="">선택하세요</option>
										<?
											$area_no=set_value("area_no");
											foreach($list as $row)
											{
												if($row->no==$area_no)
													echo("<option value='$row->no' selected> 지역: $row->name</option>");
												else
													echo("<option value='$row->no'> 지역:  $row->name</option>");
											}
										?>
										</select>
										<div style="height:24px">
										<?php if(form_error("area_no")==true) echo form_error("area_no"); ?>
										</div>
								  </div>
							  </div>

							   <div class="row">
								   <div class="form-group col">
										<button type="button" value="사업자찾기" onClick= "find_buisnessman();" class="btn btn-user btn-block btn-primary">사업자 찾기</button>	
								  </div>
								 
								 <div class="form-group col">
									<input type="hidden" name="member_no" value="<?=set_value("member_no");?>">
									<input type="text" name="member_name" value="" class = "form-control form-control-user" placeholder="사업자" disabled>
						
									<div style="height:24px">
									<?php if(form_error("member_no")==true) echo form_error("member_no"); ?>
									</div>
								  </div>
								  
								  
							  </div>

							  <div class="form-group">
								<input type="text" class="form-control form-control-user" name="juso" placeholder="주소">
								<div style="height:24px">
								<?php if(form_error("juso")==true) echo form_error("juso"); ?>
								</div>
							  </div>							  
							 
							  <div class="form-group">
								<input type="text" class="form-control form-control-user" name="bigo" placeholder="비고">
							  </div>
							  <?php
							  	for($i=1 ; $i<$totalPic+1; $i++){
									echo("사진$i<input type='file' name='pic$i' value='0' class='form-control mb-3'>");
								}
							  ?>
								<div style="height:24px"></div>
							  <button type="submit" class="btn btn-user btn-block btn-primary">완료</button>
							</form>
                        </div>
						</div>
							
					</div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->




