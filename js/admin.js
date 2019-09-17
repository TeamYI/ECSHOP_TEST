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
})


function orderStatusChange(od_no) {
	alert("od : " + od_no);

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
