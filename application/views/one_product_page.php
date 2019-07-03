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
        <?php foreach($one_product as $ls) : ?>
          <img width="400" src="/ci<?=$ls->pd_img?>" alt="...">
        <?php endforeach ?>  
        </div>
        
<script type="text/javascript">
  function mySubmit(index) {
    if (index == 1) {
      document.myForm.action='/ci/index.php/Controller_EC/buy_page/<?= $one_product[0]->pd_no ?>';
    }
    if (index == 2) {

      var con_test = confirm("カゴへいきますか？");
      if(con_test == true){
        document.myForm.action='/ci/index.php/Controller_EC/cart_page/2';
      }
      else if(con_test == false){
        document.myForm.action='/ci/index.php/Controller_EC/cart_page/3';
      }
    }
    if (index == 3) {
      document.myForm.action='/ci/index.php/Controller_EC/like';
    }
    document.myForm.submit();
  }
</script>

        <div class="col-md-2">   
          <form name="myForm" method="post">
            <h1><?= $one_product[0]->pd_name ?></h1>
            <h3>値段 : <?= $one_product[0]->pd_price ?></h3>
            <h3>在庫 : <?= $one_product[0]->pd_stock ?></h3>
            <p>説明 : <?= $one_product[0]->pd_comment ?></p>

            <input type="text" class="form-control" name="qty" placeholder="qty" autofocus><br>

            <input type="hidden" class="form-control" name="pd_price" value="<?=$ls->pd_price?>" autofocus>
            <input type="hidden" class="form-control" name="pd_name" value="<?=$ls->pd_name?>" autofocus>
            <input type="hidden" class="form-control" name="pd_no" value="<?=$ls->pd_no?>" autofocus>
            <p>
              <input type="button" class="btn btn-primary" value="購入" onclick='mySubmit(1)' />
              <input type="button" class="btn btn-success" value="カゴへ" onclick='mySubmit(2)' 
              />
              <!-- <input type="button" class="btn btn-danger" value="♡" onclick='mySubmit(3)' /> -->
            </p>
          </form>

          <br>
        </div>

        <div class="col-md-1">
        </div>
      </div>
    </div>
    <!-- CATEGORY / BIG PHOTO --><!-- CATEGORY / BIG PHOTO -->
    
    <!-- 상품상세설명 -->
    <div class="container-fluid">
          <div class="row">
           <!-- 3단길이의 첫번째 열 -->
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
            
            <?php foreach($one_product_exp as $ls) : ?>
              <?php
                if( $ls->pd_page_img != '' ){
              ?>
                <img width="350" src="/ci<?=$ls->pd_page_img?>" alt="...">
              <?php
              }
              ?>
              <h2><?=$ls->pd_page_explain?></h2>
              <br><br>
            <?php endforeach ?>              
            </div>
            
            <div class="col-md-3">
            </div>
          </div>
    </div>
    
    <hr>
    <!-- 리뷰 -->
    <div class="container-fluid">
          <div class="row">
           <!-- 3단길이의 첫번째 열 -->
            <div class="col-md-1">
              
            </div>
            <div class="col-md-10">
              <h1>レビュー</h1> 
              <table class="table table-bordered table-hover">
                <tr class="danger">
                  <td width="100px">画像</td>
                  <td width="100px">商品名</td>
                  <td>レビュー</td>
                  <td width="100px">作成者</td>
                </tr>
              </table>
            <?php foreach($review as $ls) : ?>
              <table class="table table-bordered table-hover">
                <tr class="success">
                  <td width="100px"><img style="min-height:50px; height:50px;" src="/ci<?=$ls->rev_img?>"></td>
                  <td width="100px"><?=$ls->pd_name?></td>
                  <td><?=$ls->rev_explain?></td>
                  <td width="100px"><?=$ls->user_name?></td>
                </tr>
                <?php foreach($review_reply as $rr_ls) : ?>

                  <?php if( $ls->rev_no == $rr_ls->rev_no ){ ?>
                  <tr>
                    <td colspan="4"> ➥ <?=$rr_ls->rev_rp_content?></td>
                  </tr>  
                  <?php } ?>

                <?php endforeach ?> 
                <br>
            <?php endforeach ?> 
            </table>

               
            </div>
            <div class="col-md-1">
                         
            </div>
          </div>
    </div>    

    <hr>

    <div class="container-fluid">
          <div class="row">
           <!-- 3단길이의 첫번째 열 -->
            <div class="col-md-1">
              
            </div>
            <div class="col-md-10">
              <h1>お問い合わせ</h1>  
              <table class="table table-striped table-bordered table-hover">
                <tr class="danger">
                  <td width="200px">お問い合わせタイトル</td>
                  <td>お問い合わせ内容</td>
                  <td width="100px">作成者</td>
                </tr>
              </table>
            <?php foreach($inquery as $ls) : ?>
              <table class="table table-bordered table-hover">
                <tr class="success">
                  <td width="200px">
                    <?php if ($this->session->userdata['ss_user_id'] == "master") { ?>
                      
                      <input type="hidden"  id="test2" value="<?=$ls->inq_no?>" name="">

                      <a data-toggle="modal" data-target="#myModal" data-title="Test Title" id="modal" value="123"><?=$ls->inq_title?></a> 
                  <?php  }else{ ?>
                    <?=$ls->inq_title?>
                  <?php  } ?>
                  </td>
                  <td><?=$ls->inq_content?></td>
                  <td width="100px"><?=$ls->user_name?></td>
                </tr>
                <?php foreach($inquire_reply as $iq_ls) : ?>

                  <?php if( $ls->inq_no == $iq_ls->inq_no ){ ?>
                  <tr>
                    <td width="200px"> ➥ <?=$iq_ls->inq_rp_title?> </td>
                    <td colspan="2"><?=$iq_ls->inq_rp_content?></td>
                  </tr>  
                  <?php } ?>

                <?php endforeach ?> 
                <br>
            <?php endforeach ?> 
            </table>


            <?php 
              if($this->session->userdata['ss_user_id'] != "costomer"){
            ?>

            <form method="post" action="/ci/index.php/Controller_EC/insert_inquire">

              <table class="table">
                <tr>
                  <td width="160px">お問い合わせタイトル</td>
                  <td><input type="text" class="form-control" name="inq_title"></td>
                </tr>
                <tr>
                  <td> お問い合わせ内容 </td>
                  <td><textarea class="form-control col-sm-5" rows="3" name="inq_content"></textarea></td>
                </tr>
                <tr>
                  <td colspan="2"><input type="submit" class="btn btn-info" name="getResult" value="お問い合わせ登録"></td>
                </tr>
              </table>

              <input type="hidden" name="pd_no" value="<?= $one_product[0]->pd_no ?>">
              <input type="hidden" name="user_no" 
                value="<?= $this->session->userdata['ss_user_no']?>">
            </form>

            <?php
              }
            ?>
 
              <!-- Modal window -->
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                      <h4 class="modal-title" id="myModalLabel">お問い合わせの返事</h4>
                    </div>

                    <form action="'/ci/index.php/Controller_EC/inquire_reply ?>'" method="post">
                    <div class="modal-body">
                            <table class="table">
                              <div id="getTag">
                              </div>
                              <tr>
                                <td width="140px">タイトル </td>
                                <td><input type="text" class="form-control" id="test1"  name="inq_rp_title" ></td>
                              </tr>
                              <tr>
                                <td> 内容 </td>
                                <td><textarea class="form-control col-sm-5" rows="3" name="inq_rp_content"></textarea></td>
                              </tr>
                            </table>
                            <input type="hidden" name="inq_no" value="">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      
                      <button type="submit" class="btn btn-primary">お問い合わせの返事登録</button>
                    </div>
                    </form>

                  </div>
                </div>
              </div>

            </div>
            <div class="col-md-1">
                          
            </div>

          </div>
    </div>    


        <script>
        $(function(){
            var getTag = $("#getTag").html();
                var getText = $('#rerid').val() ;

        });

          var click_sum = 0;

            $('#modal').click( function() {
                //$('#test1').html('2');
                //alert();
                
                //$temp = $("#test2").val();
                //alert($temp);
                //$('#test1').val() = $temp;

                //$('#test1').val() = $("#test2").val();


        var getText = $('#rerid').val() ;

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
