<br>
<?
if($this->session->userdata('rank') ==2) {
}
else{
	redirect('~team5/admin/hotel');
}
?>
<script>
	/*function select_buisnessman()
	{
		var str;
		str = form1.sel_product_no.value;
		if(str=="")
		{
			form1.product_no.value = "";
		}
		else
		{
			str = str.split("^^");
			form1.product_no.value = str[0];
		}			
	}*/
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
                            <h6 class="m-0 font-weight-bold text-primary">호텔수정</h6>
                        </div>
                        <div class="card-body ">
							<form name="form1" method="post" enctype="multipart/form-data" class="user">
							  							  
							 
							  
							  <div class="row">
								<div class="form-group col">
								<input type="text" class="form-control form-control-user" name="name" value="<?=$row->name; ?>" placeholder="호텔명">
								
										<div style="height:24px">
										<?php if(form_error("name")==true) echo form_error("name"); ?>
										</div>
								  </div>
							

								  <div class="form-group col ">
										<select class="form-control forma" name="area_no" style="font-size: .8rem; border-radius: 10rem ; height:3.2rem ;">
										<option value="">선택하세요</option>
										<?
											
											foreach($list as $row1)
											{
												if($row->area_no==$row1->no)
													echo("<option value='$row1->no' selected> $row1->name</option>");
												else
													echo("<option value='$row1->no'> $row1->name</option>");
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
									<input type="hidden" name="member_no" value="<?=$row->member_no;?>">
									<input type="text" name="member_name" value="<?=$row->member_name;?>" class = "form-control form-control-user" placeholder="사업자" disabled>
						
									<div style="height:24px">
									<?php if(form_error("member_no")==true) echo form_error("member_no"); ?>
									</div>
								  </div>
								  
								  
							  </div>

							  <div class="form-group">
								<input type="text" class="form-control form-control-user" name="juso" value="<?=$row->juso;?>" placeholder="주소">
								<div style="height:24px">
								<?php if(form_error("juso")==true) echo form_error("juso"); ?>
								</div>
							  </div>							  
							 
							  <div class="form-group">
								<input type="text" class="form-control form-control-user" name="bigo" value="<?=$row->bigo;?>" placeholder="비고">
							  </div>
							<hr>
							<div class="form-group form-control-user">
								<div class="row">
									<input type="hidden" value="<?=$row->pic;?>" name="oldPic">
									  <?php
									   $i=0;
									   $j=1;
									  while(!empty($pic[$i])){ //공백은 출력하지 않음  
										  echo("
										  <div class='col-2'>
										  <input type='file' name='pic$j' value='$pic[$i]' class='form-control mb-3'>
										  <b>파일이름</b> : $pic[$i]
										  <img src='/~team5/imgs/hotel_img/thumb/$pic[$i]' width='200' class='img-fluid img-thumbnail'>
										  </div>");
										  $i++;
										  $j++;
									  }
										for($y=$i ; $i<$totalPic; $i++){
											echo("
											<div class='col-2'>
											<input type='file' name='pic$j' value='0' class='form-control mb-3'>
											<b>파일이름</b> :
											</div>");
											$j++;
										}
								?>
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




