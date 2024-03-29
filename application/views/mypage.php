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
		<div class="col-md-8">
			<!-- 주문내역 -->
			<h3>MyPage</h3>
			<hr>
			<div class="tabs col-md-12">
				<input id="userInfo" type="radio" name="tab_item" checked>
				<label class="tab_item col-md-4" for="userInfo">ユーザー情報</label>
				<input id="orderHistory" type="radio" name="tab_item">
				<label class="tab_item col-md-4" for="orderHistory">注文履歴</label>
				<div class="tab_content" id="userInfo_content">
					<div class="mypage-user-info">
						<h4>ユーザー情報</h4>
						<span class="need-info">
							<span>必須 : </span>
							<span class="need-mark">*</span>
						</span>
						<table class="table table-bordered table-hover">
							<tr class="info">
								<td width="100px"><span class="need-mark">*</span>アカウント</td>
								<td><?= $user_info[0]->user_id ?></td>
							</tr>
							<tr>
								<td width="100px"><span class="need-mark">*</span>パスワード</td>
								<td><input type="password" name="user_pw" value="<?= $user_info[0]->user_pw ?>"></td>
							</tr>
							<tr class="success">
								<td width="100px"><span class="need-mark">*</span>名前</td>
								<td><input type="text" name="user_name" value="<?= $user_info[0]->user_name ?>"></td>
							</tr>
							<tr>
								<td width="100px"><span class="need-mark">*</span>メール</td>
								<td><input type="text" name="user_email" value="<?= $user_info[0]->user_email ?>"></td>
							</tr>
							<tr class="warning">
								<td width="100px"><span class="need-mark">*</span>連絡先</td>
								<td><input type="text" name="user_phoneNumber"
										   value="<?= $user_info[0]->user_phoneNumber ?>"></td>
							</tr>
							<tr class="active">
								<td width="100px"><span class="need-mark">*</span>住所</td>
								<td><input type="text" name="user_address" value="<?= $user_info[0]->user_address ?>">
								</td>
							</tr>
						</table>
						<button class="btn btn-success" onclick="updateUserInfo()">保存</button>
					</div>
				</div>
				<div class="tab_content" id="orderHistory_content">
					<div class="tab_content_description">
						<div>
							<h4>注文履歴</h4>
						</div>
						<?php if($order_main != null){ ?>
						<?php foreach ($order_main as $main_ls) : ?>
								<table class="table table-striped table-bordered table-hover col-md-12">
									<thead>
										<tr class="success">
											<!--               <th align="center" width="65px">取消し</th> -->
										<tr class="info">
											<td colspan="1" width="100px">注文番号</td>
											<td colspan="3"><?= $main_ls->od_no ?></td>
										</tr>
										<tr class="success">
											<td colspan="1" width="100px">注文日時</td>
											<td colspan="3"><?= $main_ls->od_date ?></td>
										</tr>
										<tr class="warning">
											<td colspan="1" width="100px">配送先</td>
											<td colspan="3"><?= $main_ls->receiver_address ?></td>
										</tr>
										<th>商品名</th>
										<th>数量</th>
										<th>合計</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($order_info as $info_ls) : ?>
										<?php if ($main_ls->od_no == $info_ls->od_no) { ?>
											<tr>
												<td><?= $info_ls->pd_name ?></td>
												<td><?= $info_ls->od_qty ?></td>
												<td><?= $info_ls->od_price ?></td>
											</tr>
										<?php } ?>
									<?php endforeach ?>
									<tr class="warning">
										<td colspan="2">合計</td>
										<td><?= $main_ls->od_price ?></td>
									</tr>
									</tbody>
								</table>
						<?php endforeach ?>
						<?php }else{   ?>
							<div>
								<h5>購入履歴がありません。</h5>
							</div>

						<?php }   ?>
					</div>
				</div>
			</div>


			<!-- 주문내역 -->
		</div>
		<div class="col-md-1">

		</div>
	</div>
</div>
<!-- CATEGORY / BIG PHOTO --><!-- CATEGORY / BIG PHOTO -->
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
