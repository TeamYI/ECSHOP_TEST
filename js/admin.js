$(function(){
	$("#accordian h3").click(function(){
		$("#accordian ul ul").slideUp();
		if(!$(this).next().is(":visible"))
		{
			$(this).next().slideDown();
		}
	})

	$("#accordian a").click(function(){
		var allA = $("#accordian a");

		allA.css("background","none");
		allA.css("color","#bbbbbb");
		allA.css("border-left","none");

		$(this).css("background","#003545");
		$(this).css("color","white");
		$(this).css("border-left","5px solid #09c");

	})
})
