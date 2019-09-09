function logout(){
	alert("ログアウトしました。");
	location.href = "/ECSHOP_TEST/index.php/Controller_EC/logout" ;
}

function confirmStock(stock,pd_no){

	var qty = $("input[name='qty']").val();
	console.log(qty);
	if(stock<=0){
		var text = "この商品は在庫がありませんので、購入ができません。\n"
					+"管理者にお問い合せをお願いします。" ;

		alert(text);

		return false;
	}

	//cart stock confirm
	qty = confirmCartStock(qty,stock,pd_no);
	console.log(qty);

	if(stock < qty){
		var text = "在庫より購入数が多いです。";

		alert(text);

		return false;
	}

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

	return allQty ;


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
	var checkStock = confirmStock(stock,pd_no);
	var checkNumber = confirmNum();

	if(checkStock == true && checkNumber == true){
		var qty = $("input[name='qty']").val();
		location.href = "/ECSHOP_TEST/index.php/Controller_EC/buy_page?pd_no="+pd_no+"&qty="+qty;
	}else{
		return false ;
	}
}

function moveCartPage(stock,pd_no) {

	var checkStock = confirmStock(stock,pd_no);
	var checkNumber = confirmNum();

	if(checkStock == true && checkNumber == true){
		var qty = $("input[name='qty']").val();
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
		var stock = $(this).next().val();

		if(stock < $(this).val()){
			qty_position = $(this) ;
			check = true ;
		}
		qtyArray.push($(this).val());

	});

	rowid.each(function(){
		rowidArray.push($(this).val());
	});


	if(check == true){
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
			location.href="/ECSHOP_TEST/index.php/Controller_EC/cartAll";
		},
		error : function(request,status,error){
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}


function orderPageMove(orderProductCount){
	if(orderProductCount>0){
		location.href = "/ECSHOP_TEST/index.php/Controller_EC/order_page";
	}else{
		alert("注文商品がありません。");
	}

}

function confirmOrderValue(){
	var order_info = $(".order_info");
	var valueCheck = true ;

	order_info.each(function(){
		console.log($(this).val() );
		if($(this).val() === ""){
			valueCheck = false ;
		}
	})

	if(valueCheck === false){
		alert("必須項目を入力してください。");
	}

	return valueCheck ;

}




/*--------------join----------------- */

function registerUserInfoCheck(){

	var user_pw = $("input[name='user_pw']");
	var user_name = $("input[name='user_name']");
	var user_email = $("input[name='user_email']");
	var user_phoneNumber = $("input[name='user_phoneNumber']");
	var user_address = $("input[name='user_address']");
	var boolean = true ;


	return false;
}

/*--------------mypage -------------*/

function updateUserInfo(){

	var user_pw = $("input[name='user_pw']");
	var user_name = $("input[name='user_name']");
	var user_email = $("input[name='user_email']");
	var user_phoneNumber = $("input[name='user_phoneNumber']");
	var user_address = $("input[name='user_address']");
	var boolean = true ;

	if(user_pw.val() == ""){
		user_pw.focus();
		alert("必須項目を入力してください。");
		return false ;
	}else if(user_name.val() == ""){
		user_name.focus();
		alert("必須項目を入力してください。");
		return false ;
	}else if(user_email.val() == ""){
		user_email.focus();
		alert("必須項目を入力してください。");
		return false ;
	}else if(user_phoneNumber.val() == ""){
		user_phoneNumber.focus();
		alert("必須項目を入力してください。");
		return false ;
	}else if(user_address.val() == ""){
		user_address.focus();
		alert("必須項目を入力してください。");
		return false ;
	}

	if(user_email.val() != "" ){
		boolean = verifyEmail(user_email.val());
		console.log(boolean);
		if(boolean == false){
			alert('メール形式を確認してください');
			return false;
		}
	}

	if(user_phoneNumber.val() != "" ){
		boolean = verifyHP(user_phoneNumber.val());
		console.log(boolean);
		if(boolean == false){
			alert('連絡先を確認してください');
			return false;
		}
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
	var pattern = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/ ;

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
