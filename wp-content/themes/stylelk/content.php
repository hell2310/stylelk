<!-- DISPLAY POST WRAPPER IN POST PAGE -->
<div class="row story-wrapper postpage-story-wrapper post-page-story-<?php echo get_the_ID();?>">
		<div class="story-image" > 
			<!--  display slide image use with plugin dynamic feature image-->
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
		<h1 class="story-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h1>
			<ul class="nav nav-align-right nav-interative-social">
				<li class="hidden-xs social-share-count"><span><?php echo getRedditShareCount(get_permalink())+getPinterestShareCount(get_permalink())+getTwitterShareCount(get_permalink())+getFacebookShareCount(get_permalink());?></span> <b>Shares</b></li>
				<li class="social-fb"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink()?>" target='_blank'><span class="fa fa-facebook"></span><span class="hidden-xs"> like</span></a></li>
				<li class="social-twitter"><a href="https://twitter.com/intent/tweet?url=<?php the_permalink()?>" target='_blank'><span class="fa fa-twitter"></span><span class="hidden-xs"> tweet</span></a></li>
				<li class="social-reddit"><a href="http://www.reddit.com/submit?url=<?php the_permalink()?>" target='_blank'><span class="fa fa-reddit"></span><span class="hidden-xs"> submit</span></a></li>
				<li class="social-pinterest"><a href="http://www.pinterest.com/pin/create/button/?url=<?php the_permalink()?> " target='_blank'><span class="fa fa-pinterest"></span><span class="hidden-xs"> pin it</span></a></li>
				<li class="hidden-md hidden-lg social-whatsapp"><a href="whatsapp://send?text=<?php the_permalink()?> " data-action="share/whatsapp/share" target='_blank'><span class="fa fa-whatsapp"></span></a></li>
				<li class="hidden-md hidden-lg social-telegram"><a href="#" data-action="share/whatsapp/share" target='_blank'><span class="fa fa-paper-plane"></span></a></li>
				<li class="social-email"><a href="mailto:?subject=MailfromStylelk&body=<?php the_permalink()?>" target='_blank'><span class="fa fa-envelope-o"></span><span class="hidden-xs"> email</span></a></li>
				<li class="social-link hidden-xs"><a class="social-link-button" onclick="toggleLinkContent(<?php echo get_the_ID();?>)"><span class="fa fa-link"></span><span class="hidden-xs"> link</span></a><div class="link-container link-container-<?php echo get_the_ID();?>"><label>Share this link</label><input type="text" value="<?php the_permalink()?>"></div></li>		
			</ul>
			<div class="story-content">
				<?php the_content() ?>
			</div>
			<ul class="nav nav-align-right story-infor"><li><strong>Date: </strong><p><?php the_date() ?></p></li><li class="divider">/</li><li><strong>Author: </strong><p><a href="<?php the_author_link() ?>"><?php the_author() ?></a></p></li></ul>
			<ul class="nav nav-align-right story-infor"><li><strong>Category: </strong><p><?php the_category() ?></p></li><li class="divider">/</li><li><strong>tag: </strong><p><?php the_tags('','','')?></p></li><li class="divider">/</li><li><strong>views: </strong><p><?php echo getPostViews(get_the_ID()); ?></p></li></ul>
			<p class="story-comment" onclick="toggleCommentContent(<?php echo get_the_ID(); ?>)" ><a><?php echo get_comments_number();?> <?php _e('comments')?></a></p>
			<?php if ( comments_open()) : 
				get_template_part('comments'); 			
			endif; ?>
		<script type="text/javascript">
			function toggleLinkContent(postID){
				$(".link-container-"+postID).slideToggle();
				$(".link-container-"+postID+" input").focus();
			}
			function toggleCommentContent(postID){
				$(".comment-content-"+postID).slideToggle();
			}
		</script>
			<?php 
				global $wpdb;
				global $post;
				$cat_ID=array();
				$categories = get_the_category(); 
  				foreach($categories as $category) {
    				array_push($cat_ID,$category->cat_ID);
  				}
  				$args=array('category__in'=>$cat_ID,'posts_per_page'=>4);
				$the_query = new WP_Query($args);
				if($the_query->have_posts()):?>
					<div class="visible-md visible-lg yma-like">
						<h4>you may also like</h4>
					<?php while ($the_query->have_posts()):$the_query->the_post(); setup_postdata( $post)?>
						<div class="row yma-like-post">
							<div class="col-md-2 yma-like-image"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail() ?></a></div>
							<div class="col-md-10 yma-like-content">
								<p class="yma-like-title"><a href="<?php the_permalink()?>"><?php the_title() ?></a></p>
								<ul class="nav nav-align-right nav-padding-none yma-like-infor"><li><?php the_category() ?></li><li class="divider">/</li><li><?php echo get_the_date(); ?></li><li class="divider">/</li><li><?php echo getPostViews(get_the_ID());?></li><li class="divider">/</li><li><?php echo  get_comments_number();?> comments</li></ul>
							</div>
						</div>
					<?php endwhile;?>
					<?php wp_reset_postdata(); ?>
					</div>
				<?php endif;?>
</div>



