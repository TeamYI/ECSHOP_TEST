<!DOCTYPE html>
<html lang="jp">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>お茶屋さん</title>
    <!-- bootstrap -->
    <link href="/ci/boot/css/bootstrap.min.css" rel="stylesheet"> 
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
            <?php 
              if($this->session->userdata['ss_user_id']== "costomer"){
            ?>
                <li><a href="#">『<?php echo $this->session->userdata['ss_user_id']; ?>』
                   様には会員登録お勧めします。</a></li>
                <li><a href="/ci/index.php/Controller_EC/login_page">Login</a></li>
                <li><a href="/ci/index.php/Controller_EC/signin_page">Sign In</a></li>
                <li><a href="/ci/index.php/Controller_EC/cart_page/1">Cart</a></li>
                <li><a href="/ci/index.php/Controller_EC/order_info_page">注文情報</a></li>
            <?php
              }else{
            ?>
                <li><a href="#">『<?php echo $this->session->userdata['ss_user_id']; ?>』
                   様ご来店ありがとうございます。</a></li>
                   <li><a href="/ci/index.php/Controller_EC/logout">Logout</a></li>
                <li><a href="/ci/index.php/Controller_EC/cart_page/1">Cart</a></li>
                <li><a href="/ci/index.php/Controller_EC/mypage/2">MyPage</a></li>       
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
          <a href="/ci/index.php/Controller_EC/home"><img src="/ci/img/logo.png" width="230px"></a>
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
              <?php foreach($category as $ls) : ?>
                 <li class="list-group-item"><a href="#"><?=$ls->cg_name?></a></li>
              <?php endforeach ?>
            </ul>
          </div>
        </div>
        <!-- 카테고리, 큰사진 중 큰사진 및 상품태그 시작 -->
        <div class="col-md-6">
          <!-- 로그인폼 --><!-- 로그인폼 -->
          <form id="login-form" action="/ci/index.php/Controller_EC/signin" method="post">
            <br>
            <div>
              <input type="text" class="form-control" name="user_id" placeholder="User ID" autofocus>
            </div>
            <br>
            <div>
              <input type="password" class="form-control" name="user_pw" placeholder="Password">
            </div>
            <br>
            <div>
              <input type="text" class="form-control" name="user_name" placeholder="Name">
            </div>
            <br>
            <div>
              <input type="text" class="form-control" name="user_sex" placeholder="Gender">
            </div>
            <br>
            <div>
              <input type="text" class="form-control" name="user_email" placeholder="Email">
            </div>
            <br>
            <div>
              <input type="text" class="form-control" name="user_phoneNumber" placeholder="Phone Number">
            </div>
            <br>
            <div>
              <input type="text" class="form-control" name="user_birth" placeholder="Birth">
            </div>
            <br>
            <div>
              <input type="text" class="form-control" name="user_address" placeholder="Address">
            </div>
            <br>
            <div>
              <button type="submit" class="form-control btn btn-success">SIGN IN</button>
            </div>
          </form>
          <!-- 로그인폼 --><!-- 로그인폼 -->
        </div>
        <div class="col-md-3">

        </div>
      </div>
    </div>
    <!-- CATEGORY / BIG PHOTO --><!-- CATEGORY / BIG PHOTO -->
    <br><br><br>

    <!-- Footer -->
    <footer class="navbar navbar-default navbar-fixed-bottom">
      <div class="container">
        <h6 align="center">ご来店ありがとうござす。</h6>
      </div>
    </footer>
  </body>
</html>