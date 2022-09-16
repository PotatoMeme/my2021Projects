<?
	$tmp = $text1 ? "/text1/$text1/page/$page" : "/page/$page";
	
?>
<script>
		
		function SendMember(no, name, prices){
			opener.form1.room_no.value = no;
			opener.form1.room_name.value = name;
			opener.form1.roomPrice.value = prices;// 방 가격
			
			var obj_length = document.getElementsByName("detail").length;
			var values="start";
			var names="";
			var priceDetail = 0;
			var num = 0;
			for (var i=0; i<obj_length; i++) {
				if (document.getElementsByName("detail")[i].checked == true) {
					
					values = values +"_"+document.getElementsByName("detail")[i].value;
					var makeprice = document.getElementsByName("detail")[i].id.split(' ');
					names = names +","+ makeprice[0]+"["+makeprice[1]+"]";
					
					priceDetail = Number(priceDetail) + Number(makeprice[1]);
				}
			}
			
			var makenames = names.split(',');
			names = makenames[1];
			for (var i=2; i<makenames.length; i++) {
				names = names +"," +makenames[i];
			}
			
			opener.form1.roomDetailName.value = names;// 옵션 이름들
			opener.form1.roomPriceDetail.value = prices +" + "+priceDetail + " = " + (Number(prices) + Number(priceDetail));// 단가(방가격 + 옵션가격)
			opener.form1.optionPrice.value =priceDetail;//옵션 가격 총합
			opener.form1.roomPrice.value = (Number(prices) + Number(priceDetail));// 방 가격 총합
			opener.form1.optionDetail.value =values;//옵션 번호
			opener.select_room();
			self.close();
		}
			//var room_no = opener.form1.getElementById('#room_no'); //trigger, .change 등  이벤트 강제발생 필요

</script>
<style>
	.radioGroup
	{
		border:1px solid #d1d3e2;
		margin-top:1rem;
		padding:1rem;
		border-radius:1rem;
	}
</style>
		<!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
					<p></p>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">객실관리</h1>
				<div class="row">
                    <!-- DataTales Example -->
                    <div class="card shadow mr-4 col" style="padding:0px" >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">객실확인</h6>
                        </div>
                        <div class="card-body">
							<form name="form1" method="post" enctype="multipart/form-data">
							  <div class="form-group">
								<label>No.</label>
								<h4 style="color:black"><?=$row->no?></h4>
							  </div>
							  <div class="form-group">
								<label>호텔명</label>
								<h4 style="color:black"><?=$row->hotel_name?></h4>
							  </div>
							  <div class="form-group">
								<label>객실명</label>
								<h4 style="color:black"><?=$row->name?></h4>
							  </div>
							  <div class="form-group">
								<label>단가</label>
								<h4 style="color:black"><?=number_format($row->price);?></h4>
							  </div>						  
							 
							  <div class="form-group">
								<label>비고</label>
								<h4 style="color:black"><?=$row->bigo? "$row->bigo" : "-"?></h4>
							  </div>

							  <div class="radioGroup mb-4">
							 <label >옵션</label></br>
							 <?php
								
								foreach($detailList as $row1){
									 
									echo("<input type='checkbox' name='detail' value='$row1->detail_no' id='$row1->detail_name $row1->detail_price'/> $row1->detail_name ($row1->detail_price) ");
							
								}
							 ?>
							 </div>

								
							  <a href="javascript:SendMember(<?=$row->no?>, '<?=$row->name?>','<?=$row->price?>');" class="btn btn-primary" type="button">선택</a>
							</form>
                        </div>
                    </div>	
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

<?
	
?>
