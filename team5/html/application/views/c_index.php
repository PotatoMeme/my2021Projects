
    <div class="hero-wrap js-fullheight" style="background-image: url('back_img/bg_9.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-9 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
            <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><br><strong>떠나요 <br></strong>지친 일상으로부터</h1>
            <p data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"></p>
             <section class="hero spad set-bg" data-setbg="img/hero.jpg">
        <div class="container">
            <div class="row">
                  <!--  <form action="#" class="filter__form">
                        <div class="filter__form__item filter__form__item--search">
                            <p>Location</p>
                            <div class="filter__form__input">
                                <input type="text" placeholder="지역">
                                <span class="icon-search"></span>
                            </div>
                        </div>
                        <div class="filter__form__item">
                            <p>Check In</p>
                             <div class="form-group">
		                <input type="text" id="checkin_date" class="form-control" placeholder="입실">
						</div>
					  </div>
                        <div class="filter__form__item">
                            <p>Check Out</p>
		              <div class="form-group">
		                <input type="text" id="checkin_date" class="form-control" placeholder="퇴실">
		              </div>
                        </div>
                        <div class="filter__form__item filter__form__item--select">
                            <p>Person</p>
                            <div class="filter__form__select">
                                <span class="icon-group"></span>
                                <select>
                                    <option value="">선택</option>
                                    <option value="">옵션1</option>
                                    <option value="">옵션2</option>
                                </select> 
                            </div>
                        </div>
                        <button type="submit">검색</button>
                    </form> -->
					
					<script>
						function find_text()
						{
							if (!form1.text1.value)
								form1.action="/~team5/hotel/lists";
							else
								form1.action="/~team5/hotel/lists/text1/" + form1.text1.value;
							form1.submit();
						}

						$(function() {
							$('#checkin_date') .datetimepicker({
								locale: 'ko',
								format: 'YYYY-MM-DD',
								mindate: '+0d'
								maxdate: '+45d'
							});

							$('#text2') .datetimepicker({
								locale: 'ko',
								format: 'YYYY-MM-DD'
								mindate: '+0d'
								maxdate: '+45d'
							});
								
							$("checkin_date") .on("dp.change", function (e) { find_text(); });
							$("#text2") .on("dp.change", function (e) { find_text(); });
						});
					</script>



					 <form name="form1"  action="hotel" class="filter__form">
                        <div class="filter__form__item filter__form__item--search">
                            <p>Location</p>
                            <div class="filter__form__input">
                                <input type="text" name="text1" placeholder="지역">
                                <span class="icon-search"></span>
                            </div>
                        </div>
                        <div class="filter__form__item">
                            <p>Check In</p>
                            <div class="filter__form__datepicker">
                                <span class="icon-calendar"></span>
                                <input type="text" id="checkin_date" class="form-control" placeholder="입실">
                                <i class="arrow_carrot-down"></i>
                            </div>
                        </div>
                        <div class="filter__form__item">
                            <p>Check Out</p>
                            <div class="filter__form__datepicker">
                                <span class="icon-calendar"></span>
                                <input type="text" id="checkout_date" class="form-control" placeholder="퇴실">
                                <i class="arrow_carrot-down"></i>
                            </div>
                        </div>
                        <div class="filter__form__item filter__form__item--search" >
                            <p>Person</p>
                            <div class="filter__form__input" >
                                <span class="icon-group"></span>
                               <input type="text" placeholder="인원수">
                            </div>
                        </div>
                        <button type="submit" style="background:#989FFF">검색</button>
                    </form>
                </div>

        </div>
    </section>
           

          </div>
        </div>
      </div>
    </div>

	<section class="ftco-section services-section bg-light">
      <div class="container">
        <div class="row d-flex">
          <div class="col-md-3 d-flex align-self-stretch ftco-animate fadeInUp ftco-animated">
            <div class="media block-6 services d-block text-center">
              <div class="d-flex justify-content-center"><div class="icon" ><span class="flaticon-guarantee" style="color:#989FFF"></span></div></div>
              <div class="media-body p-2 mt-2">
                <h3 class="heading mb-3">100% 인증</h3>
                <p>100%인증된 사업자만 받았습니다</p>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate fadeInUp ftco-animated">
            <div class="media block-6 services d-block text-center">
              <div class="d-flex justify-content-center"><div class="icon"><span class="flaticon-hotel" style="color:#989FFF"></span></div></div>
              <div class="media-body p-2 mt-2">
                <h3 class="heading mb-3">간편한 호텔예약</h3>
                <p>지도서비스로 더욱 간편한 호텔찾기</p>
              </div>
            </div>    
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate fadeInUp ftco-animated">
            <div class="media block-6 services d-block text-center">
              <div class="d-flex justify-content-center"><div class="icon"><span class="flaticon-detective" style="color:#989FFF"></span></div></div>
              <div class="media-body p-2 mt-2">
                <h3 class="heading mb-3">최고의 서비스</h3>
                <p>이용하실 모든 고객들이 만족하실수 있도록 최선을 다하겠습니다. </p>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate fadeInUp ftco-animated">
            <div class="media block-6 services d-block text-center">
              <div class="d-flex justify-content-center"><div class="icon"><span class="flaticon-support" style="color:#989FFF"></span></div></div>
              <div class="media-body p-2 mt-2">
                <h3 class="heading mb-3">상담문의</h3>
                <p>02-950-7000<br>상담시간 : 24시간 운영!</p>
              </div>
            </div>      
          </div>
        </div>
      </div>
    </section>

<section class="ftco-section ftco-destination">
		<div class="container">
			<div class="row justify-content-start mb-5 pb-3">
			  <div class="col-md-7 heading-section ftco-animate fadeInUp ftco-animated">
				<span class="subheading">Country Information</span>
				<h2 class="mb-4"><strong>지역 </strong>정보</h2>
			  </div>
			</div>

    		<div class="row">
					<div class="owl-item  active" style="width: 255px; margin-right: 30px;">
						<div class="item">
							<div class="destination">
								<a href="/~team5/area/view/no/7" class="img d-flex justify-content-center align-items-center" style="background-image: url(/~team5/imgs/area_img/area_seoul.jpg);">
									<div class="icon d-flex justify-content-center align-items-center">
										<span class="icon-search2"></span>
									</div>
								</a>
								<div class="text p-3">
									<h3><a href="#">
									서울</a></h3>
									<span class="listing">Singapore</span>
								</div>
							</div>
						</div>
					</div>

					<div class="owl-item  active" style="width: 255px; margin-right: 30px;">
						<div class="item">
							<div class="destination">
								<a href="/~team5/area/view/no/8" class="img d-flex justify-content-center align-items-center" style="background-image: url(/~team5/imgs/area_img/area_jeju.jpg);">
									<div class="icon d-flex justify-content-center align-items-center">
										<span class="icon-search2"></span>
									</div>
								</a>
								<div class="text p-3">
									<h3><a href="#">
									제주</a></h3>
									<span class="listing">Singapore</span>
								</div>
							</div>
						</div>
					</div>

					<div class="owl-item  active" style="width: 255px; margin-right: 30px;">
						<div class="item">
							<div class="destination">
								<a href="/~team5/hotel/view/no/16" class="img d-flex justify-content-center align-items-center" style="background-image: url(/~team5/imgs/area_img/area_gyeong.png);">
									<div class="icon d-flex justify-content-center align-items-center">
										<span class="icon-search2"></span>
									</div>
								</a>
								<div class="text p-3">
									<h3><a href="#">
									경기도</a></h3>
									<span class="listing">Singapore</span>
								</div>
							</div>
						</div>
					</div>

					<div class="owl-item  active" style="width: 255px; margin-right: 30px;">
						<div class="item">
							<div class="destination">
								<a href="/~team5/hotel/view/no/15/page/0" class="img d-flex justify-content-center align-items-center" style="background-image: url(/~team5/imgs/area_img/area_busan.jpg);">
									<div class="icon d-flex justify-content-center align-items-center">
										<span class="icon-search2"></span>
									</div>
								</a>
								<div class="text p-3">
									<h3><a href="#">
									부산</a></h3>
									<span class="listing">Singapore</span>
								</div>
							</div>
						</div>
    				</div>
    		</div>
    	</div>
    </section>


	<section class="ftco-section bg-light">
    	<div class="container">
				<div class="row justify-content-start mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate fadeInUp ftco-animated">
          	<span class="subheading">Special Package</span>
            <h2 class="mb-4"><strong>최저가</strong> 호텔</h2>
          </div>
        </div>    		
    	</div>
    	<div class="container-fluid">
    		<div class="row">
			<?
			foreach($list_hotel as $row) {
				$pic = explode("^",$row->pic);

			?>
    			<div class="col-sm col-md-6 col-lg ftco-animate fadeInUp ftco-animated">
    				<div class="destination">
    					<a href="/~team5/hotel/view/no/<?=$row->no?>/page/0" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(/~team5/imgs/hotel_img/<?=$pic[0]?>);">
    						<div class="icon d-flex justify-content-center align-items-center">
    							<span class="icon-search2"></span>
    						</div>
    					</a>
    					<div class="text p-3">
    						<div class="d-flex">
    							<div class="one">
		    						<h3><a href="/~team5/hotel/view/no/<?=$row->no?>/page/0"><?=$row->name ?></a></h3>
		    						<p class="rate">
													<i class="icon-star"></i>
													<i class="icon-star"></i>
													<i class="icon-star"></i>
													<i class="icon-star"></i>
													<i class="icon-star"></i>
													</p>	    						</div>
	    						<div class="two">
    							</div>
    						</div>
    						<p><?=$row->area_name?>에 위치한 <?=$row->name ?>는 고객님께 최고의 경험을 선사해 드리겠습니다</p>
							<hr>
    						<p class="bottom-area d-flex">

    							<span><i class="icon-map-o"></i><?=$row->area_name?></span> 
    							<span class="ml-auto"><a href="/~cidemo/product/view/no/24/page/0">보기</a></span>
    						</p>
    					</div>
    				</div>
    			</div>
<? } ?>

    		</div>
    	</div>
    </section>


		<section class="ftco-section bg-light">
    	<div class="container">
				<div class="row justify-content-start mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate fadeInUp ftco-animated">
          	<span class="subheading">Special Package</span>
            <h2 class="mb-4"><strong>인기</strong> 객실</h2>
          </div>
        </div>    		
    	</div>
    	<div class="container-fluid">
    		<div class="row">
			
			<?

			foreach($list_room as $row) {
				$pic = explode("^",$row->pic);

			?>
    			<div class="col-sm col-md-6 col-lg ftco-animate fadeInUp ftco-animated">
    				<div class="destination">
    					<a href="/~team5/hotel/add/no/24/page/0" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(/~team5/imgs/room_img/<?=$pic[0]?>);">
    						<div class="icon d-flex justify-content-center align-items-center">
    							<span class="icon-search2"></span>
    						</div>
    					</a>
    					<div class="text p-3">
    						<div class="d-flex">
    							<div class="one">
		    						<h3><a href="/~team5/hotel/view/no/<?=$row->no?>/page/0"><?=$row->name ?></a></h3>
		    						<p class="rate">
													<i class="icon-star"></i>
													<i class="icon-star"></i>
													<i class="icon-star"></i>
													<i class="icon-star"></i>
													<i class="icon-star"></i>
													</p>	    						</div>
	    						<div class="two">
    							</div>
    						</div>
    						<p><?=$row->hotel_name?>에서 가장 인기있는 <?=$row->name ?>입니다</p>
							<hr>
    						<p class="bottom-area d-flex">

    							<span><i class="icon-map-o"></i><?=$row->area_name?></span> 
    							<span class="ml-auto"><a href="/~cidemo/product/view/no/24/page/0">예약하기</a></span>
    						</p>
    					</div>
    				</div>
    			</div>
<? } ?>

    		</div>
    	</div>
    </section>

	<section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(/~cidemo/my/images/bg_1.jpg);">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 text-center heading-section heading-section-white ftco-animate fadeInUp ftco-animated">
            <h2 class="mb-4">우리업체에 입점한 호텔</h2>
            <span class="subheading">매월 200%성장하는 우리기업의 현황입니다</span>
          </div>
        </div>
    		<div class="row justify-content-center">
    			<div class="col-md-10">
		    		<div class="row">
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate fadeInUp ftco-animated">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="8"><?=$num_area?></strong>
		                <span>등록 지역</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate fadeInUp ftco-animated">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="12"><?=$num_hotel?></strong>
		                <span>입점 호텔</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate fadeInUp ftco-animated">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="18"><?=$num_room?></strong>
		                <span>보유 객실</span>
		              </div>
		            </div>
		          </div>
				  <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate fadeInUp ftco-animated">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="18"><?=$num_jangbu?></strong>
		                <span>누적 예약</span>
		              </div>
		            </div>
		          </div>
		        </div>
	        </div>
        </div>
    	</div>
    </section>