$(window).on("load",function(){
			$(".mainmenu-btn").click(function(){
				$("body").addClass("hidden-overflow");
				$(".wrapper").animate({left:"-300"},600);
				$("#fixer-menu").animate({left:"-300"},600);
				$("#slide_menu").animate({right:"0"},600);
				$(".blur-screen").css({"display":"block"});
			});
			$(".close-slide").click(function(){
				$(".hidden-overflow").removeClass("hidden-overflow");
				$("#slide_menu").animate({right:"-300"},600);
				$(".wrapper").animate({left:"0"},600);	
				$("#fixer-menu").animate({left:"0"},600);
				$(".blur-screen").css({"display":"none"});		
			});
			$(".blur-screen").click(function(){
				$(".hidden-overflow").removeClass("hidden-overflow");
				$("#slide_menu").animate({right:"-300"},600);
				$(".wrapper").animate({left:"0"},600);	
				$("#fixer-menu").animate({left:"0"},600);
				$(".blur-screen").css({"display":"none"});		
			});
			/*fadeIn fadeOut searchform*/
			var i=0;
			$(".btn-toggle-search").click(function(){
				if(i==0){
					$(this).next().css("display","table");
					$(this).next().children(".input-search").focus();
					i=1;
				}
				else{
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
			/*show link post*/
});
/*MENU FIXER*/
$(window).scroll(function(){
			if((post_addr==1|post_addr==2)&&($(window).width()>768)){
				if($(window).scrollTop()>200){
					$("#fixer-menu").css({"display":"block"});
				}
				else
				{
					$("#fixer-menu").css({"display":"none"});
				}
			}
			else{
				if($(window).scrollTop()>50)
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




	

