function logout(){
	alert("ログアウトしました。");
	location.href = "/ECSHOP_TEST/index.php/Controller_EC/logout" ;
}

function confirmStock(stock,pd_no){




	return true ;
}

function confirmCartStock(qty,stock,pd_no){

	var allQty ;

	$.ajax({
		url : "/ECSHOP_TEST/index.php/confirmCartStock",
		type : "post",
		data : {
			// ci_t : csrf_token,
			pd_no : pd_no
		},
		dataType : "json",
		async : false,
		success: function(data){
			console.log("ddd");
			console.log(data);
			allQty = data+(parseInt(qty)) ;
		},
		error : function(request,status,error){
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});

	return parseInt(allQty) ;


}

function confirmNum(){
	var qty = $("input[name='qty']");
	var pattern =  /^[0-9]+$/ ;

	if(pattern.test(qty.val()) && (qty.val()>0)){
		return true ;
	}else{
		alert("半角数字のみを入力してください。");
		qty.val("");
		return false ;
	}

}

function moveOrderPage(stock, pd_no){
	var checkNumber = confirmNum();

	var qty = $("input[name='qty']").val();


	if(parseInt(stock)<=0){
		var text = "この商品は在庫がありませんので、購入ができません。\n"
			+"管理者にお問い合せをお願いします。" ;

		alert(text);

		return false;
	}else if(parseInt(stock) < qty){
		var text = "在庫より購入数が多いです。\n";
		alert(text);

		return false;
	}

	if(checkNumber === true){
		location.href = "/ECSHOP_TEST/index.php/Controller_EC/buy_page?pd_no="+pd_no+"&qty="+qty;
	}else{
		return false ;
	}
}

function moveCartPage(stock,pd_no) {

	var checkNumber = confirmNum();
	var qty = $("input[name='qty']").val();

	if(parseInt(stock)<=0){
		var text = "この商品は在庫がありませんので、購入ができません。\n"
			+"管理者にお問い合せをお願いします。" ;

		alert(text);

		return false;
	}

	//cart stock confirm
	totalQty = confirmCartStock(qty,stock,pd_no);

	if(parseInt(stock) < totalQty){
		var text = "カートに在庫より購入数が多いです。\n";
		alert(text);

		return false;
	}

	if( checkNumber === true){
		location.href = "/ECSHOP_TEST/index.php/Controller_EC/cart_page?pd_no="+pd_no+"&qty="+qty;
	}else{
		return false ;
	}
}

function updateCart(){
	var qty = $("input[name='qty']") ;
	var rowid = $("input[name='rowid']") ;
	var qtyArray = [];
	var rowidArray = [];
	var qty_position ;
	var check = false ;

	qty.each(function(){
		var stock = parseInt($(this).next().val());
		var changeQty = parseInt($(this).val());

		if(stock < changeQty){
			qty_position = $(this) ;
			check = true ;
		}
		qtyArray.push($(this).val());

	});

	rowid.each(function(){
		rowidArray.push($(this).val());
	});


	if(check === true){
		var text = "在庫より購入数が多いです。";
		alert(text);
		qty_position.focus();
		return false ;
	}


	$.ajax({
		url : "update",
		type : "post",
		data : {
			// ci_t : csrf_token,
			rowid : rowidArray,
			qty : qtyArray,

		},
		success: function(data){
			alert("修正しました。");
			location.href = "/ECSHOP_TEST/index.php/Controller_EC/cartAll";

		},
		error : function(request,status,error){
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);


		}
	})
}


function deleteCart(){

	$.ajax({
		url : "destroy",
		type : "post",
		data : {
		},
		success: function(data){
			alert("削除しました。");
		},
		error : function(request,status,error){
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}


function orderPageMove(orderProductCount){
	var stock = $("input[name='stock']") ;
	var qty = $("input[name='qty']") ;
	var pd_name = $("input[name='name']") ;
	var stockArray = [] ;
	var qtyArray = [] ;
	var pdNameArray = [] ;
	var bool = true ;
	stock.each(function(){
		stockArray.push($(this));
	});

	qty.each(function(){
		qtyArray.push($(this));
	});

	pd_name.each(function(){
		pdNameArray.push($(this));
	});


	for(var i=0; i<stockArray.length ; i++){
		console.log(stockArray[i].val());
		console.log(qtyArray[i].val());

		if(stockArray[i].val() < qtyArray[i].val() ){
			bool = false ;
			stockArray[i].prev().focus();
			alert("「"+pdNameArray[i].val()+"」"+"在庫確認お願いします。");
		}
	}


	if(orderProductCount>0 && bool === true ){
		location.href = "/ECSHOP_TEST/index.php/Controller_EC/order_page";
	}
	if(orderProductCount === 0){
		alert("注文商品がありません。");
	}

}

function orderStockCheck(){
	$.ajax({
		url : "/ECSHOP_TEST/index.php/orderStockCheck",
		type : "post",
		data : {
			// ci_t : csrf_token,
			pd_no : pd_no
		},
		dataType : "json",
		async : false,
		success: function(data){
			console.log("ddd");
			console.log(data);
			allQty = data+(parseInt(qty)) ;
		},
		error : function(request,status,error){
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
}

function confirmOrderValue(){
	var order_info = $(".order_info");
	var order_email = $("input[name='order_email']");
	var order_hp = $("input[name='order_hp']");
	var receiver_hp = $("input[name='receiver_hp']");
	var valueCheck = true ;

	order_info.each(function(){
		console.log($(this).val() );
		if($(this).val() === ""){
			$(this).focus();
			valueCheck = false ;
			alert("必須項目を入力してください。");
			return false;

		}else if(order_email.val() === $(this).val() ){
			valueCheck = verifyEmail(order_email.val());
			console.log(valueCheck);
			if(valueCheck === false){
				alert('メール形式を確認してください');
				order_email.focus();
				return false;
			}
		}else if(order_hp.val() === $(this).val() ){

			valueCheck = verifyHP(order_hp.val());
			console.log(valueCheck);
			if(valueCheck === false){
				alert('連絡先を確認してください');
				order_hp.focus();
				return false;
			}
		}else if(receiver_hp.val() === $(this).val() ){

			valueCheck = verifyHP(receiver_hp.val());
			console.log(valueCheck);
			if(valueCheck === false){
				alert('連絡先を確認してください');
				receiver_hp.focus();
				return false;
			}
		}
	})


	// if(valueCheck === false){
	// 	alert("必須項目を入力してください。");
	// }
	//
	// return valueCheck ;

	return valueCheck;

}

function getOrdererInfo(checkbox){
	console.log(checkbox.value);

	var value = checkbox.value;
	var order_name = $("input[name='order_name']");
	var order_hp = $("input[name='order_hp']");
	var order_address = $("input[name='order_address']");

	var receiver_name = $("input[name='receiver_name']");
	var receiver_hp = $("input[name='receiver_hp']");
	var receiver_address = $("input[name='receiver_address']");

	if(value == 0){
		checkbox.value = 1 ;
		receiver_name.val(order_name.val());
		receiver_hp.val(order_hp.val());
		receiver_address.val(order_address.val());
	}else{
		checkbox.value = 0 ;
		receiver_name.val("");
		receiver_hp.val("");
		receiver_address.val("");
	}
}



/*--------------join----------------- */

function checkUserInfo(){

	var user_id = $("input[name='user_id']");
	var user_pw = $("input[name='user_pw']");
	var user_name = $("input[name='user_name']");
	var user_email = $("input[name='user_email']");
	var user_phoneNumber = $("input[name='user_phoneNumber']");
	var user_address = $("input[name='user_address']");
	var boolean = true ;

	console.log(user_phoneNumber.val());
	if(user_id.val() === ""){
		user_id.focus();
		alert("必須項目を入力してください。");
		return false ;
	}else if(confirmUserIdOverlap(user_id.val())){
		user_id.focus();
		alert("すでに登録したIDです。");
		return false ;
	}else if(user_pw.val() === ""){
		user_pw.focus();
		alert("必須項目を入力してください。");
		return false ;
	}else if(user_name.val() === ""){
		user_name.focus();
		alert("必須項目を入力してください。");
		return false ;
	}else if(user_email.val() === ""){
		user_email.focus();
		alert("必須項目を入力してください。");
		return false ;
	}else if(user_email.val() !== "" ){
		boolean = verifyEmail(user_email.val());
		console.log(boolean);
		if(boolean === false){
			alert('メール形式を確認してください');
			return false;
		}
	}else if(user_phoneNumber.val() === ""){
		user_phoneNumber.focus();
		alert("必須項目を入力してください。");
		return false ;
	}else if(user_address.val() === ""){
		user_address.focus();
		alert("必須項目を入力してください。");
		return false ;
	}


	if(user_phoneNumber.val() !== "" ){
		boolean = verifyHP(user_phoneNumber.val());
		console.log(boolean);
		if(boolean === false){
			alert('連絡先を確認してください');
			return false;
		}
	}
	return true;
}

function confirmUserIdOverlap(user_id){
	var check = false ;

	$.ajax({
		url: "/ECSHOP_TEST/index.php/confirmUserIdOverlap",
		type: "post",
		data: {
			user_id: user_id
		},
		async : false ,
		success: function (data) {
			data = data.replace(/\s*/g,'');
			console.log(data);
			if(data !== "0"){
				check = true;
			}

		},
		error: function (request, status, error) {
			console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);


		}
	});

	return check;
}

/*--------------mypage -------------*/

function updateUserInfo(){

	var user_pw = $("input[name='user_pw']");
	var user_name = $("input[name='user_name']");
	var user_email = $("input[name='user_email']");
	var user_phoneNumber = $("input[name='user_phoneNumber']");
	var user_address = $("input[name='user_address']");

	if(checkUserInfo() === false  ){
		return false ;
	}

	$.ajax({
		url : "/ECSHOP_TEST/index.php/updateUserInfo",
		type : "post",
		data : {
			"user_pw" : user_pw.val(),
			"user_name" : user_name.val(),
			"user_email" : user_email.val(),
			"user_phoneNumber" : user_phoneNumber.val(),
			"user_address" : user_address.val()
		},
		success: function(data){
			alert("修正しました。");
		},
		error : function(request,status,error){
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})

}


/*---------------------正規表現式check-------------------- */

function verifyEmail(user_email){
	var email = user_email;
	var pattern = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])+.[a-zA-Z]{2,3}$/ ;

	if(pattern.test(email)){
		return true ;
	}

	return false;
}

function verifyHP(user_phoneNumber){
	var hp = user_phoneNumber;
	var pattern = /^[0-9]{11}$/ ;

	if(pattern.test(hp)){
		return true ;
	}

	return false;
}

/*--------------------------------------------------------- */
