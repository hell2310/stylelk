<!-- DISPLAY POST WRAPPER IN POST PAGE -->
<div class="row story-wrapper postpage-story-wrapper post-page-story-<?php get_the_ID();?>">
		<?php if(!get_post_format()=='gallery'&&!get_post_format()=='image'): ?>
		<div class="story-image" > 
			<a href="<?php the_permalink() ?>"><?php the_post_thumbnail() ?></a>
		</div>
		<?php endif;?>
		<h1 class="story-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h1>
			<ul class="nav nav-align-right nav-interative-social">
				<li class="hidden-xs social-share-count"><span><?php echo getRedditShareCount(get_permalink())+getPinterestShareCount(get_permalink())+getTwitterShareCount(get_permalink())+getFacebookShareCount(get_permalink());?></span> <b>Shares</b></li>
				<li class="social-fb"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink()?>" target='_blank'><span class="fa fa-facebook"></span><span class="hidden-xs"> like</span></a></li>
				<li class="social-twitter"><a href="https://twitter.com/intent/tweet?url=<?php the_permalink()?>" target='_blank'><span class="fa fa-twitter"></span><span class="hidden-xs"> tweet</span></a></li>
				<li class="social-reddit"><a href="http://www.reddit.com/submit?url=<?php the_permalink()?>" target='_blank'><span class="fa fa-reddit"></span><span class="hidden-xs"> submit</span></a></li>
				<li class="social-pinterest"><a href="http://www.pinterest.com/pin/create/button/?url=<?php the_permalink()?> " target='_blank'><span class="fa fa-pinterest"></span><span class="hidden-xs"> pin it</span></a></li>
				<li class="social-email"><a href="mailto:?subject=MailfromStylelk&body=<?php the_permalink()?>" target='_blank'><span class="fa fa-envelope-o"></span><span class="hidden-xs"> email</span></a></li>
				<li class="social-link"><a class="social-link-button" onclick="toggleLinkContent(<?php echo get_the_ID();?>)"><span class="fa fa-link"></span><span class="hidden-xs"> link</span></a><div class="link-container link-container-<?php echo get_the_ID();?>"><label>Share this link</label><input type="text" value="<?php the_permalink()?>"></div></li>		
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
		<?php  if(get_post_format()=='gallery'): ?>
		<link rel='stylesheet' id='jetpack-carousel-css'  href='<?php echo HOME;?>/wp-content/plugins/jetpack/modules/carousel/jetpack-carousel.css?ver=20120629' type='text/css' media='all' />
			<!--[if lte IE 8]>
			<link rel='stylesheet' id='jetpack-carousel-ie8fix-css'  href='<?php echo HOME;?>/wp-content/plugins/jetpack/modules/carousel/jetpack-carousel-ie8fix.css?ver=20121024' type='text/css' media='all' />
			<![endif]-->
			<link rel='stylesheet' id='jetpack-slideshow-css'  href='<?php echo HOME;?>/wp-content/plugins/jetpack/modules/shortcodes/css/slideshow-shortcode.css?ver=4.1.5' type='text/css' media='all' />
			<script type='text/javascript' src='<?php echo HOME;?>/wp-includes/js/admin-bar.min.js?ver=4.1.5'></script>
			<script type='text/javascript' src='<?php echo HOME;?>/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>
			<script type='text/javascript' src='http://s.gravatar.com/js/gprofiles.js?ver=2015Julaa'></script>
			<script type='text/javascript'>
			/* <![CDATA[ */
			var WPGroHo = {"my_hash":"27647ec40069ff8584e66b381a910574"};
			/* ]]> */
			</script>
			<script type='text/javascript' src='<?php echo HOME;?>/wp-content/plugins/jetpack/modules/wpgroho.js?ver=4.1.5'></script>
			<script type='text/javascript' src='<?php echo HOME;?>/wp-content/plugins/jetpack/_inc/spin.js?ver=1.3'></script>
			<script type='text/javascript' src='<?php echo HOME;?>/wp-content/plugins/jetpack/_inc/jquery.spin.js?ver=1.3'></script>
			<script type='text/javascript'>
			/* <![CDATA[ */
			var jetpackCarouselStrings = {"widths":[370,700,1000,1200,1400,2000],"is_logged_in":"1","lang":"en","ajaxurl":"http:\/\/localhost\/stylelk\/wp-admin\/admin-ajax.php","nonce":"4b175371cf","display_exif":"1","display_geo":"1","background_color":"black","comment":"Comment","post_comment":"Post Comment","write_comment":"Write a Comment...","loading_comments":"Loading Comments...","download_original":"View full size <span class=\"photo-size\">{0}<span class=\"photo-size-times\">\u00d7<\/span>{1}<\/span>","no_comment_text":"Please be sure to submit some text with your comment.","no_comment_email":"Please provide an email address to comment.","no_comment_author":"Please provide your name to comment.","comment_post_error":"Sorry, but there was an error posting your comment. Please try again later.","comment_approved":"Your comment was approved.","comment_unapproved":"Your comment is in moderation.","camera":"Camera","aperture":"Aperture","shutter_speed":"Shutter Speed","focal_length":"Focal Length","comment_registration":"0","require_name_email":"1","login_url":"http:\/\/localhost\/stylelk\/wp-login.php?redirect_to=http%3A%2F%2Flocalhost%2Fstylelk%2F2015%2F06%2Fincredible-8k-timelapse-video-of-a-volcano-eruption%2F","local_comments_commenting_as":"<p id=\"jp-carousel-commenting-as\">Commenting as admin<\/p>"};
			/* ]]> */
			</script>
			<script type='text/javascript' src='<?php echo HOME;?>/wp-content/plugins/jetpack/modules/carousel/jetpack-carousel.js?ver=20140505'></script>
			<script type='text/javascript' src='<?php echo HOME;?>/wp-content/plugins/jetpack/modules/shortcodes/js/jquery.cycle.js?ver=2.9999.8'></script>
			<script type='text/javascript'>
			/* <![CDATA[ */
			var jetpackSlideshowSettings = {"spinner":"http:\/\/localhost\/stylelk\/wp-content\/plugins\/jetpack\/modules\/shortcodes\/img\/slideshow-loader.gif"};
			/* ]]> */
			</script>
			<script type='text/javascript' src='<?php echo HOME;?>/wp-content/plugins/jetpack/modules/shortcodes/js/slideshow-shortcode.js?ver=20121214.1'></script>
		<?php endif;?>
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



