<input type="hidden" name="page" value="product">
<div class="col-md-9">
	<div class="title">
		<h3>商品台帳を見る</h3>
		<button class="deleteButton" onclick="deleteProduct()">選択した商品削除</button>
	</div>
	<table>
		<colgroup>
			<col class="col-md-1">
			<col class="col-md-1">
			<col class="col-md-3">
			<col class="col-md-3">
			<col class="col-md-1">
			<col class="col-md-2">
		</colgroup>
		<thead>
		<tr>
			<th>選択</th>
			<th>商品番号</th>
			<th>商品写真</th>
			<th>商品名</th>
			<th>在庫</th>
			<th>値段(円)</th>
		</tr>
		</thead>
		<tbody>
		<?php if($productList === null){ ?>
			<tr>
				<td colspan="8">
					<h4>注文履歴がありません。</h4>
				</td>
			</tr>
		<?php }else{ ?>
			<?php foreach($productList as $list){ ?>
			<tr>
				<td>
					<input type="checkbox" name="pd_no" value="<?php echo $list->pd_no ?>">
				</td>
				<td><?php echo $list->pd_no ?></a></td>
				<td><img src="/ECSHOP_TEST<?php echo $list->pd_img ?>" alt="" style="min-height:80px; height:50px;"></td>
				<td><?php echo $list->pd_name ?></td>
				<td><?php echo $list->pd_stock ?></td>
				<td><?php echo $list->pd_price ?></td>
			</tr>
			<?php } ?>
		<?php } ?>
		</tbody>
	</table>
</div>




