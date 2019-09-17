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

	<style type="text/css"> body {
			padding-top: 50px;
		} </style>

	<!-- bootstrap carosel -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="/ECSHOP_TEST/js/admin.js"></script>
</head>
<body>
<!-- TOP -->
<div class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<a class="navbar-brand" href="#"> </a>
		<div class="navbar-header">
			<button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#target">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse" id="target">
			<ul class="nav navbar-nav navbar-right">
				<?php
				if ($this->session->userdata['ss_user_id'] == "costomer") {
					?>
					<li><a href="#">『<?php echo $this->session->userdata['ss_user_id']; ?>』
							様には会員登録お勧めします。</a></li>
					<li><a href="/ECSHOP_TEST/index.php/Controller_EC/login_page">ログイン</a></li>
					<li><a href="/ECSHOP_TEST/index.php/Controller_EC/signin_page">会員登録</a></li>
					<li><a href="/ECSHOP_TEST/index.php/Controller_EC/cart_page/1">カート</a></li>
					<li><a href="/ECSHOP_TEST/index.php/Controller_EC/order_info_page">注文情報</a></li>
					<?php
				} else {
					?>
					<li><a href="#">『<?php echo $this->session->userdata['ss_user_id']; ?>』
							様ご来店ありがとうございます。</a></li>
					<li><a href="/ECSHOP_TEST/index.php/Controller_EC/logout">ログアウト</a></li>
					<li><a href="/ECSHOP_TEST/index.php/Controller_EC/cart_page/1">カート</a></li>
					<li><a href="/ECSHOP_TEST/index.php/Controller_EC/mypage/2">MyPage</a></li>
					<?php
				}
				?>
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
					<a href="/ECSHOP_TEST/index.php/Controller_EC/home"><img src="/ECSHOP_TEST/img/logo.png"
																			 width="230px"></a>
				</div>
			</div>
			<div class="col-xs-6 col-sm-4">
			</div>

			<!--			--><?php
			//			if($this->session->userdata['ss_user_id']== "master"){
			//				?>
			<!--				<a href="/ECSHOP_TEST/index.php/Controller_EC/product_upload_page"><img src="/ECSHOP_TEST/img/pd_insert.png" width="180px"></a>-->
			<!--			--><?php //} ?>
		</div>
	</div>
</header>
<!-- LOGO / SEARCH -->

<section>
	<!-- CATEGORY / BIG PHOTO --><!-- CATEGORY / BIG PHOTO -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="col-md-3">
					<div id="accordian">
						<ul>
							<li>
								<h3><span class="icon-dashboard"></span>受注台帳</h3>
								<ul>
									<li><a href="#">受注台帳を見る</a></li>
								</ul>
							</li>
							<li class="active">
								<h3><span class="icon-tasks"></span>商品台帳</h3>
								<ul>
									<li><a href="#">商品台帳を見る</a></li>
									<li><a href="#">商品登録</a></li>
								</ul>
							</li>
							<li>
								<h3><span class="icon-calendar"></span>顧客台帳</h3>
								<ul>
									<li><a href="#">顧客台帳を見る</a></li>
								</ul>
							</li>
							<li>
								<h3><span class="icon-heart"></span>Q&A</h3>
								<ul>
									<li><a href="#">Q&Aを見る</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-9">
					<div class="title">
						<h3>受注台帳を見る</h3>
					</div>
						<table>
							<colgroup>
								<col class="col-md-1">
								<col class="col-md-2">
								<col class="col-md-2">
								<col class="col-md-2">
								<col class="col-md-1">
								<col class="col-md-2">
								<col class="col-md-1">
								<col class="col-md-1">
							</colgroup>
							<thead>
							<tr>
								<th>選択</th>
								<th>注文日時</th>
								<th>注文番号</th>
								<th>注文者</th>
								<th>合計金額</th>
								<th>決済方法</th>
								<th>入金状態</th>
								<th>発送</th>
							</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="8">
										<h4>注文履歴がありません。</h4>
									</td>
								</tr>
								<tr>
									<td>

									</td>
								</tr>
							</tbody>
						</table>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</section>


<!-- Footer -->
<footer class="navbar navbar-default navbar-fixed-bottom">

</footer>
</body>
</html>

