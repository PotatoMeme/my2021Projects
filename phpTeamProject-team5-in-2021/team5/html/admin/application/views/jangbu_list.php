<?php
	$tmp = $text1 ? "/text1/$text1/text2/$text2/text3/$text3/text4/$text4/page/$page" : "/page/$page"; 
?>
 <?
if($this->session->userdata('rank') >=1) {
}
else{
	redirect('~team5/admin/login');
}
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
			form1.action="/~team5/admin/jangbu/lists/text1/" + form1.text1.value + "/text2/" + form1.text2.value + "/text3/" + form1.text3.value + "/text4/" + form1.text4.value;
			form1.submit();
		}

		$(function() {

			$("#table_list").on("click",".ajax_del",function(){
				if(confirm('삭제할까요?')){
				$.ajax({
					url:"/~team5/admin/jangbu/delete",
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
										<div class="col-1" align="right" >  
											<?if($this->session->userdata("rank") == 2) {?>
											<a href="/~team5/admin/jangbu/add<?=$tmp;?>" class="btn btn-primary" type="button">
											추가
											</a><?}?>
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
											<td><?=$row->room_name?>(<?=$row->hotel_name?>)</td>
				                            <td><a href="/~team5/admin/jangbu/view/no/<?=$no?><?=$tmp?>"><?=$row->member_name?></a></td>
											<td><?=$row->inday?></td>
											<td><?=$row->exitday?></td>
											<td><?=$row->days?>박</td>
											<td><?=number_format($row->price)?></td>
											<td><?=$row->bigo?></td>
											<td>
											<?if($this->session->userdata("rank") == 2) {?>
											<a href="#" rowno="<?=$no; ?>"class="ajax_del btn btn-sm mycolor1"><i class='fas fa-trash'></i></a><?}?>
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
