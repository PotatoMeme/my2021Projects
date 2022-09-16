<?
if($this->session->userdata('rank') ==2) {
}
else{
	redirect('~team5/admin/detail');
}
?>
 <?php
	foreach($list as $row)
	{
?>
		<!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid ">
					<p></p>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800" style="font-weight:600;">옵션관리</h1>
				<div class="row">
                    <!-- DataTales Example -->
                    <div class="card shadow mr-4 col" style="padding:0px" >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">옵션수정</h6>
                        </div>
                        <div class="card-body ">
							<form name="form1" method="post" enctype="multipart/form-data" class="user">
							  <div class="row">
								 <div class="form-group col">
										<input type="text" class="form-control form-control-user" name="name" value="<?=$row->name?>" placeholder="옵션명">
										<div style="height:24px">
										<?php if(form_error("name")==true) echo form_error("name"); ?>
										</div>
								  </div>
							  </div>
							  <div class="form-group">
								<input type="text" class="form-control form-control-user" name="price" value="<?=$row->price?>" placeholder="가격">
								<div style="height:24px">
								<?php if(form_error("price")==true) echo form_error("price"); ?>
								</div>
							  </div>							  
							  <div class="form-group">
								<input type="text" class="form-control form-control-user" name="bigo" value="<?=$row->bigo?>" placeholder="비고">
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
<?php
	}
?>