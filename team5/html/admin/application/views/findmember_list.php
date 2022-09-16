<?php
	$tmp = $text1 ? "/text1/$text1/page/$page" : "/page/$page"; 
?>

<script>
		function find_text()
		{
			if(!form1.text1.value)
				form1.action="/~team5/admin/Findmember/lists";
			else
				form1.action="/~team5/admin/Findmember/lists/text1/" + form1.text1.value;
			form1.submit();
		}
		function SendMember(no, name){
			opener.form1.member_no.value = no;
			opener.form1.member_name.value = name;
			self.close();
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
                    <h1 class="h3 mb-2 text-gray-800">회원조회</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Member</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
							<form name="form1"action="" method="post">
									<div class="row" style="margin:0px;">
										<div class="col-3" align="left">            
											<div class="input-group  input-group-sm">
												<div class="input-group-prepend">
													<span class="input-group-text">이름</span>
												</div>
													<input id = 's1' type="text" name="text1" class="form-control" value="<?=$text1?>" onKeydown="if (event.keyCode == 13) {find_text();}">
												<div class="input-group-append">
													<button class="btn btn-primary" type="button" onClick="find_text();">검색</button>
												</div>
											</div>
										</div>
									</div>
								<p></p>
                                <table class="table table-bordered" id="table_list" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="20%">No.</th>
                                            <th width="10%">ID</th>
                                            <th width="20%">name</th>
                                            <th width="20%">tel</th>
                                            <th width="20%">rank</th>
											<th width="10%">Bigo</th>
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
										//$rank = $row->rank == 0 ? "?????":"?????";
									?>
                                        <tr id="rowno<?=$no;?>">
                                            <td><?=$no?></td>
				                            <td><?=$row->uid?></td>
				                            <td><a href="javascript:SendMember(<?=$no?>, '<?=$row->name?>');"><?=$row->name?></a></td>
				                            <td><?=$tel?></td>
				                            <td><?=$row->rank?></td>
											<td><?=$row->bigo?></td>
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
