 <script>
	$(function(){
		$('#writeday') .datetimepicker({
			locale: 'ko',
			format: 'YYYY-MM-DD',
			defaultDate: moment()
		});
	});
 </script>
 <?
	foreach($list as $row)
	{
?>
		<!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
					<p></p>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">고객관리</h1>
				<div class="row">
                    <!-- DataTales Example -->
                    <div class="card shadow mr-4 col" style="padding:0px" >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">고객수정</h6>
                        </div>
                        <div class="card-body">
							<form name="form1" method="post" enctype="multipart/form-data" class="user">
							  <div class="row">
								 <div class="form-group col">
										<input type="text" class="form-control form-control-user" name="name" value="<?=$row->name?>" placeholder="고객명">
										<div style="height:24px">
										<?php if(form_error("name")==true) echo form_error("name"); ?>
										</div>
								  </div>
								  <div class="form-group col">
										<select class="form-control" name="rank" style="font-size: .8rem; border-radius: 10rem ; height:3.2rem ;">
										<option value="0" <?if($row->rank==0) echo("selected");?>>고객</option>
										<option value="1" <?if($row->rank==1) echo("selected");?>>호텔관리자</option>
										<option value="2" <?if($row->rank==2) echo("selected");?>>사이트관리자</option>
										</select>
										<div style="height:24px">
										<?php if(form_error("rank")==true) echo form_error("rank"); ?>
										</div>
								  </div>
							  </div>

							   <div class="row">
								 <div class="form-group col">
										<input type="text" class="form-control form-control-user" name="uid" value="<?=$row->uid?>" placeholder="User ID">
										<div style="height:24px">
										<?php if(form_error("uid")==true) echo form_error("uid"); ?>
										</div>
								  </div>
								  <div class="form-group col">
										<input type="text" class="form-control form-control-user" name="pwd" value="<?=$row->pwd?>" placeholder="Password">
										<div style="height:24px">
										<?php if(form_error("pwd")==true) echo form_error("pwd"); ?>
								   		</div>
								  </div>
							  </div>

							  <div class="form-group">
								<input type="text" class="form-control form-control-user" name="tel" value="<?=$row->tel?>" placeholder="전화번호">
								<div style="height:24px">
								<?php if(form_error("tel")==true) echo form_error("tel"); ?>
								</div>
							  </div>							  
							 
							  <div class="form-group">
								<input type="text" class="form-control form-control-user" name="bigo" value="<?=$row->bigo?>" placeholder="비고">
							  </div>
								<div style="height:24px"><div>
							  <button type="submit" class="btn btn-user btn-block btn-primary">완료</button>
							</form>
                        </div>
						</div>
						</div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
<?
	}
?>