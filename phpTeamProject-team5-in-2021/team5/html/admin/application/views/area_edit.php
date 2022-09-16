<br>
<?
if($this->session->userdata('rank') ==2) {
}
else{
	redirect('~team5/admin/area');
}
?>
<script>
</script>
<!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid ">
					<p></p>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">AREA</h1>
				<div class="row">
                    <!-- DataTales Example -->
                    <div class="card shadow mr-4 col" style="padding:0px" >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">지역수정</h6>
                        </div>
                        <div class="card-body ">
							<form name="form1" method="post" enctype="multipart/form-data" class="user">
							  							  
							 
							  
							  <div class="row">
								  <div class="form-group col">
									<input type="text" class="form-control form-control-user" name="name" value="<?=$row->name; ?>" placeholder="지역명">
									<div style="height:24px">
									<?php if(form_error("name")==true) echo form_error("name"); ?>
									</div>
								  </div>

								  <div class="form-group col ">
								  </div>
							  </div>

							  <div class="row">
								 <div class="form-group col">
									<input type="text" class="form-control form-control-user" name="video" value="<?=$row->video; ?>" placeholder="유튜브주소">
									<div style="height:24px">
									</div>
								 </div>
								 <div class="form-group col">
									<input type="text" class="form-control form-control-user" name="gps" value="<?=$row->gps;?>" placeholder="네이버GPS좌표">
									<div style="height:24px">
									</div>
								 </div>
							  </div>

							  <div class="form-group">
								<textarea type="text" class="form-control " name="intro1" placeholder="소개글"><?=$row->intro1;?></textarea>
								<div style="height:24px">
								<?php if(form_error("juso")==true) echo form_error("juso"); ?>
								</div>
							  </div>
							  
							  <div class="form-group">
								<textarea type="text" class="form-control " name="intro2" placeholder="영상소개"><?=$row->intro2;?></textarea>
								<div style="height:24px">
								<?php if(form_error("juso")==true) echo form_error("juso"); ?>
								</div>
							  </div>
							<hr>
							<div class="form-group form-control-user">
								<div class="row">
									<div class='col-2'>
									  <input type='file' name='pic1' value='<?=$row->pic1?>' class='form-control mb-3'>
									  <b>파일이름</b> : <?=$row->pic1?>
									  <img src='/~team5/imgs/area_img/thumb/<?=$row->pic1?>' width='200' class='img-fluid img-thumbnail'>
									</div>

									<div class='col-2'>
									  <input type='file' name='pic2' value='<?=$row->pic2?>' class='form-control mb-3'>
									  <b>파일이름</b> : <?=$row->pic2?>
									  <img src='/~team5/imgs/area_img/thumb/<?=$row->pic2?>' width='200' class='img-fluid img-thumbnail'>
									</div>
								</div>
							</div>
							

							  <button type="submit" class="btn btn-user btn-block btn-primary">완료</button>
							</form>
                        </div>
						</div>
							
					</div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->




