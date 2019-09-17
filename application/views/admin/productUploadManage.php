<input type="hidden" name="page" value="productUpload">
<div class="col-md-9">
	<h4>カテゴリ登録</h4>
	<form id="order_name" action="/ECSHOP_TEST/index.php/uploadCategory" method="post">
		<div class="input-group double-input">
              <span class="input-group-btn">
                <div class="dropdown">
                  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1"
						  data-toggle="dropdown" aria-expanded="true">
                    カテゴリ一覧
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                  <?php foreach ($category as $ls) : ?>
					  <li role="presentation"><a href="#"><?= $ls->cg_name ?></a></li>
				  <?php endforeach ?>

                  </ul>
                </div>
              </span>
			<input type="text" name="cg_name" placeholder="カテゴリ名" class="form-control"/>
			<span class="input-group-btn">
                  <button class="btn btn-success" type="submit">登録</button>
              </span>
		</div><!-- /input-group -->
	</form>
	<hr>


	<h4>商品登録</h4>


	<form id="order_name" action="/ECSHOP_TEST/index.php/uploadProduct" method="post" enctype="multipart/form-data">

		<!--		<div>-->
		<!--			<input type="hidden" class="form-control" name="pd_img"-->
		<!--				   value="--><?php //if (isset($img['img_path'])) echo $img['img_path']; ?><!--">-->
		<!--		</div>-->

		<!-- 상품등록 - 카테고리 일람 -->
		<div class="input-group double-input">
              <span class="input-group-btn">
                <div class="dropdown">
                  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1"
						  data-toggle="dropdown" aria-expanded="true">
                    カテゴリ一覧
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                  <?php foreach ($category as $ls) : ?>
					  <div class="radio">
                      <label>
                        <input type="radio" name="cg_no" id="radio" value="<?= $ls->cg_no ?>" checked>
                        <?= $ls->cg_name ?>
                      </label>
                    </div>
				  <?php endforeach ?>

                  </ul>
                </div>
              </span>

		</div>
		<br>

		<div>
			<label for="">商品番号</label>
			<input type="text" class="form-control" name="pd_number" placeholder="商品番号">
		</div>
		<br>
		<div>
			<label for="">商品名</label>
			<input type="text" class="form-control" name="pd_name" placeholder="商品名">
		</div>
		<br>
		<div>
			<label for="">値段</label>
			<input type="text" class="form-control" name="pd_price" placeholder="値段">
		</div>
		<br>
		<div>
			<label for="">在庫</label>
			<input type="text" class="form-control" name="pd_stock" placeholder="在庫">
		</div>
		<br>
		<div>
			<label for="">商品写真</label>
			<input class="btn btn-default" type="file" name="userfile"/>
		</div>
		<br>
		<div>
			<label for="">商品説明</label>
			<textarea class="form-control" name="pd_comment" placeholder="商品説明"></textarea>
		</div>
		<br>
		<div>
			<label for="">商品メモ（管理者用）</label>
			<textarea class="form-control" name="pd_memo" placeholder="商品メモ（管理者用）"></textarea>
		</div>

		<br>
		<div>
			<button type="submit" class="form-control btn btn-success">登録</button>
		</div>
	</form>
</div>
</div>


