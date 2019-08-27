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
                <li><a href="/ECSHOP_TEST/index.php/Controller_EC/login_page">ログイン</a></li>
                <li><a href="/ECSHOP_TEST/index.php/Controller_EC/signin_page">会員登録</a></li>
                <li><a href="/ECSHOP_TEST/index.php/Controller_EC/cart_page/1">カート</a></li>
                <li><a href="/ECSHOP_TEST/index.php/Controller_EC/order_info_page">注文情報</a></li>
            <?php
              }else{
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
              <?php foreach($category as $ls) : ?>
                 <li class="list-group-item"><a href="/ECSHOP_TEST/index.php/Controller_EC/category/<?=$ls->cg_no?>"><?=$ls->cg_name?></a></li>
              <?php endforeach ?>
            </ul>
          </div>
        </div>
        <!-- 카테고리, 큰사진 중 큰사진 및 상품태그 시작 -->
        <div class="col-md-9">
  
          <h3>カゴページ</h3>
          <form method="post" action="/ECSHOP_TEST/index.php/Controller_EC/update">
          <table class="table table-striped table-bordered table-hover">
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
          <?php $i=1;?>
          <?php foreach($this->cart->contents() as $items): ?>
          <input type="hidden" name="rowid[]" value="<?php echo $items['rowid'];?>" />
          <tr>
<!--             <td align="center"><input type="checkbox" name="del[]" value="<?php echo $i - 1;?>" /></td> -->
            <td align="center"><img src="/ECSHOP_TEST<?php echo $items['img']; ?>"style="min-height:80px; height:50px;" /></td>
            <td><?php echo $items['name']; ?></td>
            <td><?php echo number_format($items['price']); ?>円</td>
            <td>
              <input type="text" name="qty[]" value="<?php echo $items['qty']?>" maxlength="3" size="5" style="text-align:right"/>
            </td>
            <td><?php echo number_format($items['subtotal']); ?>円</td>
          </tr>
          <?php $i++; ?>
          <?php endforeach; ?>
          <td colspan="3" align="center"> 総合計</td>
          <td><?php echo number_format($this->cart->total_items());?>個</td>
          <td><?php echo number_format($this->cart->total());?>円</td>
          </tbody>
          <tfoot>
          <tr>
              <td colspan="5" style="text-align: center">
                  <input type="button" class="btn btn-success" onclick="location.href=
                  '/ECSHOP_TEST/index.php/Controller_EC/order_page'" value="購入" />
                  <input type="button" class="btn btn-default" onclick="location.href=
                  '/ECSHOP_TEST/index.php/Controller_EC/destroy'" value="カゴ全体削除" />
                  <input type="submit" class="btn btn-default" value="カゴ修正" />
              </td>
          </tr>
          </tfoot>
          </table>
          </form>

<!--           <?php echo form_open('/ECSHOP_TEST/index.php/Controller_EC/update'); ?>
          <table class="table table-striped table-bordered table-hover">
            <tr class="success">
              <th>数量</th>
              <th>商品名</th>
              <th>値段</th>
              <th>金額</th>
            </tr>

            <?php $i = 1; ?>
            <?php foreach($this->cart->contents() as $items): ?>
              <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
              <tr>
                <td><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>
                <td>
                <?php echo $items['name']; ?>
                  <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
                    <p>
                      <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                        <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />
                      <?php endforeach; ?>
                    </p>
                  <?php endif; ?>
                </td>
                <td><?php echo $this->cart->format_number($items['price']); ?></td>
                <td>$<?php echo $this->cart->format_number($items['subtotal']); ?></td>
              </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
            <tr class="success">
              <td colspan="2"> </td>
              <td class="right"><strong>合計金額</strong></td>
              <td class="right">$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
            </tr>
          </table>
          <p><?php echo form_submit('', '更新'); ?></p> -->
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
              <a href="/ECSHOP_TEST/index.php/Controller_EC/product/<?php echo $items['id']; ?>">
                <img class="img-thumbnail" src="/ECSHOP_TEST<?php echo $items['img']; ?>"style="min-height:50px; height: 50px" />
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
