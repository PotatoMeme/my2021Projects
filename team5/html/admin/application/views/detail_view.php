 <?
if($this->session->userdata('rank') ==2) {
}
else{
	redirect('~team5/admin/dashboard');
}
?>
 <script>
	$(function(){
		$('#writeday') .datetimepicker({
			locale: 'ko',
			format: 'YYYY-MM-DD',
			defaultDate: moment()
		});
	});
 </script>
 <?php
	$tmp = $text1 ? "/text1/$text1/page/$page" : "/page/$page"; 
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
                    <h1 class="h3 mb-2 text-gray-800">옵션관리</h1>
				<div class="row">
                    <!-- DataTales Example -->
                    <div class="card shadow mr-4 col" style="padding:0px" >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">옵션상세</h6>
                        </div>
                        <div class="card-body ">
							<form name="form1" method="post" enctype="multipart/form-data" class="user">
							  <div class="row">
								 <div class="form-group col">
									<label>옵션명</label>
										<h4 style="color:black"><?=$row->name?></h4>
										<div style="height:24px">
										</div>
								  </div>
							  </div>
							  <div class="form-group">
							    <label>가격</label>
								<h4 style="color:black"><?=number_format($row->price)?></h4>
								<div style="height:24px">
								</div>
							  </div>							  
							  <div class="form-group">
							  <label>비고</label>
								<h4 style="color:black"><?=$row->bigo?></h4>
							  </div>
								<div style="height:24px"></div>
								<?if($this->session->userdata("rank") == 2) {?><a href="/~team5/admin/detail/edit/no/<?=$row->no?><?=$tmp?>" class="btn btn-user btn-block btn-primary" type="button">수정</a><?}?>
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
