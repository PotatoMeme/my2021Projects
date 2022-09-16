<script>
</script>

<body >
<div id="video_area">  <!-- 뷰포트에 꽉맞춤-->
		<video autoplay loop id="video_play" muted style=" ">
			<source src="/~sale6/my/img/background.mp4" type="video/mp4" >
		</video>
</div>
    <div class="container">
		
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block ">
								<img class="login_img" src="/~sale6/my/img/login2.jpg" style=" height:580px;">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5" >
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 ">Welcome!</h1>
										<h1 class="h4 text-gray-900 ">Admin Page</h1>
                                    </div>
                                    <form name="login_form" class="user" method="post" action="/~sale6/b_Login2/check" >
                                        <div class="form-group">
                                            <input type="text" name="uid" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="User ID" onkeypress="Javascript:if(event.keyCode==13)login_form.submit();">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="pwd" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" onkeypress="Javascript:if(event.keyCode==13)login_form.submit();">
                                        </div>
                                        
										<button type="button" class="btn btn-primary btn-user btn-block" onClick="javascript:login_form.submit();" >
										Login
										</button>
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/~sale6/my/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/~sale6/my/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/~sale6/my/js/sb-admin-2.min.js"></script>

</body>

</html>