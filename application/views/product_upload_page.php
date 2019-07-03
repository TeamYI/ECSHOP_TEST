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
                 <li class="list-group-item"><a href="/ci/index.php/Controller_EC/category/<?=$ls->cg_no?>"><?=$ls->cg_name?></a></li>
              <?php endforeach ?>
            </ul>
          </div>
        </div>
        <!-- 카테고리, 큰사진 중 큰사진 및 상품태그 시작 -->
        <div class="col-md-6">

          <!-- 카테고리 등록-->
        <h4>カテゴリ登録</h4>
          <form id="order_name" action="/ci/index.php/Controller_EC/upload_category" method="post">
            <div class="input-group double-input">
              <span class="input-group-btn">
                <div class="dropdown">
                  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                    カテゴリ一覧
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                  <?php foreach($category as $ls) : ?>
                    <li role="presentation"><a href="#"><?=$ls->cg_name?></a></li>
                  <?php endforeach ?>

                  </ul>
                </div>
              </span>
              <input type="text" name="cg_name" placeholder="カテゴリ名" class="form-control" />
              <span class="input-group-btn">
                  <button class="btn btn-success" type="submit">登録</button>
              </span>
            </div><!-- /input-group -->
          </form>
        <hr>

  
        <h4>商品登録</h4>
          <!-- 로그인폼 --><!-- 로그인폼 -->

            <!-- 상품등록 - 사진등록 -->
            <?php echo form_open_multipart('http://www.localhost/ci/index.php/Controller_EC/do_upload');?>
              <div class="input-group double-input">
                <span class="input-group-btn">
                <input class="btn btn-default" type="file" name="userfile" /></span>
                <span class="input-group-btn">
                    <input class="btn btn-success" type="submit" value="Photo Upload" />
                </span>
              </div><!-- /input-group -->
            </form>
            <br>

 

          <form id="order_name" action="/ci/index.php/Controller_EC/upload_product" method="post">
            
            <div>
              <input type="hidden" class="form-control" name="pd_img" value="<?php if(isset($img['img_path'])) echo $img['img_path']; ?>">
            </div>

            <!-- 상품등록 - 카테고리 일람 -->
            <div class="input-group double-input">
              <span class="input-group-btn">
                <div class="dropdown">
                  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                    カテゴリ一覧
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                  <?php foreach($category as $ls) : ?>
                    <div class="radio">
                      <label> 
                        <input type="radio" name="cg_no" id="radio" value="<?=$ls->cg_no?>" checked>
                        <?=$ls->cg_name?> 
                      </label>
                    </div>
                  <?php endforeach ?>

                  </ul>
                </div>
              </span>

            </div>
            <br>

            <div>
              <input type="text" class="form-control" name="pd_number" placeholder="商品番号">
            </div>
            <br>
            <div>
              <input type="text" class="form-control" name="pd_name" placeholder="商品名">
            </div>
            <br>
            <div>
              <input type="text" class="form-control" name="pd_price" placeholder="値段">
            </div>
            <br>
            <div>
              <input type="text" class="form-control" name="pd_stock" placeholder="在庫">
            </div>
            <br>
            <div>
              <textarea class="form-control" name="pd_comment" placeholder="商品説明"></textarea>
            </div>
            <br>
            <div>
              <textarea class="form-control" name="pd_memo" placeholder="商品メモ（管理者用）"></textarea>
            </div>
     
            <br>
            <div>

              <input type="button"class="btn btn-success" value="商品画像や説明の追加" name="" id="additional_input_box"><br><br>
              <div id="test">
                
              </div>

              <button type="submit" class="form-control btn btn-success">登録</button>
            </div>
          </form>
          <!-- 로그인폼 --><!-- 로그인폼 -->

        <script>
          var click_sum = 0;
          var str1 = '<input type="button" class="btn btn-info" name="" value="IMG　UPLOAD　代替"><br><br><textarea class="form-control" name="additional_pd_comment1" placeholder="商品説明"></textarea><hr>';
          var str2 = '<input type="button" class="btn btn-info" name="" value="IMG　UPLOAD　代替"><br><br><textarea class="form-control" name="additional_pd_comment1" placeholder="商品説明"></textarea><hr><input type="button" class="btn btn-info" name="" value="IMG　UPLOAD　代替"><br><br><textarea class="form-control" name="additional_pd_comment2" placeholder="商品説明"></textarea><hr>';
          var str3 = '<input type="button" class="btn btn-info" name="" value="IMG　UPLOAD　代替"><br><br><textarea class="form-control" name="additional_pd_comment1" placeholder="商品説明"></textarea><hr><input type="button" class="btn btn-info" name="" value="IMG　UPLOAD　代替"><br><br><textarea class="form-control" name="additional_pd_comment2" placeholder="商品説明"></textarea><hr><input type="button" class="btn btn-info" name="" value="IMG　UPLOAD　代替"><br><br><textarea class="form-control" name="additional_pd_comment3" placeholder="商品説明"></textarea><hr>';
          var temp;
            $('#additional_input_box').click( function() {
              temp = prompt('追加画像は三個までです。', '1');
              click_sum++;
              if( temp == 1 ) $('#test').html(str1);
              else if( temp == 2 ) $('#test').html(str2);
              else if( temp == 3 ) $('#test').html(str3);
              else alert('追加画像は三個までです。');
            });

            $('#getResult').click( function() {
                //$('#result').html('');
                
                $.ajax({
                    url: "http://www.localhost/ci/index.php/Controller_EC/ajax_receive",
                    dataType:'text',
                    type:'POST',
                    data:{
                        'txt':$('#txt').val()
                    }
       }).done(function(data) {
                    //$('#result').html(data);
                    $('#pls').val(data);
                });
            });
        </script>

        </div>
        <div class="col-md-3">

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
        <?php $i=1;?>
        <?php foreach($this->cart->contents() as $items): ?>
          <div class="col-md-1">
            <div class="thumbnail">
              <a href="/ci/index.php/Controller_EC/product/<?php echo $items['id']; ?>">
                <img class="img-thumbnail" src="/ci<?php echo $items['img']; ?>"style="min-height:50px; height: 50px" />
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
