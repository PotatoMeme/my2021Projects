 <?
if($this->session->userdata('rank') >=1) {
}
else{
	redirect('~team5/admin/login');
}
?>

 <script>
function find_member(){
	window.open("/~team5/Findmember/lists","", "resizable=yes, scrollbars=yes, width=1000, height= 650");
 }
 function find_room(){
	window.open("/~team5/findroom/lists","", "resizable=yes, scrollbars=yes, width=1000, height= 650");
 }
 </script>
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
                    <h1 class="h3 mb-2 text-gray-800">리뷰관리</h1>
				<div class="row">
                    <!-- DataTales Example -->
                    <div class="card shadow mr-4 col" style="padding:0px" >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">리뷰상세</h6>
                        </div>
                        <div class="card-body ">
							<form name="form1" method="post" enctype="multipart/form-data" class="user">
							<div class="row">
								  <div class="form-group col">
										<label>예약번호</label>
										<h4 ><?=$row->jangbu_no?></h4>
								  </div>
								  <div class="form-group col">
									<div class="row mx-1">
									
										</div>
								  </div>
							  </div>
							   <div class="row">
								  <div class="form-group col">
									 	<label>작성자</label>
										<h4><?=$row->member_name?></h4>
								  </div>
								  <div class="form-group col">
										<input type="hidden" name="room_no" >
										<label>객실 </label>
										<h4><?=$row->room_name?></h4>
								  </div>
							  </div>
							  <div style="height:24px">
						      </div>
							  <div class="form-group">
								<h4><?=$row->title?></h4>

							  </div>							  
							 
							  <div class="form-group">
								<p><?=$row->review?></p>
							  </div>
								<div style="height:24px"></div>
								<?if($this->session->userdata("rank") == 2) {?>
								<a href="/~team5/admin/review/edit/no/<?=$row->no?><?=$tmp?>" class="btn btn-user btn-block btn-primary" type="button">수정</a>
								<?}?>
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
