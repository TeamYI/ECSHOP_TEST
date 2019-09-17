<input type="hidden" name="page" value="order">
<div class="col-md-9">
	<div class="title">
		<h3>受注台帳を見る</h3>
		<button class="deleteButton" onclick="deleteOrder()">選択した商品削除</button>
	</div>
	<table>
		<colgroup>
			<col class="col-md-1">
			<col class="col-md-2">
			<col class="col-md-2">
			<col class="col-md-2">
			<col class="col-md-1">
			<col class="col-md-2">
			<col class="col-md-1">
			<col class="col-md-1">
		</colgroup>
		<thead>
		<tr>
			<th>選択</th>
			<th>注文日時</th>
			<th>注文番号</th>
			<th>注文者</th>
			<th>合計金額</th>
			<th>決済方法</th>
			<th>入金状態</th>
			<th>発送</th>
		</tr>
		</thead>
		<tbody>
		<?php if($orderList === null){ ?>
			<tr>
				<td colspan="8">
					<h4>注文履歴がありません。</h4>
				</td>
			</tr>
		<?php }else{ ?>
			<?php foreach($orderList as $list){ ?>
			<tr>
				<td>
					<input type="checkbox" name="od_no" value="<?php echo $list->od_no ?>">
				</td>
				<td><?php echo $list->od_date ?></td>
				<td><a href="/ECSHOP_TEST/index.php/order/<?php echo $list->od_no ?>"><?php echo $list->od_no ?></a></td>
				<td><?php echo $list->od_name ?></td>
				<td><?php echo $list->od_price ?></td>
				<td><?php echo $list->payment_name ?></td>
				<td><?php echo $list->payment_check ?></td>
				<td><?php echo $list->delivery_status ?></td>
			</tr>
			<?php } ?>
		<?php } ?>
		</tbody>
	</table>
</div>




