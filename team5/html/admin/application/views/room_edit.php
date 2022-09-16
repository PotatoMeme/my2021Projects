<br>
<?
if($this->session->userdata('rank') ==2) {
}
else{
	redirect('~team5/admin/room');
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
                            <h6 class="m-0 font-weight-bold text-primary">객실수정</h6>
                        </div>
                        <div class="card-body ">
							<form name="form1" method="post" enctype="multipart/form-data" class="user">
							  <div class="row">
								  <div class="form-group col ">
										<select class="form-control forma" name="hotel_no" style="font-size: .8rem; border-radius: 10rem ; height:3.2rem ;">
										<option value="">선택하세요</option>
										<?
											
											foreach($list as $row1)
											{
												if($row->hotel_no==$row1->no)
													echo("<option value='$row1->no' selected> $row1->name</option>");
												else
													echo("<option value='$row1->no'> $row1->name</option>");
											}
										?>
										</select>
										<div style="height:24px">
										<?php if(form_error("hotel_no")==true) echo form_error("hotel_no"); ?>
										</div>
								  </div>
								  <div class="form-group col">
									<input type="text" class="form-control form-control-user" name="name" value="<?=$row->name; ?>" placeholder="객실명">
									
											<div style="height:24px">
											<?php if(form_error("name")==true) echo form_error("name"); ?>
											</div>
									  </div>
							  </div>
								
							   

							  <div class="form-group">
								<input type="text" class="form-control form-control-user" name="price" value="<?=$row->price;?>" placeholder="단가">
								<div style="height:24px">
								<?php if(form_error("price")==true) echo form_error("price"); ?>
								</div>
							  </div>							  
							  <div class="form-group">
								<input type="text" class="form-control form-control-user" name="max_member" value="<?=$row->max_member;?>" placeholder="최대인원">
								<div style="height:24px">
								<?php if(form_error("max_member")==true) echo form_error("max_member"); ?>
								</div>
							  </div>
							  <div class="form-group">
								<input type="text" class="form-control form-control-user" name="bigo" value="<?=$row->bigo;?>" placeholder="비고">
							  </div>

							<div class="radioGroup mb-4">
							 <label >옵션선택</label></br>
							 <?php
								//var_dump($selected_detail[0]["detail_no"]);
								//var_dump(count($selected_detail));

								foreach($list_detail as $row1)
								{	
									$row_array = array(		// selected_detail은 2차원배열, 배열로 만드는 작업이 필요
										'detail_no' => 	$row1->no
									);
									if(in_array($row_array,$selected_detail)){ 
										echo("<input type='checkbox' name='detail[]' value='$row1->no' checked/>$row1->name ");
									}
									else{
										echo("<input type='checkbox' name='detail[]' value='$row1->no'/>$row1->name ");
									}
								}

							 ?>
							 </div>
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
										  <img src='/~team5/imgs/room_img/thumb/$pic[$i]' width='200' class='img-fluid img-thumbnail'>
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




