<?
	$tmp = $text1 ? "/text1/$text1/page/$page" : "/page/$page";
?>
<?
if($this->session->userdata('rank') >=1) {
}
else{
	redirect('~team5/admin/area');
}
?>
<script>
	function zoomPicFunc(img){
		var modal = document.getElementById("zoomPic");
		document.getElementById("imgArea").innerHTML = "<img src='/~team5/imgs/area_img/"+img+"' class='img-fluid '>";
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
                    <h1 class="h3 mb-2 text-gray-800" style="font-weight:600;">AREA</h1>
				<div class="row">
                    <!-- DataTales Example -->
                    <div class="card shadow mr-4 col" style="padding:0px" >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">지역관리</h6>
                        </div>
                        <div class="card-body">
							<form name="form1" method="post" enctype="multipart/form-data">
							  <div class="form-group">
								<label>지역명</label>
								<h4 style="color:black"><?=$row->name?></h4>
							  </div>
							  <div class="row ">
								  <div class="form-group col">
									<label>유튜브주소</label>
										<p style="color:black"><?=$row->video?></p>
								  </div>
								  <div class="form-group col">
									<label>지도좌표</label>
										<p style="color:black"><?=$row->gps?></p>
								  </div>
							  </div>

							  
							  <div class="form-group">
								<label>소개글</label>
									<p style="color:black"><?=$row->intro1?></p>
							  </div>
							  
							  <div class="form-group">
								<label>영상소개</label>
									<p style="color:black"><?=$row->intro2?></p>
							  </div>

							  <div class="form-group">
								<label>사진</label>
								  <div class="row">
									 <a id="PicBtn" href="#ZoomPic" data-toggle='modal' class='btn btn-sm' onClick="zoomPicFunc('<?=$row->pic1?>');" >
										<img src='/~team5/imgs/area_img/thumb/<?=$row->pic1?>' width='200' class='img-fluid img-thumbnail '>
									 </a>
									 <a id="PicBtn" href="#ZoomPic" data-toggle='modal' class='btn btn-sm' onClick="zoomPicFunc('<?=$row->pic2?>');" >
										<img src='/~team5/imgs/area_img/thumb/<?=$row->pic2?>' width='200' class='img-fluid img-thumbnail'>
									 </a>
								  </div>
							  </div>
								<?if($this->session->userdata("rank") == 2) {?>
							  <a href="/~team5/admin/area/edit/no/<?=$row->no?><?=$tmp?>" class="btn btn-primary" type="button">수정</a><?}?>
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
