<?
if($this->session->userdata('rank') ==2) {
}
else{
	redirect('~team5/admin/room');
}
?>
<br>
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
                <div class="container-fluid ">
					<p></p>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">객실관리</h1>
				<div class="row">
                    <!-- DataTales Example -->
                    <div class="card shadow mr-4 col" style="padding:0px" >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">객실추가</h6>
                        </div>
                        <div class="card-body ">
							<form name="form1" method="post" enctype="multipart/form-data" class="user">
							  <div class="row">
								  <div class="form-group col ">
										<select class="form-control forma" name="hotel_no" style="font-size: .8rem; border-radius: 10rem ; height:3.2rem ;">
										<option value="">선택하세요</option>
										<?
											$hotel_no=set_value("hotel_no");
											foreach($list as $row)
											{
												if($row->no==$hotel_no)
													echo("<option value='$row->no' selected> $row->name</option>");
												else
													echo("<option value='$row->no'> $row->name</option>");
											}
										?>
										</select>
										<div style="height:24px">
										<?if(form_error("hotel_no")==true)echo form_error("hotel_no");?>
										</div>
								  </div>
								  <div class="form-group col">
								<input type="text" class="form-control form-control-user" name="name" placeholder="객실명">
										<div style="height:24px">
										<?php if(form_error("name")==true) echo form_error("name"); ?>
										</div>
								  </div>
							  </div>


							   

							  <div class="form-group">
								<input type="text" class="form-control form-control-user" name="price" placeholder="단가">
								<div style="height:24px">
								<?php if(form_error("price")==true) echo form_error("price"); ?>
								</div>
							  </div>							  
							 <div class="form-group">
								<input type="text" class="form-control form-control-user" name="max_member" value="" placeholder="최대인원">
								<div style="height:24px">
								<?php if(form_error("max_member")==true) echo form_error("max_member"); ?>
								</div>
							  </div>

							  <div class="form-group">
								<input type="text" class="form-control form-control-user" name="bigo" placeholder="비고">
							  </div>

							 <div class="radioGroup">
							 <label >옵션선택</label></br>
							 <?php
								foreach($list_detail as $row)
								{	
									echo("<input type='checkbox' name='detail[]' value='$row->no'/>$row->name ");
								}
							 ?>
							 </div>
							 <div class="mt-3">
							 <?php
							  	for($i=1 ; $i<$totalPic+1; $i++){
									echo("사진$i<input type='file' name='pic$i' value='0' class=''>");
								}
							  ?>
							  </div>
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




