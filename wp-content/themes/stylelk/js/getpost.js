$(document).ready(function(){
	var isloadingData=0;
		$(window).on("scroll",function(){
				poisition=$(".loadmore").position();
				var numpost=2;
				var categoy_id;
				var tag_slug;
				if(post_addr==3) categoy_id=cat_id;
				if(post_addr==5) tag_slug=tag_slug_name;
				if(post_addr==1|post_addr==2){
					if($("#latest-content").hasClass("active")){
						post_addr=1;
						currentpost=$("#latest-content").children(".story-wrapper").length;
						}
					else{
						post_addr=2;
						currentpost=$("#popular-content").children(".story-wrapper").length;
					}
				}
				else{
						currentpost=$(".tab-content").children(".story-wrapper").length;
				}
/*-------------------------------------------------------*/
				if($(window).scrollTop()>(poisition.top-$(window).height())&&isloadingData==0) loadData();
				
				function loadData(){
					 	isloadingData=1;
						$(".loadmore").html('Loading...');
						$.ajax({
						url:ajaxurl, 
						data:{	action:'load_data_request',
							numpost:numpost,
							currentpost:currentpost,
							post_addr:post_addr,
							categoy_id:categoy_id,
							tag_slug:tag_slug
						},
				 		type:"POST", 
					 		success: function(result){
					 		if(post_addr==1) $("#latest-content").append(result);
		        			else if(post_addr==2) $("#popular-content").append(result);
		        			else  $(".tab-content").append(result);
		        			if(result=='') $(".loadmore").html('END');
		        		isloadingData=0;
	    				}
	    				});	
	    		}

		});
});