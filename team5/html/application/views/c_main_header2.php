<!DOCTYPE html>
<html lang="en">
  <head>
    <title>team5</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Alex+Brush" rel="stylesheet">

    <link rel="stylesheet" href="/~team5/my/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="/~team5/my/css/animate.css">
    
    <link rel="stylesheet" href="/~team5/my/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/~team5/my/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/~team5/my/css/magnific-popup.css">

    <link rel="stylesheet" href="/~team5/my/css/aos.css">

    <link rel="stylesheet" href="/~team5/my/css/ionicons.min.css">
	<link rel="stylesheet" href="/~team5/my/css/elegant-icons.css">

    <link rel="stylesheet" href="/~team5/my/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/~team5/my/css/jquery.timepicker.css">
    
    <link rel="stylesheet" href="/~team5/my/css/flaticon.css">
    <link rel="stylesheet" href="/~team5/my/css/icomoon.css">
    <link rel="stylesheet" href="/~team5/my/css/style.css">
	<!-- 네이버 지도 api키 -->
	<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=qxcakk5lqj"></script>
  </head>
  <body>
    
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="/~team5/main">team5</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active"><a href="/~team5/main" class="nav-link">Home</a></li>
          <li class="nav-item active"><a href="/~team5/about" class="nav-link">About</a></li>
		  <li class="nav-item active"><a href="/~team5/area" class="nav-link">Area</a></li>

			<?
			if (!$this->session->userdata('uid'))
				echo("<li class='nav-item active'><a href='#exampleModalCenter' class='nav-link' data-toggle='modal'>Log in</a></li>");
			else
				echo("<li class='nav-item active'><a href='/~team5/login/logout' class='nav-link'>Log out</a></li>");
			?>
			
			<?
			if($this->session->userdata('rank')==0)
				echo("<li class='nav-item active'><a href='/~team5/personal' class='nav-link'>personal</a></li>");
			?>
		  <li class="nav-item active"><a href="/~team5/register" class="nav-link">Register</a></li>
          <li class="nav-item active"><a href="/~team5/hotel" class="nav-link">Hotels</a></li>
		 <?
		  if(!$this->session->userdata('rank')==0)
			echo("<li class='nav-item active'><a href='/~team5/admin/dashboard' class='nav-link'>Dashboard</a></li>");
		  ?>
		
		  <input type="text" placeholder="검색">
        </ul>
      </div>
    </div>
  </nav>
    <!-- END nav -->

		<!-- Modal Log in -->
		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close d-flex align-items-center justify-content-center" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true" class="ion-ios-close"></span>
		        </button>
		      </div>
		      <div class="modal-body p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="ion-ios-person"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Sign In</h3>
		      	<form action="/~team5/login/check" class="login-form" method="post">
		      		<div class="form-group">
		      			<input type="text" name="uid" class="form-control rounded-left" placeholder="Username">
		      		</div>
	            <div class="form-group d-flex">
	              <input type="password" name="pwd" class="form-control rounded-left" placeholder="Password">
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="form-check w-50">
		            	<label class="custom-control fill-checkbox">
										<input type="checkbox" class="fill-control-input">
										<span class="fill-control-indicator"></span>
										<span class="fill-control-description">Remember Me</span>
									</label>
								</div>
								<div class="w-50 text-md-right">
									<a href="#">Forgot Password</a>
								</div>
	            </div>
	          </form>
		      </div>
		      <div class="modal-footer justify-content-center">
		      	<p>Not a member? <a href="#">Create an account</a></p>
		      </div>
		    </div>
		  </div>
		</div>
		
		<div class="hero-wrap js-fullheight" style="background-image: url('back_img/bg_6.jpg');">
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