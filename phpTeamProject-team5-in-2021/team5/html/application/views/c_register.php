
    <!-- END nav -->
    
    <div class="hero-wrap js-fullheight" style="background-image: url('/~team5/back_img/bg_11.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-9 text-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
            <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="/~team5/main">Home</a></span> <span>Register</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Register</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row d-md-flex">
	    		<div class="col-md-6 ftco-animate img about-image" style="background-image: url(temp/images/register_img.jpg);"></div>
				<div class="col-md-6 ftco-animate p-md-5">
	    		<div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid ">
					<p></p>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Register</h1>
				<div class="row">
                    <!-- DataTales Example -->
                    <div class="card shadow mr-4 col" style="padding:0px" >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">회원가입</h6>
                        </div>
						

                    <div class="card-body ">
					<form name="form1" method="post" enctype="multipart/form-data" class="user" action="/~team5/register/add">
						<div class="row">
							<div class="form-group col">
								<input type="text" class="form-control form-control-user" name="name" placeholder="고객명" required>
									<div style="height:24px">
										<? if(form_error("name")==true) echo form_error("name"); ?>
									</div>
							</div>

							<div class="form-group col ">
								<select class="form-control forma" name="rank" style="font-size: .8rem; border-radius: 10rem ; height:3.2rem ;" required>
									<option value="0">고객</option>
									<option value="1">호텔관리자</option>
									<option value="2">사이트관리자</option>
								</select>
								<div style="height:24px">
									<? if(form_error("rank")==true) echo form_error("rank"); ?>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group col">
								<input type="text" class="form-control form-control-user" name="uid" placeholder="ID" required>
									<div style="height:24px">
										<? if(form_error("uid")==true) echo form_error("uid"); ?>
									</div>
							</div>

						<div class="form-group col">
								<input type="text" class="form-control form-control-user" name="pwd" placeholder="Password" required>
									<div style="height:24px">
										<?php if(form_error("pwd")==true) echo form_error("pwd"); ?>
									</div>
								 </div>
				</div>

							  <div class="form-group">
								<input type="text" class="form-control form-control-user" name="tel" placeholder="전화번호" required>
								<div style="height:24px">
								<? if(form_error("tel")==true) echo form_error("tel"); ?>
								</div>
							  </div>							  
							 
							  <div class="form-group">
								<input type="text" class="form-control form-control-user" name="bigo" placeholder="비고">
							  </div>

							<div style="height:24px"></div>
							  <button type="submit" class="btn btn-user btn-block btn-primary">완료</button>
							</form>
                        </div>
						</div>
						</div>	
					</div>
                </div>
                <!-- /.container-fluid -->
				  </div>
		          
		        </div>
		      </div>
		    </div>
    	</div>
    </section>



	 



   