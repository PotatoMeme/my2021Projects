
    <!-- END nav -->
    <div class="hero-wrap js-fullheight" style="background-image: url('/~team5/imgs/area_img/<?=$row["pic1"]?>');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-9 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
            <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="/~team5/area">AREA</a></span> <span class="mr-2"><a href="/~team5/area">Hotel</a></span> <span>Hotel Single</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">AREA Details</h1>
			<h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">-<?=$row["name"]?>-</h1>
          </div>
        </div>
      </div>
    </div>
    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
        	
			<!--
			<div class="col-lg-3 sidebar">
        		<div class="sidebar-wrap bg-light ftco-animate">
        			<h3 class="heading mb-4">호텔 찾기 (필요없으면 삭제)</h3>
        			<form action="#">
        				<div class="fields">
		              <div class="form-group">
		                <input type="text" class="form-control" placeholder="호텔 검색">
		              </div>
		              <div class="form-group">
		                <div class="select-wrap one-third">
	                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
	                    <select name="" id="" class="form-control" placeholder="Keyword search">
	                      <option value="">지역</option>
	                      <option value="">서울</option>
	                      <option value="">경기도</option>
	                      <option value="">부산</option>
	                      <option value="">제주도</option>
	                    </select>
	                  </div>
		              </div>
		              <div class="form-group">
		                <input type="text" id="checkin_date" class="form-control" placeholder="입실">
		              </div>
		              <div class="form-group">
		                <input type="text" id="checkin_date" class="form-control" placeholder="퇴실">
		              </div>
		              
		              <div class="form-group">
		                <input type="submit" value="Search" class="btn btn-primary py-3 px-5">
		              </div>
		            </div>
	            </form>
        		</div>
				-->
			


											<!-- <div class="sidebar-wrap bg-light ftco-animate">    별점기능
													<h3 class="heading mb-4">Star Rating</h3>
													<form method="post" class="star-rating">
															  <div class="form-check">
																	<input type="checkbox" class="form-check-input" id="exampleCheck1">
																	<label class="form-check-label" for="exampleCheck1">
																		<p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i></span></p>
																	</label>
															  </div>
															  <div class="form-check">
															  <input type="checkbox" class="form-check-input" id="exampleCheck1">
															  <label class="form-check-label" for="exampleCheck1">
																   <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-o"></i></span></p>
															  </label>
															  </div>
															  <div class="form-check">
															  <input type="checkbox" class="form-check-input" id="exampleCheck1">
															  <label class="form-check-label" for="exampleCheck1">
																<p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-o"></i><i class="icon-star-o"></i></span></p>
															 </label>
															  </div>
															  <div class="form-check">
																<input type="checkbox" class="form-check-input" id="exampleCheck1">
															  <label class="form-check-label" for="exampleCheck1">
																<p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-o"></i><i class="icon-star-o"></i><i class="icon-star-o"></i></span></p>
															  </label>
															  </div>
															  <div class="form-check">
															  <input type="checkbox" class="form-check-input" id="exampleCheck1">
															  <label class="form-check-label" for="exampleCheck1">
																<p class="rate"><span><i class="icon-star"></i><i class="icon-star-o"></i><i class="icon-star-o"></i><i class="icon-star-o"></i><i class="icon-star-o"></i></span></p>
																</label>
															  </div>
															</form>
												</div>
												-->
          </div>
          <div class="col-lg-12 ">
			<div class="col-md-12 hotel-single mt-4 mb-5 ftco-animate">
				<h1 style="font-weight:700;"><?=$row["name"]?></h1>
				<img class="mt-3 img-fluid" src="/~team5/imgs/area_img/<?=$row["pic2"]?>"/>
			</div>
			
          	<!--<div class="row">
          		<div class="col-md-12 ftco-animate">
          			<div class="single-slider owl-carousel">
          				<div class="item">
          					<div class="hotel-img" style="background-image: url(/~team5/imgs/area_img/area_busan.jpg);"></div>
          				</div>
          				<div class="item">
          					<div class="hotel-img" style="background-image: url(images/hotel-3.jpg);"></div>
          				</div>
          				<div class="item">
          					<div class="hotel-img" style="background-image: url(images/hotel-4.jpg);"></div>
          				</div>
          			</div>
          		</div> -->
          		<div class="col-md-12 hotel-single mt-4 mb-5 ftco-animate">
    				<p><?=$row["intro1"]?></p>
          		</div>
				<hr>
          		<div class="col-md-12 hotel-single ftco-animate mb-5 mt-4">
          			<h4 class="mb-4" style="font-weight:700;">홍보영상</h4>
					<div class="video-container">
						<iframe width="100%" height="600" src="<?=$row["video"]?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						<p class="my-4"><?=$row["intro2"]?></p>
					</div>
          		</div>
				<hr>

				<div class="col-md-12 hotel-single ftco-animate mb-5 mt-4">
					<h4 class="mb-4" style="font-weight:700;">지도</h4>
					<div id="map" style="width:100%;height:400px;"></div>
				</div>


          		
<script>
var mapOptions = {
    center: new naver.maps.LatLng(<?=$row['gps']?>),
    zoom: 10
};

var map = new naver.maps.Map('map', mapOptions);
</script>								

          	</div>
          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->


   