<?php
	$tmp = $text1 ? "/text1/$text1/page/$page" : "/page/$page"; 
?>

<script>
		function find_text()
		{
			if(!form1.text1.value)
				form1.action="/~team5/admin/adminQa/lists";
			else
				form1.action="/~team5/admin/adminQa/lists/text1/" + form1.text1.value;
			form1.submit();
		}

		
		$(function() {
			$("#ajax_add").click(function(){
				var title=$("#title").val();
				var contents=$("#contents").val();
				//var name=$("#name").val(); 
				var member_no=$("#myNo").val();

				//$("#edit_name").val(name);
				//$("#edit_writeday").val(writeday);
				$.ajax({
					url:"/~team5/admin/adminQa/insert",
					type:"POST",
					data:{
						"depth2":"A",
						"title":title,
						"contents":contents,
						"member_no":member_no
					},
					dataType:"html",
					complete: function(xhr, textStatus){
					var array = xhr.responseText;
					var arr = array.split("^");
					var no = arr[0];
					var writeday = arr[1];
					var name = arr[2];
					var mno = arr[3];
					var obj = $("#table_list > tbody > tr");
						obj.eq(0).before(
							"<tr id='rowno"+no+"'>" +
							" <td>"+no+"</td>"+
							" <td style='text-align:left'><a href='#collapseEdit' type='button' class='ajax_fill' data-toggle='collapse' aria-expended='false' aria-controls='collapseEdit' data-no='"+no+"' data-title='"+title+"' data-contents='"+contents+"' data-mno='"+mno+"' data-name='"+name+"'data-writeday='"+writeday+"'>"+ title +"</a>"+ "<a href='#collapseReply' data-toggle='collapse' aria-expended='false' aria-controls='collapseReply' class=' btnReply btn btn-sm btn-primary' depth1='"+no+"' depth2='A'>답글</a></a> </td>"+
							" <td>"+writeday+"</td>"+
							" <td><input type='hidden' name='member_no' value='"+member_no+"'>"+name+"</td>"+
							" <td><a href='#' rowno='"+no+"' class='ajax_del btn btn-sm mycolor1'><i class='fas fa-trash'></i></a></td>" +
							"</tr>");

						$("#title").val("");
						$("#contents").val("");
					}

				});
				//$("#collapseExample").collapse({toggle: false}).collapse('hide');
			});

			$("#table_list").on("click",".ajax_del",function(){
				if(confirm('삭제할까요?')){
				$.ajax({
					url:"/~team5/admin/adminQa/delete",
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

			$(".ajax_reply").click(function(){
				var depth1 =$("#depth1Reply").val();
				var depth2=$("#depth2Reply").val();
				var title=$("#titleReply").val();
				var contents=$("#contentsReply").val();
				var member_no=$("#myNo").val();
				//console.log(title); console.log(contents); console.log(member_no); console.log(no + " : " + depth2);	
				$.ajax({
					url:"/~team5/admin/adminQa/reply",
					type:"POST",
					data:{
						"depth1":depth1,
						"depth2":depth2,
						"title":title,
						"contents":contents,
						"member_no":member_no
					},
					dataType:"text",
					complete:function(xhr, textStatus){
						var no = xhr.responseText;
						//var aa = no.join();
						//console.log('no:'+no);
						///var a = no.toString();
						//a = a.join();
						console.log('a='+no);
					}

				});
			});

			$("#table_list").on("click",".btnReply",function(){
				var depth1 = $(this).attr("depth1");
				var depth2 = $(this).attr("depth2");				
				$('#depth1Reply').val(depth1);
				$('#depth2Reply').val(depth2);
				
			});

			$("#table_list").on("click",".ajax_fill",function(){
				var no =$(this).attr("data-no");
				var title =$(this).attr("data-title");
				var contents =$(this).attr("data-contents");
				var writeday =$(this).attr("data-writeday");
				var name =$(this).attr("data-name");
				var member_no = $(this).attr("data-mno");

				$("#edit_no").val(no);
				$("#edit_title").val(title);
				$("#edit_contents").val(contents);
				$("#edit_writeday").val(writeday);
				$("#edit_name").val(name);
				$("#edit_mno").val(member_no);
			});

			$("#ajax_edit").click(function(){
				var no =$("#edit_no").val();
				var title = $("#edit_title").val();
				var contents = $("#edit_contents").val();
				var writeday = $("#edit_writeday").val();
				var name = $("#edit_name").val();
				var mno = $("#edit_mno").val();

				$.ajax({
					url:"/~team5/admin/adminQa/update",
					type:"POST",
					data:{
						"no":no,
						"title":title,
						"contents":contents
					},
					dataType:"text",
					complete:function(xhr, textStatus){
						$('#rowno'+no).replaceWith(
							"<tr id='rowno"+no+"'>" +
							" <td>"+no+"</td>"+
							" <td style='text-align:left'><a href='#collapseEdit' type='button' class='ajax_fill' data-toggle='collapse' aria-expended='false' aria-controls='collapseEdit' data-no='"+no+"' data-title='"+title+"' data-contents='"+contents+"' data-mno='"+mno+"' data-name='"+name+"'data-writeday='"+writeday+"'>"+ title +"</a>"+ "<a href='#collapseReply' data-toggle='collapse' aria-expended='false' aria-controls='collapseReply' class=' btnReply btn btn-sm btn-primary' depth1='"+no+"' depth2='A'>답글</a></a> </td>"+
							" <td>"+writeday+"</td>"+
							" <td><input type='hidden' name='member_no' value='"+mno+"'>"+name+"</td>"+
							" <td><a href='#' rowno='"+no+"' class='ajax_del btn btn-sm mycolor1'><i class='fas fa-trash'></i></a></td>" +
							"</tr>");
					}
			});
			$("#collapseEdit").collapse("hide");
		});
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
                    <h1 class="h3 mb-2 text-gray-800">QnA게시판</h1>
					<? 
						$myNo = $this->session->userdata('no');
						echo("<input type='hidden' value='$myNo' name='myNo' id='myNo'>");  	
					?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">QnA</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
							<form name="form1"action="" method="post" >
							
								<div class="row" style="margin:0px;">
									<div class="col-3" align="left">            
										<div class="input-group mt-1">
											<input type="text" name="text1" value="<?=$text1?>" class=" form-control bg-light border-0 small" placeholder="제목"
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
									
										<a href="#collapseExample" style="color:white" type="button"data-toggle="collapse" aria-expended="false" aria-controls="collapseExample" class="btn btn-primary">
										추가
										</a>
									</div>
								</div>
								<p></p>
                                <table class="table table-bordered" id="table_list" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="15%">글번호</th>
											<th width="50%">제목</th>
											<th width="15%">작성일</th>
                                            <th width="15%">작성자</th>
											<td width="5%">삭제</td>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									foreach($list as $row)
									{
										$no=$row->no;
										$depth_leng=strlen($row->depth2);
									?>
                                        <tr id="rowno<?=$no;?>">
                                            <td><?=$no?></td>
                                            <td style="text-align:left">
											<? if($depth_leng>1){
													for($i=0;$i<$depth_leng-1;$i++) echo("&nbsp;&nbsp;&nbsp;&nbsp"); echo("→"); 
												} 
											?>
											<a href="#collapseEdit" class="ajax_fill" type="button" data-toggle="collapse" aria-expended="false" aria-controls="collapseEdit" data-no="<?=$no;?>" data-title="<?=$row->title;?>" data-contents="<?=$row->contents;?>" data-mno="<?=$row->member_no;?>" data-name="<?=$row->member_name;?>" data-writeday="<?=$row->writeday;?>" ><?=$row->title;?></a>
											<a id="" href="#collapseReply" data-toggle="collapse" aria-expended="false" aria-controls="collapseReply" class=" btnReply btn btn-sm btn-primary" depth1='<?=$row->depth1; ?>' depth2="<?=$row->depth2?>">답글</a></a>
											<td><?=$row->writeday;?></td>
											<td><?echo("<input type='hidden' name='member_no' value='$row->member_no'>$row->member_name"); ?></td>
											<td><a href="#" rowno="<?=$no; ?>"class="ajax_del btn btn-sm mycolor1"><i class="fas fa-trash"></i></a></td>
                                        </tr>
									<?php
									}
                                    ?>
                                    </tbody>
                                </table>
								</form>
								<div class="collapse margin5" id="collapseExample">
									<div class="card card-body" style="padding:0px 5px 0px 5px;">
										<table class="table table-sm table-bordered mymargin5 alert-primary">
											<form name="form2">
												<div class="px-5 py-3">
													<div >
													</div>
													<div class="mt-3">
														제목 <input type="text" name="title" value="" class="form-control form-control-sm" id="title">
													</div>
													<div class="mt-3">
														내용
														<textarea type="text" name="contents" value="" class="form-control form-control-sm" id="contents"></textarea>
													</div>
												</div>
												<tr>
													<td width="10%" style="vertical-align:middle">
														<a href="#" id="ajax_add" class="btn btn-sm btn-primary">등록</a>
														<a href="#collapseExample" data-toggle="collapse" aria-expended="false" aria-controls="collapseExample" class="btn btn-sm btn-primary">
														닫기</a>
													</td>
												</tr>
											</form>
										</table>
									</div>
								</div>
								<div class="collapse margin5" id="collapseReply">
									<div class="card card-body" style="padding:0px 5px 0px 5px;">
										<table class="table table-sm table-bordered mymargin5 alert-primary">
											<form name="form4">
												<div class="px-5 py-3">
													<div >
													<input type="hidden" value="" id="depth1Reply">
													<input type="hidden" value="" id="depth2Reply">
													</div>
													<div class="mt-3">
														제목2 <input type="text" name="title" value="" class="form-control form-control-sm" id="titleReply">
													</div>
													<div class="mt-3">
														내용
														<textarea type="text" name="contents" value="" class="form-control form-control-sm" id="contentsReply"></textarea>
													</div>
												</div>
												<tr>
													<td width="10%" style="vertical-align:middle">
														<a href="#" id="" class="ajax_reply btn btn-sm btn-primary">등록</a>
														<a href="#collapseReply" data-toggle="collapse" aria-expended="false" aria-controls="collapseReply" class="btn btn-sm btn-primary" >닫기</a>
													</td>
												</tr>
											</form>
										</table>
									</div>
								</div>
								<div class="collapse margin5" id="collapseEdit">
									<div class="card card-body" style="padding:0px 5px 0px 5px;">
										<table class="table table-sm table-bordered mymargin5 alert-primary">
											<form name="form3" class="px-5 py-3">
												<div class="px-5 py-3">
													<div >
													</div>
													<div class="mt-3 form-inline">
														글번호
														<input type="text" name="no" value="" class="form-control form-control-sm mr-2" id="edit_no" disabled>
														작성일
														<input type="text" name="writeday" value="" class="form-control form-control-sm mr-2" id="edit_writeday" disabled>
														작성자
														<input type="text" name="name" value="" class="form-control form-control-sm" id="edit_name"disabled>
														<input type="hidden" name="member_no" value="" class="form-control form-control-sm" id="edit_mno">
													</div>
													<div class="mt-3">
														제목 <input type="text" name="title" value="" class="form-control form-control-sm" id="edit_title">
													</div>
													<div class="mt-3">
														내용
														<textarea type="text" name="contents" value="" class="form-control form-control-sm" id="edit_contents"></textarea>
													</div>
												</div>

												<tr>
													<td width="5%" style="vertical-align:middle">
														<a href="#" id="ajax_edit" class="btn btn-sm btn-primary">수정</a>
														<a href="#collapseEdit" data-toggle="collapse" aria-expended="false" aria-controls="collapseReply" class="btn btn-sm btn-primary" >닫기</a>
													</td>
												</tr>
											</form>
										</table>
									</div>
								</div>
                            </div>
                        </div>
						<?=$pagination;?>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
