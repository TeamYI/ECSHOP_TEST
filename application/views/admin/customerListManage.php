<input type="hidden" name="page" value="customer">
<div class="col-md-9">
	<div class="title">
		<h3>顧客台帳を見る</h3>
		<button class="deleteButton" onclick="deleteCustomer()">選択した商品削除</button>
	</div>
	<table>
		<colgroup>
			<col class="col-md-1">
			<col class="col-md-2">
			<col class="col-md-2">
			<col class="col-md-1">
			<col class="col-md-2">
			<col class="col-md-2">
			<col class="col-md-2">
		</colgroup>
		<thead>
		<tr>
			<th>選択</th>
			<th>ID</th>
			<th>名前</th>
			<th>性別</th>
			<th>Email</th>
			<th>携帯電話</th>
			<th>住所</th>
		</tr>
		</thead>
		<tbody>
		<?php if($customer === null){ ?>
			<tr>
				<td colspan="8">
					<h4>注文履歴がありません。</h4>
				</td>
			</tr>
		<?php }else{ ?>
			<?php foreach($customer as $list){ ?>
			<tr>
				<td>
					<input type="checkbox" name="user_no" value="<?php echo $list->user_no ?>">
				</td>
				<td><?php echo $list->user_id ?></a></td>
				<td><?php echo $list->user_name ?></td>
				<td><?php echo $list->user_sex ?></td>
				<td><?php echo $list->user_email ?></td>
				<td><?php echo $list->user_phoneNumber ?></td>
				<td><?php echo $list->user_address ?></td>
			</tr>
			<?php } ?>
		<?php } ?>
		</tbody>
	</table>
</div>




