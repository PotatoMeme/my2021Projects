


    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background: url(/~team5/imgs/hotel_img/hotel_jeju_4_1.jpg);"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        <h5 class="h5 text-gray-900 mb-4">this is adminPage , General users cannot use </h5>
                                    </div>
                                    <form name="login_form" class="user" method="post" action="/~team5/admin/login/check">
                                       
                                       
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
                                        
                                    </form>
									
                                    
                                
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
									<div class="text-center">
										<a class="small" href="/~team5/main">Back to Main page!</a>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/~team5/my/vendor/jquery/jquery.min.js"></script>
    <script src="/~team5/my/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/~team5/my/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/~team5/my/js/sb-admin-2.min.js"></script>

</body>

</html>