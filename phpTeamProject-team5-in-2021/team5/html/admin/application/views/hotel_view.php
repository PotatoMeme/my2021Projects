<?
	$tmp = $text1 ? "/text1/$text1/page/$page" : "/page/$page";
	
?>
<?
if($this->session->userdata('rank') >=1) {
}
else{
	redirect('~team5/admin/hotel');
}
?>
<script>
	function zoomPicFunc(img){
		var modal = document.getElementById("zoomPic");
		document.getElementById("imgArea").innerHTML = "<img src='/~team5/imgs/hotel_img/"+img+"' class='img-fluid '>";
	}
</script>
		<!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
					<p></p>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800" style="font-weight:600;">호텔관리</h1>
				<div class="row">
                    <!-- DataTales Example -->
                    <div class="card shadow mr-4 col" style="padding:0px" >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">호텔확인</h6>
                        </div>
                        <div class="card-body">
							<form name="form1" method="post" enctype="multipart/form-data">
							  <div class="form-group">
								<label>호텔명</label>
								<h4 style="color:black"><?=$row->name?></h4>
							  </div>
							  <div class="row">
								  <div class="form-group col">
									<label>관리자</label>
										<h4 style="color:black"><?=$row->member_name?></h4>
								  </div>
								  <div class="form-group col">
									<label>지역</label>
										<h4 style="color:black"><?=$row->area_name?></h4>
								  </div>
							  </div>

							 <div class="form-group">
								<label>주소</label>
								<h4 style="color:black"><?=$row->juso?></h4>
							  </div>

							  <div class="form-group">
								<label>비고</label>
								<h6><?=$row->bigo? "$row->bigo" : "-"?></h6>
							  </div>

							  <div class="form-group">
								  <div class="row">
									  <? 
									  $i=0;//onClick="zoomPicFunc('1');"
									  while(!empty($pic[$i])){ //공백은 출력하지 않음
									  ?>
									  <div class="col-2">
										<label>사진</label>
											<h5 style="color:black"><?=$pic[$i]?></h5>
											<a id="PicBtn" href="#ZoomPic" data-toggle='modal' class='btn btn-sm' onClick="zoomPicFunc('<?=$pic[$i]?>');" >
											<?php
												echo("<img src='/~team5/imgs/hotel_img/thumb/$pic[$i]' width='200' class='img-fluid img-thumbnail'>");
												$i++;
										echo("</a>
									  </div>");
									  }
									  ?>
								  </div>
							  </div>
								<?if($this->session->userdata("rank") == 2) {?>
							  <a href="/~team5/admin/hotel/edit/no/<?=$row->no?><?=$tmp?>" class="btn btn-primary" type="button">수정</a><?}?>
							</form>
                        </div>
                    </div>	
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
			<div class="modal fade" id="ZoomPic" class="zoomPic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg " role="document">
					<div class="modal-content">
						<div class="modal-header bg-gradient-primary">
							<h5 class="modal-title" id="exampleModalLabel" style="color:white">확대</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body bg-light" style="text-align:center">
							<form name="form_login" method="post" action="/~sale6/login/check">
							<div id="imgArea" class="form-inline">

							</div>
							</form>
						</div>
						<div class="modal-footer alter-secondary" style="text-align:center">
							<button type="button" class="btn btn-sm btn-light" data-dismiss="modal">닫기</button>
						</div>
					</div>
				</div>
			</div>

<?
	
?>
