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
							<h3><span class="icon-tasks"></span>商品台帳</h3>
							<ul>
								<li><a href="/ECSHOP_TEST/index.php/manager/product" class="product">商品台帳を見る</a></li>
								<li><a href="/ECSHOP_TEST/index.php/manager/productUploadPage" class="productUpload">商品登録</a>
								</li>
							</ul>
						</li>
						<li>
							<h3><span class="icon-calendar"></span>顧客台帳</h3>
							<ul>
								<li><a href="/ECSHOP_TEST/index.php/manager/customer" class="customer">顧客台帳を見る</a></li>
							</ul>
						</li>

					</ul>
				</div>
			</div>
			<input type="hidden" name="page" value="product">
			<div class="col-md-9">
				<form id="" action="/ECSHOP_TEST/index.php/updateProduct" method="post" enctype="multipart/form-data" onsubmit="return confirmText()">
				<h3>商品番号 : <?php echo $product->pd_number ?></h3>
				<input type="hidden" value="<?php echo $product->pd_no ?>" name="pd_no">
				<div class="col-md-5">
					<img src="/ECSHOP_TEST<?php echo $product->pd_img ?>" alt="" id="showImg" class="col-md-12" style="height:352px ">
				</div>
				<div class="col-md-7">
					<div class="greyLine">
						<div class="orderInfoDiv">
							<span>商品番号</span>
							<span><?php echo $product->pd_number ?></span>
						</div>
						<div class="orderInfoDiv">
							<span>商品名</span>
							<span><input type="text" value="<?php echo $product->pd_name ?>" name="pd_name"></span>
						</div>
						<div class="orderInfoDiv">
							<span>販売価格(円)</span>
							<span><input type="text" value="<?php echo $product->pd_price ?>" name="pd_price"></span>
						</div>
						<div class="orderInfoDiv">
							<span>在庫</span>
							<span><input type="text" value="<?php echo $product->pd_stock ?>" name="pd_stock"></span>
						</div>
						<div class="orderInfoDiv">
							<span>写真変更</span>
							<span>
								<input type="file" id="updateProductImg" name="userfile">
								<input type="hidden" value="<?php echo $product->pd_img ?>" name="pd_img">
							</span>
						</div>
						<div class="orderInfoDiv">
							<span>カテゴリ名</span>
							<span>
								<select name="category" id="">
									<?php foreach ($category as $category) : ?>
										<?php if($category->cg_name === $product->cg_name){ ?>
											<option value="<?php echo $category->cg_no ?>" selected><?php echo $category->cg_name ?></option>
										<?php  }else{  ?>
											<option value="<?php echo $category->cg_no ?>"><?php echo $category->cg_name ?></option>
										<?php } ?>
									<?php endforeach ?>
								</select>
						</div>
						<div class="orderInfoDiv">
							<span>memo(管理者用)</span>
							<span><input type="text" value="<?php echo $product->pd_memo ?>" name="pd_memo"></span>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="greyLine">
						<span><h4>商品説明</h4></span>
						<textarea name="comment" id="" cols="30" rows="10" style="width:100%"><?php echo $product->pd_comment ?></textarea>
					</div>
				</div>
				<div class="col-md-12">
					<input type="submit" value="保存">
				</div>
				</form>
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

