<!DOCTYPE html>
<html lang="jp">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>お茶屋さん</title>
	<!-- bootstrap -->
	<link href="/ECSHOP_TEST/boot/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link href="/ECSHOP_TEST/css/ecshop.css" rel="stylesheet">
	<style type="text/css"> body {
			padding-top: 50px;
		} </style>

	<!-- bootstrap carosel -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="/ECSHOP_TEST/js/ecshop.js"></script>
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
					<li><a href="/ECSHOP_TEST/index.php/Controller_EC/cartAll">カート</a></li>
					<li><a href="/ECSHOP_TEST/index.php/Controller_EC/order_info_page">注文情報</a></li>
					<?php
				} else {
					?>
					<li><a href="#">『<?php echo $this->session->userdata['ss_user_id']; ?>』
							様ご来店ありがとうございます。</a></li>
					<li><a href="#" onclick="logout()">ログアウト</a></li>
					<li><a href="/ECSHOP_TEST/index.php/Controller_EC/cartAll">カート</a></li>
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
<div class="container-fluid">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-1">
			<a href="/ECSHOP_TEST/index.php/Controller_EC/home"><img src="/ECSHOP_TEST/img/logo.png" width="230px"></a>
		</div>
		<div class="col-md-5">
			<form class="navbar-form navbar-right">
				<input type="text" class="form-control" placeholder="Search"/>
				<a href="#"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
			</form>
		</div>
		<div class="col-md-5">
		</div>
	</div>
</div>
<!-- LOGO / SEARCH -->

<!-- INTRODUCE / EVENT / REVIEW / FAQ -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">

		</div>
		<div class="col-md-9">
			<div class="collapse navbar-collapse" id="target">
				<ul class="nav navbar-nav">
					<li><a href="#">紹介</a></li>
					<li><a href="#">イベント(セール)</a></li>
					<li><a href="#">レビュー</a></li>
					<li><a href="#">FAQ</a></li>
					<li><a href="#">お問い合わせ</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- INTRODUCE / EVENT / REVIEW / FAQ -->

<!-- CATEGORY / BIG PHOTO --><!-- CATEGORY / BIG PHOTO -->
<div class="container-fluid">
	<div class="row">
		<!-- 3단길이의 첫번째 열 -->
		<div class="col-md-1">
		</div>
		<div class="col-md-2">
			<!-- <-- 패널 타이틀(optional) -->
			<br>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1 class="panel-title">カテゴリリスト</h1>
				</div>
				<!-- <-- 메뉴목록 -->
				<ul class="list-group">
					<?php foreach ($category as $ls) : ?>
						<li class="list-group-item"><a
								href="/ECSHOP_TEST/index.php/Controller_EC/category/<?= $ls->cg_no ?>"><?= $ls->cg_name ?></a>
						</li>
					<?php endforeach ?>
				</ul>
			</div>
		</div>
		<!-- 카테고리, 큰사진 중 큰사진 및 상품태그 시작 -->
		<div class="col-md-9">

			<h3>注文ページ</h3>
			<form method="post" action="/ECSHOP_TEST/index.php/Controller_EC/update">
				<table class="table table-striped table-bordered table-hover">
					<thead>
					<tr class="success">
						<th>写真</th>
						<th>商品名</th>
						<th>値段</th>
						<th>数量</th>
						<th>合計</th>
					</tr>
					</thead>
					<tbody>
					<?php $i = 1; ?>
					<?php foreach ($this->cart->contents() as $items): ?>
						<input type="hidden" name="rowid[]" value="<?php echo $items['rowid']; ?>"/>
						<tr>

							<td align="center"><img src="/ECSHOP_TEST<?php echo $items['img']; ?>"
													style="min-height:80px; height:50px;"/></td>

							<td><?php echo $items['name']; ?></td>
							<td><?php echo number_format($items['price']); ?>円</td>
							<td>
								<?php echo $items['qty'] ?>
							</td>
							<td><?php echo number_format($items['subtotal']); ?>円</td>
						</tr>
						<?php $i++; ?>
					<?php endforeach; ?>
					<tr>
						<td colspan="3" align="center"> 総合計</td>
						<td><?php echo number_format($this->cart->total_items()); ?>個</td>
						<td><?php echo number_format($this->cart->total()); ?>円</td>
					</tr>
					</tbody>

				</table>
			</form>

			<div class="container-fluid">
				<div class="row">
					<!-- 3단길이의 첫번째 열 -->
					<div class="col-md-1">
					</div>

					<div class="col-md-10">
						<span>
							<h4>注文者情報</h4>
						</span>
						<span class="need-info">
							<span>必須 : </span>
							<span class="need-mark">*</span>
						</span>
						<form id="login-form" action="/ECSHOP_TEST/index.php/Controller_EC/order" method="post"
							  onsubmit="return confirmOrderValue();">
							<input type="hidden" name="order_price"
								   value="<?php echo number_format($this->cart->total()); ?>">
							<table class="table table-bordered">
								<?php
								if ($this->session->userdata['ss_user_no'] == 0) {
									?>
									<tr>
										<td width="100px">
											<span class="need-mark">*</span>
											<span>名前</span>
										</td>
										<td><input class="form-control order_info" type="text" name="order_name"></td>
									</tr>
									<tr>
										<td width="100px">
											<span class="need-mark">*</span>
											<span>メール</span>
										</td>
										<td><input class="form-control order_info" type="text" name="order_email"></td>
									</tr>
									<tr>
										<td width="100px">
											<span class="need-mark">*</span>
											<span>連絡先</span>
										</td>
										<td><input class="form-control order_info" type="text" name="order_hp"></td>
									</tr>
									<?php
								} else {
									?>
									<tr>
										<td width="100px">
											<span class="need-mark">*</span>
											<span>名前</span>
										</td>
										<td>
											<input class="form-control order_info" type="text" name="order_name"
												   value="<?= $user_info[0]->user_name ?>">
										</td>
									</tr>
									<tr>
										<td width="100px">
											<span class="need-mark">*</span>
											<span>メール</span>
										</td>
										<td><input class="form-control order_info" type="text" name="order_email"
												   value="<?= $user_info[0]->user_email ?>"></td>
									</tr>
									<tr>
										<td width="100px">
											<span class="need-mark">*</span>
											<span>連絡先</span>
										</td>
										<td><input class="form-control order_info" type="text" name="order_hp"
												   value="<?= $user_info[0]->user_phoneNumber ?>"></td>
									</tr>
									<?php
								}
								?>
							</table>
							<span>
								<h4>配送先情報</h4>
							</span>
							<span class="need-info">
								<span>必須 : </span>
								<span class="need-mark">*</span>
							</span>

							<table class="table table-bordered">
								<tr>
									<td width="100px">
										<span class="need-mark">*</span>
										<span>名前</span>
									</td>
									<td><input class="form-control order_info" type="text" name="receiver_name"
											   value=""></td>
								</tr>
								<tr>
									<td width="100px">
										<span class="need-mark">*</span>
										<span>連絡先</span>
									</td>
									<td><input class="form-control order_info" type="text" name="receiver_hp"
											   value=""></td>
								</tr>
								<tr>
									<td width="100px">
										<span class="need-mark">*</span>
										<span>住所</span>
									</td>
									<td><input class="form-control order_info" type="text" name="receiver_address"
											   value=""></td>
								</tr>
								<tr>
									<td width="100px">お願いのメッセージ</td>
									<td><input class="form-control" type="text" name="memo"
											   value=""></td>
								</tr>
								<tr>

								</tr>
							</table>

							<h4>決済情報</h4>

							<table class="table table-bordered">
								<tr>
									<td width="100px">決済方法</td>
									<td width="">
										<input type="radio" name="payment_option" checked="checked" value="1"/> 銀行振込
										<br>
										<input type="radio" name="payment_option" value="2"/> 代金引換
										<br>
										<input type="radio" name="payment_option" value="3"/> クレジットカード決済
										<br>
										<input type="radio" name="payment_option" value="4"/> 後払い決済
										<br>

									</td>
								</tr>
							</table>

							<div>
								<button type="submit" class="form-control btn btn-success">注文確定</button>
							</div>

						</form>
					</div>
					<div class="col-md-1">
					</div>
				</div>
			</div>

			<br><br><br><br><br>
			<!-- Footer -->
			<footer class="navbar navbar-default navbar-fixed-bottom">
				<div class="row">
					<span></span>
					<!-- <h6 align="center"> 現在のカート </h6>  -->
					<?php $i = 1; ?>
					<?php foreach ($this->cart->contents() as $items): ?>
						<div class="col-md-1">
							<div class="thumbnail">
								<a href="/ECSHOP_TEST/index.php/Controller_EC/product/<?php echo $items['id']; ?>">
									<img class="img-thumbnail" src="/ECSHOP_TEST<?php echo $items['img']; ?>"
										 style="min-height:50px; height: 50px"/>
								</a>
							</div>
						</div>
						<?php $i++; ?>
					<?php endforeach; ?>
					<div class="col-md-1">
						<br>☜ カート
					</div>
				</div>
			</footer>
</body>
</html>
