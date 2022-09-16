<?
if($this->session->userdata('rank') ==2) {
}
else{
	redirect('~team5/admin/review');
}
?>
 <script>
function find_member(){
	window.open("/~team5/admin/Findmember/lists","", "resizable=yes, scrollbars=yes, width=1000, height= 650");
 }
 function find_room(){
	window.open("/~team5/admin/findroom/lists","", "resizable=yes, scrollbars=yes, width=1000, height= 650");
 }
 function find_jangbu(){
	window.open("/~team5/admin/findjangbu/lists","", "resizable=yes, scrollbars=yes, width=1300, height= 650");
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
                    <h1 class="h3 mb-2 text-gray-800">리뷰관리</h1>
				<div class="row">
                    <!-- DataTales Example -->
                    <div class="card shadow mr-4 col" style="padding:0px" >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">리뷰수정</h6>
                        </div>
                        <div class="card-body ">
							<form name="form1" method="post" enctype="multipart/form-data" class="user">
							  <div class="row">
								  <div class="form-group col">
									 <div class="row mx-1">
										<input type="text" class="form-control form-control-user col mr-1" name="jangbu_no" value="<?=$row->jangbu_no?>" placeholder="예약번호">
										<input type="button" onClick="find_jangbu();" class="btn btn-user col btn-primary" value="예약조회">
									 </div>
										<?php if(form_error("member_name")==true) echo form_error("member_name"); ?>
								  </div>
								  <div class="form-group col">
									<div class="row mx-1">
									
										</div>
								  </div>
							  </div>

							   <div class="row">
								  <div class="form-group col">
									 <div class="row mx-1">
										<input type="hidden" name="member_no" value="<?=$row->member_no?>">
										<input type="text" class="form-control form-control-user col mr-1" name="member_name" placeholder="예약자명" value="<?=$row->member_name?>" Readonly>
									 </div>
										<?php if(form_error("member_name")==true) echo form_error("member_name"); ?>
								  </div>
								  <div class="form-group col">
									<div class="row mx-1">
										<input type="hidden" name="room_no" value="<?=$row->room_no?>">
										<input type="text" class="form-control form-control-user col mr-1" name="room_name" placeholder="객실명" value="<?=$row->room_name?>" Readonly>
									</div>
										<?php if(form_error("room_name")==true) echo form_error("room_name"); ?>
								  </div>
							  </div>

							  <div class="form-group">
								<input type="text" class="form-control form-control-user" name="title" value="<?=$row->title?>" placeholder="제목">
								<div style="height:24px">
								<?php if(form_error("title")==true) echo form_error("title"); ?>
								</div>
							  </div>							  
							 
							  <div class="form-group">
								<textarea class="form-control form-control-user" name="review" placeholder="후기"><?=$row->review?></textarea>
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