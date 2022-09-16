<?php
	$tmp = $text1 ? "/text1/$text1/page/$page" : "/page/$page"; 
?>

<script>
		function find_text()
		{
			if(!form1.text1.value)
				form1.action="/~team5/admin/member/lists";
			else
				form1.action="/~team5/admin/member/lists/text1/" + form1.text1.value;
			form1.submit();
		}

		$(function() {

			$("#table_list").on("click",".ajax_del",function(){
				//alert($(this).attr("rank"));
				if(confirm('삭제할까요?')){
				$.ajax({
					url:"/~team5/admin/member/delete",
					type:"POST",
					data:{
						"no":$(this).attr("rowno"),
						"rank":$(this).attr("rank")
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
                    <h1 class="h3 mb-2 text-gray-800">고객관리</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">고객</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
							<form name="form1"action="" method="post">
									<div class="row" style="margin:0px;">
										<div class="col-3" align="left">            
											<div class="input-group mt-1">
												<input type="text" name="text1" value="<?=$text1?>" class=" form-control bg-light border-0 small" placeholder="이름"
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
											<a href="/~team5/admin/member/add<?=$tmp;?>" class="btn btn-primary" type="button">
											추가
											</a>
										</div>
									</div>
								<p></p>
                                <table class="table table-bordered" id="table_list" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="5%">No.</th>
                                            <th width="20%">ID</th>
                                            <th width="20%">이름</th>
                                            <th width="20%">전화번호</th>
                                            <th width="15%">rank</th>
											<th width="15%">Bigo</th>
											<th width="5%">삭제</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									foreach($list as $row)
									{
										$no=$row->no;
										$tel1=trim(substr($row->tel,0,3));
										$tel2=trim(substr($row->tel,3,4));
										$tel3=trim(substr($row->tel,7,4));
										$tel = $tel1."-".$tel2."-".$tel3;
										$rank = $row->rank == 0 ?"고객":($row->rank == 1 ? "사업자":"관리자");
											
									?>
                                        <tr id="rowno<?=$no;?>">
                                            <td><?=$no?></td>
				                            <td><?=$row->uid?></td>
				                            <td><a href="/~team5/admin/member/view/no/<?=$no?><?=$tmp?>"><?=$row->name?></a></td>
				                            <td><?=$tel?></td>
				                            <td><?=$rank?></td>
											<td><?=$row->bigo?></td>
											<td><a href="#" rowno="<?=$no; ?>" rank="<?=$row->rank; ?> "class="ajax_del btn btn-sm mycolor1"><i class='fas fa-trash'></i></a></td>
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
