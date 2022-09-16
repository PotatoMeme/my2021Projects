<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<%-- JSTL core 라이브러리 사용을 위한 선언 --%>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Clean Blog - Start Bootstrap Theme</title>
    <%-- 컴파일할때 파일에 포함 check f12 --%>

    <%@ include file="../main/header.jsp"%>
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
<!-- Navigation, 페이지 모듈화-->
<%-- 컴파일할때 링크만 --%>
<jsp:include page="../main/nav.jsp"/>
<!-- Page Header-->
<header class="masthead" style="background-image: url('../assets/img/home-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Clean Blog</h1>
                    <span class="subheading">A Blog Theme by Start Bootstrap</span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main Content-->
<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">

                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Admin Account!</h1>
                        </div>
                        <form action="register-admin.do" method="post" id="contactForm" class="user">

                            <div class="form-group">
                                <input name="email"  type="email" class="form-control form-control-user" id="email"
                                       placeholder="Email Address">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input name="pw" type="password" class="form-control form-control-user" id="password"
                                           placeholder="password">
                                </div>
                                <div class="col-sm-6">
                                    <input name="name" type="text" class="form-control form-control-user" id="name"
                                           placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="phone"  type="tel" class="form-control form-control-user" id="phone"
                                       placeholder="Phone">
                            </div>
                            <div class="form-group">
                                <input name="address"  type="text" class="form-control form-control-user" id="address"
                                       placeholder="Address">
                            </div>


                            <button class="btn btn-primary btn-user btn-block" id="submitButton" type="submit" > Register Account</button>
                        </form>

                        <hr>



                        <div class="text-center">
                            <a class="small" href="../bloggers/login-form.do">Already have an account? Login!</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Footer-->
<!-- Footer-->
<%@ include file="../main/footer.jsp"%>
</body>
</html>
