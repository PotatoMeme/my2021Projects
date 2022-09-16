
   
	
	<!-- END nav -->

	
    <div class="hero-wrap js-fullheight" style="background-image: url('/~team5/back_img/bg_13.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-9 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
            <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="/~team5/main">Home</a></span> <span class="mr-2"><a href="/~team5/hotel">Hotel</a></span> <span>Hotel Single</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Hotels Details</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
        	

          </div>
          <div class="col-lg-9">
          	<div class="row">
          		<div class="col-md-12 ftco-animate">
					<?
						$pic=explode('^',$row->pic);
					?>
						<div class="single-slider owl-carousel">
							<div class="item">
								<div class="hotel-img" style="background-image: url(/~team5/imgs/hotel_img/<?=$pic[1]?>);"></div>
							</div>
							<div class="item">
								<div class="hotel-img" style="background-image: url(/~team5/imgs/hotel_img/<?=$pic[2]?>);"></div>
							</div>
							<div class="item">
								<div class="hotel-img" style="background-image: url(/~team5/imgs/hotel_img/<?=$pic[3]?>);"></div>
							</div>
						</div>
          		</div>
          		<div class="col-md-12 hotel-single mt-4 mb-5 ftco-animate">
          			<span>촤고의 호텔 &amp; 객실</span>
          			<h2><?=$row->name?></h2>

    						<p><?=$row->bigo?></p>

          		</div>
          		
				<!--
				<div class="col-md-12 hotel-single ftco-animate mb-5 mt-4">
          			<h4 class="mb-4">호텔 영상</h4>
          			<div class="block-16">
		              <figure>
		                <img src="images/hotel-6.jpg" alt="Image placeholder" class="img-fluid">
		                <a href="https://vimeo.com/45830194" class="play-button popup-vimeo"><span class="icon-play"></span></a>
		              </figure>
		            </div>
          		</div>
				-->
				
          		<div class="col-md-12 hotel-single ftco-animate mb-5 mt-4">
          			<h4 class="mb-4">방</h4>
          			<div class="row">		
					
					<?
						$no=$row->no;
						foreach($hotel_room as $row1)
						{
							$pic=explode('^',$row1->pic);
							$hotel_no=$row1->hotel_no;
							if($no == $hotel_no)
							{
						
					?>
          				<div class="col-md-4">
							<div class="destination">
								<a class="img img-2" style="background-image: url(/~team5/imgs/room_img/<?=$pic[0]?>);"></a>
								<div class="text p-3">
									<div class="d-flex">
										<div class="one">
											<h3><a><?=$row1->name;?></a></h3>
											
										</div>
										<div class="two">
											<span class="price per-price"><?=$row1->price;?><br><small>최대인원 : <?=$row1->max_member;?> /1박</small></span>
										</div>
									</div>
									<p><?=$row1->bigo;?></p>
									<?
										if ($this->session->userdata('uid')) {
									?>
									<a href="/~team5/hotel/add/no/<?=$row1->no?>" type='button'  class='btn btn-primary py-3'>예약하기</a>
									<?} else { ?>
									<p>예약시 로그인이 필용합니다</p>
									<?}?>
								</div>
							</div>
						</div>		
					<?
							}
						}
					?>
				    			
							
				  
						  
						  
				           
						  
						  
		              </div>
		            </div>
          		</div>										
          	</div>
          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->


   