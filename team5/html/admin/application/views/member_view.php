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
		$rank = $row->rank == 0 ?"고객":($row->rank == 1 ? "사업자":"관리자");
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
                            <h6 class="m-0 font-weight-bold text-primary">고객추가</h6>
                        </div>
                        <div class="card-body">
							<form name="form1" method="post" enctype="multipart/form-data" class="user">
							  <div class="row">
								 <div class="form-group col">
									<label>고객명</label>
										<h4 style="color:black"><?=$row->name?></h4>
								  </div>
								  <div class="form-group col">
									<label>회원구분</label>
										<h4 style="color:black"><?=$rank?></h4>
								  </div>
							  </div>

							   <div class="row">
								 <div class="form-group col">
									<label>ID</label>
										<h4 style="color:black"><?=$row->uid?></h4>
								  </div>
								  <div class="form-group col">
									<label>Password</label>
										<h4 style="color:black"><?=$row->pwd?></h4>
								  </div>
							  </div>

							  <div class="form-group">
								<label>전화번호</label>
								<h4 style="color:black"><?=$row->tel?></h4>
							  </div>							  
							 
							  <div class="form-group">
								<label>비고</label>
								<h4 style="color:black"><?=$row->bigo?></h4>
							  </div>

							  <a href="/~team5/admin/member/edit/no/<?=$row->no?><?=$tmp?>" class="btn btn-user btn-block btn-primary" type="button">수정</a>
							</form>
                        </div>
						
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
<?
	}
?>