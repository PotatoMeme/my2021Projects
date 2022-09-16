
    <div class="hero-wrap js-fullheight" style="background-image: url('back_img/bg_2.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-9 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
            <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="/~team5/main">Home</a></span> <span>PERSONAL</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">개인정보</h1>
          </div>
        </div>
      </div>
    </div>

		<section class="ftco-section contact-section ftco-degree-bg">
      <div class="container">
        <div class="row d-flex mb-5 contact-info">
          <div class="col-md-12 mb-4">
            <h2 class="h4">나의 개인정보</h2>
          </div>
          <div class="w-100"></div>
          
        </div>

<?
	foreach ($list as $row)
	{
		$no=$row->no;                                    // 사용자번호
		$tel1 = trim(substr($row->tel,0,3));      // 전화 : 지역번호 추출
		$tel2 = trim(substr($row->tel,3,4));      // 전화 : 국번호 추출
		$tel3 = trim(substr($row->tel,7,4));      // 전화 : 번호 추출
		$tel = $tel1 . "-" . $tel2 . "-" . $tel3;       // 합치기
		// 0->고객, 1->호텔관리자 2->사이트관리자

?>
		
		<table>
		<tr>
			<td class="col-md-3 pr-md-5">이름</td>
			<td><div class="form-control"><?=$row->name ?></td></div>
		</tr>
		<tr>
			<td class="col-md-3 pr-md-5">아이디</td>
			<td><div class="form-control"><?=$row->uid ?></td></div>
		</tr>
		<tr>
			<td class="col-md-3 pr-md-5">전화번호</td>
			<td><div class="form-control"><?=$row->tel ?></td></div>
		</tr>
        <!-- <div class="row block-9">
                        <div class="col-md-3 pr-md-5">
                          <form action="#">
              <div class="form-group">
                <input type="text" class="form-control" value="<?=$row->name ?>">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" value="<?=$row->uid ?>">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" value="<?=$row->tel ?>">
              </div> -->
		</table>

<?
			}
?>	  


                <a href="/~team5/personal/edit/no/<?=$no ?>">
				<div class="form-group">
				<input type="submit" value="수정하기" class="btn btn-primary py-2 px-3 " > </a>
              </div> 
            </form>
			<hr>
			<h4 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">예약정보</h4>
          <table class="table table-bordered" id="table_list" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="10">No.</th>
											<th width="30%">호텔명[객실명]</th>
                                            <th width="20%">입실</th>
											<td width="20%">퇴실</td>
											<td width="10%">총 숙박</td>
											<td width="10%">가격</td>
											

                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$i=0;
									foreach($jangbu as $row1)
									{
										$no=$row->no;
										$i = $i +1;
									?>
                                        <tr id="rowno<?=$no;?>">
                                            <td><?=$i?></td>
											<td><?=$row1->hotel_name;?>[<?=$row1->room_name;?>]</td>
											<td><?=$row1->inday;?></td>
											<td><?=$row1->exitday;?></td>
											<td><?=$row1->days;?>박<?=$row1->days +1;?>일</td>
											<td><?=number_format($row1->price) ?>원</td>
											
											
											
											
                                        </tr>
									<?php
									}
                                    ?>
                                    </tbody>
                                </table>
          </div>

          <div class="col-md-6" id="map"></div>
        </div>
      </div>
    </section>