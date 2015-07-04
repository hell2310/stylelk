<!-- DISPLAY POST IN HOME PAGE AND CATEGORIES, TAG, SEARCH PAGE -->
<div class="row story-wrapper">
	<div class="col-md-6 story-image" >
	<?php if(has_post_video(get_the_ID())): ?>
			<?php the_post_thumbnail() ?>
	<?php else:?>
		<?php 
			global $dynamic_featured_image;
			$feature_image=$dynamic_featured_image->get_featured_images() ;
			if(!$feature_image==null): ?>		
				<div class="slide-feature-image slide-feature-image-<?php echo get_the_ID();?>">	
				<?php the_post_thumbnail() ?>
				<?php 
				foreach ($feature_image as $feature_image) {?>
					<img src="<?php echo $feature_image['full'];?>">
				<?php
				}?>
				</div>	
					<!-- 			loadscript for slide -->
			<script type="text/javascript">
				var slideImageWidth=$(".slide-feature-image-<?php echo get_the_ID();?>").width(); 	    
			    var eindex = 0;
			    var play='';
			    var timeinterval='';
				$(".slide-feature-image-<?php echo get_the_ID();?>").height(slideImageWidth/1.4);
				var count = $('.slide-feature-image-<?php echo get_the_ID();?> img').length;
				$('.slide-feature-image-<?php echo get_the_ID();?>').append('<ul class="slide-control"><li class="fa fa-chevron-right control-right"></li><li class="fa fa-chevron-left control-left"></li></ul>')
				$('.slide-feature-image-<?php echo get_the_ID();?>').append('<div class="count-slide"></div>')
				$(".slide-feature-image-<?php echo get_the_ID();?> img:first-child").addClass("image-focus");
			    $(".count-slide").html("<p>"+(eindex+1)+"/"+count+"</p>");
			    function setimagefocus() {
			        $(".slide-feature-image-<?php echo get_the_ID();?> img").stop().fadeOut(500).animate({
			            opacity: 0
			        });
			        $(".slide-feature-image-<?php echo get_the_ID();?> img:eq(" + eindex + ")").stop().fadeIn(500).animate({
			            opacity: 1
			        });
			        $(".count-slide").html("<p>"+(eindex+1)+"/"+count+"</p>");
			    }
			    function slideswap() {
			        eindex++;
			        if (eindex == count) {
			            eindex = 0;
			        }
			        setimagefocus();
			    }
			    function start_slideswap() {
			        timeinterval = 4000;
			        play = setInterval(slideswap, timeinterval);
			    }
			    $(".slide-feature-image-<?php echo get_the_ID();?>").hover(function () {
			        clearInterval(play);
			    }, function () {
			        start_slideswap();
			    });
			    $(".control-left").click(function () {
			        eindex--;
			        if (eindex == -1) eindex = count - 1;
			        setimagefocus();
			    });
			    $(".control-right").click(function () {
			        eindex++;
			        if (eindex == count) eindex = 0;
			        setimagefocus();
			    });
			</script>		
			<?php 
			else:?>
			<!-- display video or feature image when not have slide image -->
				<a href="<?php the_permalink() ?>"><?php the_post_thumbnail() ?></a>	
			<?php
			endif;?>
	<?php endif;?>
	</div>
	<div class="col-md-6 story-content">
	    <ul class="nav nav-align-right nav-padding-none story-time"><li><?php the_category() ?></li><li class="divider">/</li><li><a href="<?php echo get_permalink(get_the_ID());?>"><?php echo human_time_diff(get_the_time('U'),current_time('timestamp')).' ago'; ?></a><li></ul>
	    <h2><a href="<?php echo get_permalink(get_the_ID());?>"><?php the_title()?></a></h2>
	    <ul class="nav nav-align-right nav-padding-none interative"><li><a href="<?php echo get_permalink(get_the_ID()); ?>"><?php echo getTwitterShareCount(get_permalink(get_the_ID()))+getFacebookShareCount(get_permalink(get_the_ID()));?> Shares</a></li><li class="divider">/</li><li><a href="<?php echo get_permalink(get_the_ID());?>"><?php echo getPostViews(get_the_ID()); ?></a></li><li class="divider">/</li><li><a href="<?php echo get_permalink(get_the_ID());?>"><?php echo  get_comments_number();?> Comments</a></li></ul>
	    <ul class="nav nav-align-right interative-social">
	        <li><a href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink(get_the_ID());?>" target="_blank"><span class="fa fa-facebook"></span> Share</a></li>
	        <li><a href="http://twitter.com/share?url=<?php echo get_permalink(get_the_ID());?>" target="_blank"><span class="fa fa-twitter"></span> Tweet</a></li>
	    </ul> 
	</div>
</div>