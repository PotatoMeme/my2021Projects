<?php
	$tmp = $text1 ? "/text1/$text1/page/$page" : "/page/$page"; 
?>

			
    <div class="hero-wrap js-fullheight" style="background-image: url('/~team5/back_img/bg_12.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-9 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
            <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="/~team5/main">Home</a></span> <span>Hotel</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Hotels</h1>
          </div>
        </div>
      </div>
    </div>


			<script>
				function find_text()
				{
					if (!form1.text1.value)
						form1.action="/~team5/hotel/lists";
					else
						form1.action="/~team5/hotel/lists/text1/" + form1.text1.value;
					form1.submit();
				}


			</script>



    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
        	<div class="col-lg-3 sidebar">
        		<div class="sidebar-wrap bg-light ftco-animate">
        			<h3 class="heading mb-4">호텔 찾기</h3>
        			<form action="#">
        				<div class="fields">
		              <div class="form-group">
		                <input type="text" name="text1" value="<?=$text1?>" class="form-control" placeholder="호텔 검색" onKeydown="if (event.keyCode == 13) { find_text(); }">
		              </div>
		              <div class="form-group">
		                <div class="select-wrap one-third">
	                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
	                    

						<select name="area_no" id="" class="form-control" placeholder="Keyword search">
						<option value="">지역</option>
								<?
									$area_no=set_value("area_no");
									foreach ($list_area as $row)
									{
										if($row->no==$area_no)
											echo("<option value='$row->no' selected>$row->name</option>");
										else
											echo("<option value='$row->no'>$row->name</option>");
									}
								?>
						</select>
						<? if(form_error("area_no")==TRUE) echo form_error("area_no")?>

	                  </div>
		              </div>
		              <div class="form-group">
		                <input type="text" id="checkin_date" class="form-control" placeholder="입실">
		              </div>
		              <div class="form-group">
		                <input type="text" id="checkin_date" class="form-control" placeholder="퇴실">
		              </div>

					  <div class="form-group">
		                <input type="text" class="form-control" placeholder="인원">
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
				foreach($list_hotel as $row)
				{
					$no=$row->no;
					//$iname=$row->pic ? $row->pic : "";
					$pname=$row->name;
					$pic=explode('^',$row->pic);
			?>
          		<div class="col-md-4 ftco-animate">
		    				<div class="destination">
		    					<a href="/~team5/hotel/view/no/<?=$no;?><?=$tmp;?>" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(/~team5/imgs/hotel_img/<?=$pic[0]?>);">
		    						<div class="icon d-flex justify-content-center align-items-center">
    							<span class="icon-search2"></span>
    						</div>
		    					</a>
		    					<div class="text p-3">
		    						<div class="d-flex">
		    							<div class="one">
				    						<h3><a href="/~team5/hotel/view/no/<?=$no;?><?=$tmp;?>"><?=$pname?></a></h3>
				    						
			    						</div>
										<!--
			    						<div class="two">
			    							<span class="price per-price"><small>100,000원<br>/1박</small></span>
		    							</div>
										-->

		    						</div>
		    						
		    						<hr>
		    						<p class="bottom-area d-flex">
		    							<span><i class="icon-map-o"></i> <?=$row->juso?></span> 
		    							
		    						</p>
		    					</div>
		    				</div>
		    			</div>
						
			<?
				}	
			?>	
          	</div>
			
          	<div class="row mt-5">
		          <div class="col text-center">
		            <div class="block-27">
		              <ul>
		                <?=$pagination; ?>
		              </ul>
		            </div>
		          </div>
		        </div>
          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->