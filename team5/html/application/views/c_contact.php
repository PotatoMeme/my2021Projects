<?php
	//$tmp = $text1 ? "/text1/$text1/page/$page" : "/page/$page"; 
?>
<script>
	function find_text()
	{
		if(!form1.text1.value)
			form1.action="/~team5/area/lists";
		else
			form1.action="/~team5/area/lists/text1/" + form1.text1.value;
		form1.submit();
	}
</script>

    <div class="hero-wrap js-fullheight" style="background-image: url('/~team5/back_img/bg_6.jpg');">
      <div class="overlay"></div>
      <div class="container" style="margin:0;">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-9 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
            <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="/~team5/main">Home</a></span> <span>Hotel</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Contact US</h1>
			<span>건의사항을 보내주세요</span>
          </div>
        </div>
      </div>
    </div>


    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
			<div class="col-lg-1"></div>
          <div class="col-lg-10">
          	<div class="row">
						
					<div class="card shadow mr-4 col" style="padding:0px" >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Contact US</h6>
                        </div>
                        <div class="card-body ">
							<form name="form1" method="post" enctype="multipart/form-data" class="user">
							  <div class="row">
								  <div class="form-group col">
									 <div class="row mx-1">
										<input type="hidden" name="member_no" value="<?=$member["no"]?>">
										<input type="text" class="form-control form-control-user col mr-1" name="member_name"  value="<?=$member["name"]?>" placeholder="이름" Readonly>
									 </div>
								  </div>
							  </div>

							  <div class="row">
								  <div class="form-group col">
									 <div class="row mx-1">
										<input type="text" class="form-control form-control-user col mr-1" name="title" placeholder="제목" >
									 </div>
								  </div>
							  </div>
							  
							  <div class="form-group">
								<textarea class="form-control form-control-user" name="contents" placeholder="내용"></textarea>
							  </div>
							  
								<div style="height:24px"></div>
							  <button type="submit" class="btn btn-user btn-block btn-primary">완료</button>
							</form>
                        </div>
						</div>
	
					</div>	

          	</div>
          	
          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->