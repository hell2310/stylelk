<!-- DISPLAY POST WRAPPER IN POST PAGE -->
<div class="row story-wrapper postpage-story-wrapper post-page-story-<?php get_the_ID();?>">
		<?php if(get_post_format()==''): ?>
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
				<li class="social-email"><a href="mailto:?body=<?php the_permalink()?>" target='_blank'><span class="fa fa-envelope-o"></span><span class="hidden-xs"> email</span></a></li>
				<li class="social-link"><a class="social-link-button" onclick="toggleCommentContent()"><span class="fa fa-link"></span><span class="hidden-xs"> link</span></a><div class="link-container"><label>Share this link</label><input type="text" value="<?php the_permalink()?>"></div></li>		
			</ul>
			<div class="story-content">
				<?php the_content() ?>
			</div>
			<ul class="nav nav-align-right story-infor"><li><strong>Date: </strong><p><?php the_date() ?></p></li><li class="divider">/</li><li><strong>Author: </strong><p><a href="<?php the_author_link() ?>"><?php the_author() ?></a></p></li></ul>
			<ul class="nav nav-align-right story-infor"><li><strong>Category: </strong><p><?php the_category() ?></p></li><li class="divider">/</li><li><strong>tag: </strong><p><?php the_tags('','','')?></p></li><li class="divider">/</li><li><strong>views: </strong><p><?php echo getPostViews(get_the_ID()); ?></p></li></ul>
			<p class="story-comment" ><a><?php echo get_comments_number();?> <?php _e('comments')?></a></p>
			<?php if ( comments_open()) : 
				get_template_part('comments'); 			
			endif; ?>
			<?php 
				global $wpdb;
				global $post;
				$cat_ID=array();
				$categories = get_the_category(); 
  				foreach($categories as $category) {
    				array_push($cat_ID,$category->cat_ID);
  				}
  				$args=array('category__in'=>$cat_ID);
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
<script type="text/javascript">
	function toggleCommentContent(){
		$(this).parent().slideToggle();
		$(".link-container").slideToggle();
	}
</script>
