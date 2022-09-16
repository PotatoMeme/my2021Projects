<?
if($this->session->userdata('rank') >=1) {
}
else{
	redirect('~team5/admin/login');
}
?>
<?php
	$tmp = $text1 ? "/text1/$text1/page/$page" : "/page/$page"; 
?>

<script>
		function find_text()
		{
			if(!form1.text1.value)
				form1.action="/~team5/admin/review/lists";
			else
				form1.action="/~team5/admin/review/lists/text1/" + form1.text1.value;
			form1.submit();
		}

		$(function() {

			$("#table_list").on("click",".ajax_del",function(){
				if(confirm('삭제할까요?')){
				$.ajax({
					url:"/~team5/admin/review/delete",
					type:"POST",
					data:{
						"no":$(this).attr("rowno")
					},
					dataType:"text",
					complete:function(xhr, textStatus){
						var no = xhr.responseText;
						$('#rowno'+no).remove();
					}

				});
			}});
	    });
</script>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
					<p></p>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">리뷰관리</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">리뷰</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
							<form name="form1"action="" method="post">
									<div class="row" style="margin:0px;">
										<div class="col-3" align="left">            
											<div class="input-group mt-1">
												<input type="text" name="text1" value="<?=$text1?>" class=" form-control bg-light border-0 small" placeholder="작성자"
														aria-label="Search" aria-describedby="basic-addon2">
												<input type="text" style="display:none;"/>
												<div class="input-group-append">
													<button class="btn btn-primary" type="button" onClick="find_text();">
														<i class="fas fa-search fa-sm"></i>
													</button>
												</div>
											</div>
										</div>
										<div class="col-9" align="right" >  
											<?if($this->session->userdata("rank") == 2) {?>
											<a href="/~team5/admin/review/add<?=$tmp;?>" class="btn btn-primary" type="button">
											추가
											</a>
											<?}?>
										</div>
									</div>
								<p></p>
                                <table class="table table-bordered" id="table_list" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="5%">No.</th>
                                            <th width="15%">작성자번호</th>
                                            <th width="15%">객실(호텔)</th>
											<th width="10%">예약번호</th>
											<th width="20%">제목</th>
											<th width="35%">리뷰</th>
											<th width="5%">삭제</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									foreach($list as $row)
									{
										$no=$row->no;
									?>
                                        <tr id="rowno<?=$no;?>">
                                            <td><?=$no?></td>
				                            <td><a href="/~team5/admin/review/view/no/<?=$no?><?=$tmp?>"><?=$row->member_name?></a></td>
											<td><?=$row->room_name?>
											(<?=$row->hotel_name?>)</td>
											<td><?=$row->jangbu_no?></td>
											<td><?=$row->title?></td>
											<td><?=$row->review?></td>
											<td>
											<?if($this->session->userdata("rank") == 2) {?>
											<a href="#" rowno="<?=$no; ?>"class="ajax_del btn btn-sm mycolor1"><i class='fas fa-trash'></i></a>
											<?}?>
											</td>
                                        </tr>
									<?php
									}
                                    ?>
                                    </tbody>
                                </table>
								</form>
                            </div>
                        </div>
						<?=$pagination;?>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
