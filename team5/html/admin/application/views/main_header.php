<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HotelAdmin</title>

    <!-- Custom fonts for this template-->
    <link href="/~team5/admin/my/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
	<link href="/~team5/admin/my/css/my.css" rel="stylesheet">
    <link href="/~team5/admin/my/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="/~team5/admin/my/js/jquery-3.5.1.min.js"></script>
	<script src="/~team5/admin/my/js/moment-with-locales.min.js"></script>
	<script src="/~team5/admin/my/js/bootstrap-datetimepicker.js"></script>
	<link href="/~team5/admin/my/css/bootstrap-datetimepicker.css" rel="stylesheet">
	<link href="/~team5/admin/my/css/fontawesome-all.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="/~team5/my/img/hotel.ico">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">Hotel Admin<sup>*</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
			<li class="nav-item">
			<?
				
				if(!$this->session->userdata("uid")){
					redirect('~team5/admin/login');
				}
				else {
					echo("<a class='nav-link' href='/~team5/admin/login/logout'><i class='fas fa-door-open'></i><span>로그아웃</span></a>");
					if($this->session->userdata("rank") == 1){// 사업자
						$this->load->view("main_header_nav_rank_1.php");
					} else if($this->session->userdata("rank") == 2){// 관리자
						$this->load->view("main_header_nav_rank_2.php");
					}
				}

			?>
                
            
        </ul>
        <!-- End of Sidebar@@@@@@@@@@@ -->
