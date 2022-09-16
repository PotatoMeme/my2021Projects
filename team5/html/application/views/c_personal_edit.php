	<!-- END nav -->

	
    <div class="hero-wrap js-fullheight" style="background-image: url('/~team5/back_img/bg_2.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-9 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
            <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="/~team5/main">Home</a></span> <span class="mr-2"><a href="/~team5/personal">Personal</a></span> </p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">개인정보</h1>
          </div>
        </div>
      </div>
    </div>

		<section class="ftco-section contact-section ftco-degree-bg">
      <div class="container">
        <div class="row d-flex mb-5 contact-info">
          <div class="col-md-12 mb-4">
            <h2 class="h4">나의 개인정보</h2>
          </div>
          <div class="w-100"></div>
        </div>

		<?
        foreach($list as $row){ ?>

		<form method="post"  enctype="multipart/form-data">
		<table>
		<tr>
			<td class="col-md-3 pr-md-5">회원번호</td>
			<td><input type="text" class="form-control" value="<?=$row->no; ?>" readonly></td>
		</tr>
		<tr>
			<td class="col-md-3 pr-md-5">이름</td>
			<td><input type="text" name="name"class="form-control" value="<?=$row->name; ?>"></td>
			<?php if(form_error("name")==true) echo form_error("name"); ?>
		</tr>
		<tr>
			<td class="col-md-3 pr-md-5">아이디</td>
			<td><input type="text" name="uid" class="form-control" value="<?=$row->uid; ?>"></td>
			<?php if(form_error("uid")==true) echo form_error("uid"); ?>
		</tr>
		<tr>  
			<td class="col-md-3 pr-md-5">비밀번호</td>
			<td><input type="text" name="pwd" class="form-control" value="<?=$row->pwd; ?>"></td>
			<?php if(form_error("pwd")==true) echo form_error("pwd"); ?>
		</tr>
		<tr>
			<td class="col-md-3 pr-md-5">전화번호</td>
			<td><input type="text" name="tel" class="form-control" value="<?=$row->tel; ?>"></td>
			<?php if(form_error("tel")==true) echo form_error("tel"); ?>
		</tr>
        <!-- <div class="row block-9">
                        <div class="col-md-3 pr-md-5">
                          <form action="#">
              <div class="form-group">
                <input type="text" class="form-control" value="<?=$row->name ?>">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" value="<?=$row->uid ?>">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" value="<?=$row->tel ?>">
              </div> -->
		</table>

<? } ?>

                <div class="form-group">
                <input type="submit" value="저장" class="btn btn-primary py-2 px-3 "> 
              </div> 
            </form>
          
          </div>

         
      </div>
    </section>