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
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-9 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
            <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="/~team5/area">Area</a></span> <span>Hotel</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">AREA</h1>
			<h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">지역별정보</h1>
          </div>
        </div>
      </div>
    </div>


    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
        	<div class="col-lg-3 sidebar">
        		<div class="sidebar-wrap bg-light ftco-animate">
        			<h3 class="heading mb-4">검색</h3>
        			<form name="form1" action="#">
        				<div class="fields">
		              <div class="form-group">
		                <input type="text" name="text1" value="<?=$text1?>" class="form-control" placeholder="지역검색">
		              </div>
		              <div class="form-group">
		                <input type="submit" value="Search" class="btn btn-primary py-3 px-5" onClick="find_text();">
		              </div>
		            </div>
	            </form>
        		</div>
        		
          </div>
          <div class="col-lg-9">
          	<div class="row">
			
			<?
				foreach($list_area as $row)
				{
					//$iname=$row->pic ? $row->pic : "";
					//$pname=$row->name;
			?>
          		<div class="col-md-4 ftco-animate">
		    				<div class="destination">
		    					<a href="/~team5/area/view/no/<?=$row->no?>" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(/~team5/imgs/area_img/thumb/<?=$row->pic1?>);">
		    						<div class="icon d-flex justify-content-center align-items-center">
    							<span class="icon-search2"></span>
    						</div>
		    					</a>
		    					<div class="text p-3">
		    						<div class="d-flex">
		    							<div class="one">
				    						<h3><a href="/~team5/area/view/no/<?=$row->no?>"><?=$row->name?></a></h3>
				    						
			    						</div>
										<!--
			    						<div class="two">
			    							<span class="price per-price"><small>100,000원<br>/1박</small></span>
		    							</div>
										-->

		    						</div>
		    						
		    						<hr>
		    						<p class="bottom-area d-flex">
		    							<span><a href="https://www.google.co.kr/maps/search/<?=$row->name?>/@37.5640455,126.8340025,11z"><i class="icon-map-o"></i>지도검색</a></span> 
		    							
		    						</p>
		    					</div>
		    				</div>
		    			</div>
						
			<?
				}	
			?>		

          	</div>
          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->