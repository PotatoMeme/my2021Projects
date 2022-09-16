<?php
	$tmp = $text1 ? "/text1/$text1/page/$page" : "/page/$page"; 
?>

<script>
		function find_text()
		{
			if(!form1.text1.value)
				form1.action="/~team5/admin/findroom/lists";
			else
				form1.action="/~team5/admin/findroom/lists/text1/" + form1.text1.value;
			form1.submit();
		}
		function SendMember(no, name, prices){
			opener.form1.room_no.value = no;
			opener.form1.room_name.value = name;
			opener.form1.roomPrice.value = prices;
			opener.select_room();
			self.close();
		}
			//var room_no = opener.form1.getElementById('#room_no'); //trigger, .change 등  이벤트 강제발생 필요

</script>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
					<p></p>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">객실조회</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Room</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
							<form name="form1"action="" method="post">
									<div class="row" style="margin:0px;">
										<div class="col-3" align="left">            
											<div class="input-group  input-group-sm">
												<div class="input-group-prepend">
													<span class="input-group-text">객실명</span>
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
                                            <th width="10%">No.</th>
                                            <th width="20%">호텔명</th>
                                            <th width="20%">객실명</th>
                                            <th width="20%">금액</th>
											<th width="10%">비고</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									foreach($list as $row)
									{
										$no=$row->no;
										//$rank = $row->rank == 0 ? "?????":"?????";
										//<td><?=$row->hotel_name
									?>
                                        <tr id="rowno<?=$no;?>">
                                            <td><?=$no?></td>
				                            <td><?=$row->hotel_name?></a></td>
				                            <td><a href="/~team5/admin/findroom/view/no/<?=$no?><?=$tmp?>"><?=$row->name?></a></td>
				                            <td><?=number_format($row->price+$row->detail_prices)?></td>
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
