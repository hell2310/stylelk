$(window).on("load",function(){
			var menuwidth=$("#slide_menu").width();
			$("#slide_menu").css({"right":-menuwidth});
			$(".mainmenu-btn").click(function(){
				$("body").css("overflow","hidden");
				$(".wrapper").css({"transform":"translateX("+-menuwidth+"px)","-webkit-transform":"translateX("+-menuwidth+"px)","-webkit-transition":"transform 0.5s","transition":"transform 0.5s"});
				$("#fixer-menu").css({"transform":"translateX("+-menuwidth+"px)","-webkit-transform":"translateX("+-menuwidth+"px)","-webkit-transition":"transform 0.5s","transition":"transform 0.5s"});
				$(".blur-screen").css({"display":"block"});
				$("#slide_menu").css({"display":"block"}).animate({right:"0"},450);
			});
			$(".close-slide").click(function(){
				$("body").css("overflow","visible");
				$(".wrapper").css({"opacity":1,transform:"translateX(0)","-webkit-transform":"translateX(0)"});
				$("#fixer-menu").css({"opacity":1,transform:"translateX(0)","-webkit-transform":"translateX(0)"});
				$(".blur-screen").css({"display":"none"});
				$("#slide_menu").animate({right:-(menuwidth+20)},500);

			})
			$(".blur-screen").click(function(){
				$("body").css("overflow","visible");
				$(".wrapper").css({"opacity":1,transform:"translateX(0)","-webkit-transform":"translateX(0)"});
				$("#fixer-menu").css({"opacity":1,transform:"translateX(0)","-webkit-transform":"translateX(0)"});
				$(".blur-screen").css({"display":"none"});
				$("#slide_menu").animate({right:-(menuwidth+20)},500);
			})

			/*fadeIn fadeOut searchform*/
			var i=0;
			$(".btn-toggle-search").click(function(){
				if(i==0){
					$(this).next().css("display","table");
					$(this).next().children(".input-search").focus();
					i=1;
				}
				else if(i==1){
					$(this).next().css("display","none");
					i=0;
				}
			})

			/*add icon to dropdown menu*/
			$(".menu-item-has-children>a").append(" <span class='fa fa-angle-down'></span>");
		/*	sidedown submenu*/
			$(".menu-item-has-children").on("click",function(){
				$(this).children("ul").slideToggle();
			})
});
/*MENU FIXER*/
$(window).scroll(function(){
			if($(window).width()<=768){
				if($(window).scrollTop()>50){
					$("#fixer-menu").css({"display":"block"});
				}
				else
				{
					$("#fixer-menu").css({"display":"none"});
				}
			}
			else{
				if($(window).scrollTop()>200)
				{	
					$("#fixer-menu").css({"display":"block"});
				}
				else
				{
					$("#fixer-menu").css({"display":"none"});
				}
				
			}
			if($(window).scrollTop()>200){
				$(".scroll-up").fadeIn(500);
			}
			else{
				$(".scroll-up").fadeOut(500);
			}
});




	

