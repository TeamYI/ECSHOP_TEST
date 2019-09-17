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
					<a href="/ECSHOP_TEST/index.php/moveAdmin"><img src="/ECSHOP_TEST/img/logo.png"
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
								<li><a href="/ECSHOP_TEST/index.php/manager/order" class="order">受注台帳を見る</a></li>
							</ul>
						</li>
						<li>
							<h3 ><span class="icon-tasks"></span>商品台帳</h3>
							<ul>
								<li><a href="/ECSHOP_TEST/index.php/manager/product" class="product">商品台帳を見る</a></li>
								<li><a href="/ECSHOP_TEST/index.php/manager/productUploadPage" class="productUpload">商品登録</a></li>
							</ul>
						</li>
						<li>
							<h3><span class="icon-calendar customer"></span>顧客台帳</h3>
							<ul>
								<li><a href="#">顧客台帳を見る</a></li>
							</ul>
						</li>
						<li>
							<h3><span class="icon-heart question"></span>Q&A</h3>
							<ul>
								<li><a href="#">Q&Aを見る</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<input type="hidden" name="page" value="order">
			<div class="col-md-9">
				<h3>注文番号 : <?php echo $orderInfo->od_no ?></h3>
				<div class="col-md-5" >
					<div class="greyLine">
						<div class="orderSubTitle">
							<h4>注文情報</h4>
						</div>
						<div class="orderInfoDiv">
							<span> 注文日時</span>
							<span><?php echo $orderInfo->od_date ?></span>
						</div>
						<div class="orderInfoDiv">
							<span>注文番号</span>
							<span><?php echo $orderInfo->od_no ?></span>
						</div>
						<div class="orderInfoDiv">
							<span>決済方法</span>
							<span><?php echo $orderInfo->payment_name ?></span>
						</div>
					</div>
					<div class="greyLine">
						<div class="orderSubTitle">
							<h4>ステータス変更</h4>
						</div>
						<div class="orderInfoDiv">
							<span>決済</span>
							<span>
								<select name="paymentCheck" id="">
									<?php if( $orderInfo->payment_check === "未入金" ){ ?>
										<option value="未入金" selected>未入金</option>
										<option value="入金完了">入金完了</option>
									<?php }else{ ?>
										<option value="未入金" >未入金</option>
										<option value="入金完了" selected>入金完了</option>
									<?php } ?>
								</select>
							</span>
						</div>
						<div class="orderInfoDiv">
							<span>発送</span>
							<span>
								<select name="deliveryStatus" id="">
									<?php if( $orderInfo->delivery_status === "配送準備中" ){ ?>
										<option value="配送準備中" selected>配送準備中</option>
										<option value="配送中">配送中</option>
										<option value="配送完了">配送完了</option>
									<?php }else if( $orderInfo->delivery_status === "配送中" ){ ?>
										<option value="配送準備中">配送準備中</option>
										<option value="配送中" selected>配送中</option>
										<option value="配送完了">配送完了</option>
									<?php }else{ ?>
										<option value="配送準備中">配送準備中</option>
										<option value="配送中">配送中</option>
										<option value="配送完了" selected>配送完了</option>

									<?php } ?>
								</select>
							</span>
						</div>
						<button class="changeStatus" onclick="orderStatusChange('<?php echo $orderInfo->od_no ?>')">保存</button>

					</div>
				</div>
				<div class="col-md-7" >
					<div class="greyLine">
						<div class="orderSubTitle">
							<h4>注文者情報</h4>
						</div>
						<div class="orderInfoDiv">
							<span> お名前</span>
							<span><?php echo $ordererInfo->od_name ?></span>
						</div>
						<div class="orderInfoDiv">
							<span>電話番号</span>
							<span><?php echo $ordererInfo->od_hp ?></span>
						</div>
						<div class="orderInfoDiv">
							<span>メールアドレス</span>
							<span><?php echo $ordererInfo->od_email ?></span>
						</div>
					</div>
					<div class="greyLine">
						<div class="orderSubTitle">
							<h4>お届け先情報</h4>
						</div>
						<div class="orderInfoDiv">
							<span> お名前</span>
							<span><?php echo $receiverInfo->receiver_name ?></span>
						</div>
						<div class="orderInfoDiv">
							<span>電話番号</span>
							<span><?php echo $receiverInfo->receiver_hp ?></span>
						</div>
						<div class="orderInfoDiv">
							<span>ご住所</span>
							<span><?php echo $receiverInfo->receiver_address ?></span>
						</div>
						<div class="orderInfoDiv">
							<span>memo</span>
							<span><?php echo $receiverInfo->memo ?></span>
						</div>
					</div>
				</div>
				<div class="col-md-12 " >
						<div class="orderSubTitle">
							<h4>商品情報</h4>
						</div>
						<table class="table table-striped table-bordered table-hover col-md-12">
							<thead>
							<tr class="success">
								<!--               <th align="center" width="65px">取消し</th> -->
								<th>写真</th>
								<th>商品名</th>
								<th>値段</th>
								<th>数量</th>
								<th>合計</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($orderProductInfo as $orderProductInfo): ?>
								<tr>
									<td align="center"><img src="/ECSHOP_TEST<?php echo $orderProductInfo->pd_img ?>" style="min-height:80px; height:50px;"/></td>
									<td><?php echo $orderProductInfo->pd_name ?></td>
									<td><?php echo $orderProductInfo->pd_price ?>円</td>
									<td><?php echo $orderProductInfo->od_qty ?></td>
									<td><?php echo ((integer)$orderProductInfo->pd_price*(integer)$orderProductInfo->od_qty) ?>円</td>
								</tr>
							<?php endforeach; ?>
							<td colspan="4" align="center"> 総合計</td>
							<td><?php echo $orderProductInfo->od_price ?>円</td>
							</tbody>
						</table>
					</div>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>


<!-- Footer -->
<footer class="navbar navbar-default navbar-fixed-bottom">

</footer>
</body>
</html>

