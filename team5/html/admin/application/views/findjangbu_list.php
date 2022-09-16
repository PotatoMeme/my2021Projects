<?php
	$tmp = $text1 ? "/text1/$text1/text2/$text2/text3/$text3/text4/$text4/page/$page" : "/page/$page"; 
?>

<script>
	$(function(){
			$('#text1') .datetimepicker({
				locale: 'ko',
				format: 'YYYY-MM-DD',
				defaultDate: moment()
			});
			$('#text2') .datetimepicker({
				locale: 'ko',
				format: 'YYYY-MM-DD',
				defaultDate: moment()
			});

			$("#text1") .on("dp.change", function (e) {find_text();});
			$("#text2") .on("dp.change", function (e) {find_text();});

		});
	
		function find_text()
		{
			form1.action="/~team5/admin/findjangbu/lists/text1/" + form1.text1.value + "/text2/" + form1.text2.value + "/text3/" + form1.text3.value + "/text4/" + form1.text4.value;
			form1.submit();
		}

		function find_text()
		{
			form1.action="/~team5/admin/findjangbu/lists/text1/" + form1.text1.value + "/text2/" + form1.text2.value + "/text3/" + form1.text3.value + "/text4/" + form1.text4.value;;
			form1.submit();
		}
		function SendJangbu(member_no, member_name, room_no, room_name, jangbu_no){
			opener.form1.member_no.value = member_no;
			opener.form1.member_name.value = member_name;
			opener.form1.room_no.value = room_no;
			opener.form1.room_name.value = room_name;
			opener.form1.jangbu_no.value = jangbu_no;
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
                    <h1 class="h3 mb-2 text-gray-800">예약관리</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">예약</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
							<form name="form1"action="" method="post" style="min-height:245px;">
									<div class="row" style="margin:0px;">
										<div class="col-11" align="left"> 
										<div class="form-inline">
											<div class="input-group  date" id="text1">
												<div class="input-group-prepend">
													<span class="input-group-text">날짜</span>
												</div>
													<input  type="text" name="text1" class="form-control" value="<?=$text1?>" onKeydown="if (event.keyCode == 13) {find_text();}">
												<div class="input-group-append">
													<div class="input-group-text">
														<div class="input-group-addon">
															<i class="far fa-calendar-alt fa-lg-sm"></i>
														</div>
													</div>
												</div>
											</div>
											&nbsp;-&nbsp;
											<div class="input-group  date" id="text2">
												<div class="input-group-prepend">
													<span class="input-group-text">날짜</span>
												</div>
													<input  type="text" name="text2" class="form-control" value="<?=$text2?>" onKeydown="if (event.keyCode == 13) {find_text();}">
												<div class="input-group-append">
													<div class="input-group-text">
														<div class="input-group-addon">
															<i class="far fa-calendar-alt fa-lg-sm"></i>
														</div>
													</div>
												</div>
											</div>
											&nbsp;&nbsp;
											<div class="input-group ">
												<div class="input-group-prepend">
													<span class="input-group-text">지역별</span>
												</div>
												<div class="input-group-append">
													<select name="text3" class="form-control " onchange="javascript:find_text();">
														<option value="0">전체</option>
													<?php
														foreach($list_area as $row)
														{
															if($row->no == $text3)
																echo("<option value='$row->no' selected>$row->name</option>");
															else
																echo("<option value='$row->no'>$row->name</option>");
														}
													?>
													</select>
												</div>
											</div>
											&nbsp;&nbsp;
											<div class="input-group ">
												<div class="input-group-prepend">
													<span class="input-group-text" >호텔별</span>
												</div>
												<div class="input-group-append">
													<select name="text4" class="form-control " onchange="javascript:find_text();">
														<option value="0">전체</option>
													<?php
														foreach($list_hotel as $row)
														{
															if($row->no == $text4)
																echo("<option value='$row->no' selected>$row->name</option>");
															else
																echo("<option value='$row->no'>$row->name</option>");
														}
													?>
													</select>
												</div>
											</div>
										</div>
										</div>
										
									</div>
								<p></p>
                                <table class="table table-bordered" id="table_list" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="5%">No.</th>
                                            <th width="15%">객실(호텔)</th>
											<th width="10%">예약자</th>
											<th width="15%">체크인</th>
											<th width="15%">체크아웃</th>
											<th width="10%">총숙박일</th>
											<th width="10%">금액</th>
											<th width="15%">비고</th>
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
											<td><?=$row->room_name?>(<?=$row->hotel_name?>)</td>
				                            <td><a href="javascript:SendJangbu(<?=$row->member_no?>, '<?=$row->member_name?>','<?=$row->room_no?>','<?=$row->room_name?>','<?=$row->no?>');"><?=$row->member_name?></a></td>
											<td><?=$row->inday?></td>
											<td><?=$row->exitday?></td>
											<td><?=$row->days?></td>
											<td><?=number_format($row->price)?></td>
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
