<!DOCTYPE html>
<html lang="jp">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>お茶屋さん</title>
	<!-- bootstrap -->
	<link href="/ECSHOP_TEST/boot/css/bootstrap.min.css" rel="stylesheet">
	<link href="/ECSHOP_TEST/css/admin.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

	<style type="text/css"> body {padding-top: 50px;} </style>

	<!-- bootstrap carosel -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
<!-- TOP -->
<div class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<a class="navbar-brand" href="#"> </a>
		<div class="navbar-header">
			<button class="navbar-toggle collapsed"data-toggle="collapse" data-target="#target">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse" id="target">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">『<?php echo $this->session->userdata['ss_user_id']; ?>』
						様ご来店ありがとうございます。</a></li>
				<li><a href="/ECSHOP_TEST/index.php/Controller_EC/logout">ログアウト</a></li>

			</ul>
		</div>
	</div>
</div>
<!-- TOP -->

<!-- LOGO / SEARCH -->
<br>
<header>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-6 col-sm-4">
			</div>
			<div class="col-xs-6 col-sm-4">
				<div class="center">
					<a href="/ECSHOP_TEST/index.php/Controller_EC/home"><img src="/ECSHOP_TEST/img/logo.png" width="230px"></a>
				</div>
			</div>
			<div class="col-xs-6 col-sm-4">
			</div>

		</div>
	</div>
</header>
<!-- LOGO / SEARCH -->

<section>
<!-- CATEGORY / BIG PHOTO --><!-- CATEGORY / BIG PHOTO -->
	<div class="container-fluid">
			<!-- 카테고리, 큰사진 중 큰사진 및 상품태그 시작 -->
				<!-- 상품리스트 시작태그 -->
				<div class="row">
					<!-- 한개의 상품 -->

						<div class="col-md-3 col-md-offset-3"></div>
						<div class="col-md-6 col-md-offset-3">
							<a href="/ECSHOP_TEST/index.php/manager/order">
								<div class="col-xs-6 col-sm-3 col-md-4 box">
									<span>受注台帳</span>
								</div>
							</a>
							<a href="/ECSHOP_TEST/index.php/manager/product">
								<div class="col-xs-6 col-sm-3 col-md-4 box">
									<span>商品台帳</span>
								</div>
							</a>
							<a href="/ECSHOP_TEST/index.php/manager/customer">
								<div class="col-xs-6 col-sm-3 col-md-4 box">
									<span>顧客台帳</span>
								</div>
							</a>
						</div>
						<div class="col-md-3 col-md-offset-3"></div>
					<!-- 상품리스트 끝 태그-->
				</div>
				<!-- 카테고리, 큰사진 중 큰사진 및 상품태그 시작 -->
			</div>
	</div>
</section>
<!-- CATEGORY / BIG PHOTO --><!-- CATEGORY / BIG PHOTO -->
<br><br><br><br><br>
<!-- Footer -->
<footer class="navbar navbar-default navbar-fixed-bottom">
	<div class="row">
		<span></span>
		<!-- <h6 align="center"> 現在のカート </h6>  -->

		<div class="col-md-1">
			<br>☜ カート
		</div>
	</div>
</footer>
</body>
</html>

