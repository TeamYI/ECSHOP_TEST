$(function () {
	$("#accordian h3").click(function () {
		$("#accordian ul ul").slideUp();
		if (!$(this).next().is(":visible")) {
			console.log($(this));
			$(this).next().slideDown();
		}
	})

	$("#accordian a").click(function () {
		var allA = $("#accordian a");

		allA.css("background", "none");
		allA.css("color", "#bbbbbb");
		allA.css("border-left", "none");

		$(this).css("background", "#003545");
		$(this).css("color", "white");
		$(this).css("border-left", "5px solid #09c");

	})

	var page = $("input[name='page']").val();
	var pageCategory = $("." + page);
	pageCategory.parent().parent().slideDown();
	// var pageCategoryATag = pageCategory;

	pageCategory.css("background", "#003545");
	pageCategory.css("color", "white");
	pageCategory.css("border-left", "5px solid #09c");


	$("#updateProductImg").change(function(e){

		var files = e.target.files ;
		var filesArr = Array.prototype.slice.call(files);

		filesArr.forEach(function(f){
			if(!f.type.match("image.*")){
				alert("imgファイルのみできます。");
				return ;
			}
			var reader = new FileReader();
			reader.onload = function(e){
				$("#showImg").attr("src","");
				$("#showImg").attr("src",e.target.result);
			}

			reader.readAsDataURL(f);
		})


		console.log(files);
	});
})


function orderStatusChange(od_no) {

	var paymentStatus = $("select[name='paymentCheck']").val();
	var deliveryStatus = $("select[name='deliveryStatus']").val();

	$.ajax({
		url: "/ECSHOP_TEST/index.php/orderStatusChange",
		type: "post",
		data: {
			od_no: od_no,
			paymentStatus: paymentStatus,
			deliveryStatus: deliveryStatus
		},
		success: function () {
			alert("修正しました。");

		},
		error: function (request, status, error) {
			console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);


		}
	})

}

function deleteProduct(){
	var pd_no = $("input[name='pd_no']:checked");
	var pdArray = [] ;

	pd_no.each(function(){
		// console.log();
		pdArray.push($(this).val());
	});

	if(pdArray.length == 0){
		alert("選択した商品がありません。");
		return false ;
	}

	$.ajax({
		url: "/ECSHOP_TEST/index.php/deleteProduct",
		type: "post",
		data: {
			pdArray: pdArray
		},
		success: function () {
			alert("削除しました。");
			location.href="/ECSHOP_TEST/index.php/manager/product";

		},
		error: function (request, status, error) {
			console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);


		}
	})
}

function deleteOrder(){
	var od_no = $("input[name='od_no']:checked");
	var odArray = [] ;

	od_no.each(function(){
		// console.log();
		odArray.push($(this).val());
	});

	if(odArray.length == 0){
		alert("選択した注文がありません。");
		return false ;
	}

	$.ajax({
		url: "/ECSHOP_TEST/index.php/deleteOrder",
		type: "post",
		data: {
			odArray: odArray
		},
		success: function () {
			alert("削除しました。");
			location.href="/ECSHOP_TEST/index.php/manager/order";

		},
		error: function (request, status, error) {
			console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);


		}
	})
}

function deleteCustomer(){
	var user_no = $("input[name='user_no']:checked");
	var userArray = [] ;

	user_no.each(function(){
		// console.log();
		userArray.push($(this).val());
	});

	if(userArray.length == 0){
		alert("選択した注文がありません。");
		return false ;
	}

	$.ajax({
		url: "/ECSHOP_TEST/index.php/deleteCustomer",
		type: "post",
		data: {
			userArray: userArray
		},
		success: function () {
			alert("削除しました。");
			location.href="/ECSHOP_TEST/index.php/manager/customer";

		},
		error: function (request, status, error) {
			console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);


		}
	})
}


function confirmText(){

	var pdPrice = $("input[name='pd_price']");
	var pdStock = $("input[name='pd_stock']");
	var pattern =  /^[0-9]+$/ ;
	var pdNumber = $("input[name='pd_number']");
	var pdName = $("input[name='pd_name']");


	if(pdNumber.val() === ""){
		pdNumber.focus();
		alert("入力してください。");
		return false ;
	}else if(confirmProductNumberOverlap(pdNumber.val())){
		alert("商品番号が重複です。");
		return false;
	}else if(pdName.val() === ""){
		pdName.focus();
		alert("入力してください。");
		return false ;
	}
	else if(!pattern.test(pdPrice.val()) || pdPrice.val()<0 ){
		pdPrice.focus();
		alert("0以上の半額数字のみ書いてください。");
		return false ;
	}else if(!pattern.test(pdStock.val()) || pdStock.val()<0){
		pdStock.focus();
		alert("0以上の半額数字のみ書いてください。");
		return false ;
	}

	return true;

}

function confirmProductNumberOverlap(pdNumber){
	var check = false ;

	$.ajax({
		url: "/ECSHOP_TEST/index.php/confirmProductNumberOverlap",
		type: "post",
		data: {
			pdNumber: pdNumber
		},
		async : false ,
		success: function (data) {
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


function confirmCategory(){
	var cg_name = $("input[name='cg_name']");
	var check = true ;

	if(cg_name.val() === ""){
		cg_name.focus();
		alert("カテゴリ名を書いてください。");
		return false;
	}else if(cg_name.val() !== ""){

		$.ajax({
			url: "/ECSHOP_TEST/index.php/confirmCategoryNameOverlap",
			type: "post",
			data: {
				cg_name: cg_name.val()
			},
			async : false ,
			success: function (data) {
				console.log(data);
				if(data !== "0"){
					cg_name.val("");
					cg_name.focus();
					check = false;
					alert("すでに登録されたカテゴリ名です。");
				}

			},
			error: function (request, status, error) {
				console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);

			}
		});

		return check ;
	}
}
