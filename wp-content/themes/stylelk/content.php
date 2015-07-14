<!-- DISPLAY POST WRAPPER IN POST PAGE -->
<?php 	$post_id=get_the_ID();
		$post_permalink=get_permalink(get_the_ID());
		$post_title=get_the_title(get_the_ID());
?>
<div class="row story-wrapper postpage-story-wrapper post-page-story-<?php echo $post_id;?>">
		<div class="story-image" > 
			<!--  display slide image use with plugin dynamic feature image-->
			<?php if(has_post_video($post_id)): ?>
				<?php echo get_the_post_video( $post_id, full ); ?>
				<script type="text/javascript">
				var iframeWisth=$(".featured-video-plus iframe").width();
				$(".featured-video-plus iframe").height(iframeWisth*2/3);
				</script>
			<?php else:?>
			<?php 
				global $dynamic_featured_image;
				$feature_image=$dynamic_featured_image->get_featured_images() ;
				if(!$feature_image==null): ?>		
				<div class="slide-feature-image slide-feature-image-<?php echo $post_id;?>">	
				<?php the_post_thumbnail('medium') ?>
				<?php 
				foreach ($feature_image as $feature_image) {?>
					<img src="<?php echo $feature_image['full'];?>">
				<?php
				}?>
				</div>
				<!-- 			loadscript for slide -->
			<script type="text/javascript">
				var slideImageWidth=$(".slide-feature-image-<?php echo $post_id;?>").width();
				var eindex_<?php echo $post_id;?> = 0;
				$(".slide-feature-image-<?php echo $post_id;?>").height(slideImageWidth*2/3);
				var count_<?php echo $post_id;?> = $('.slide-feature-image-<?php echo $post_id;?> img').length;
				$('.slide-feature-image-<?php echo $post_id;?>').append('<ul class="slide-control"><li id="control-right-<?php echo $post_id;?>" class="fa fa-chevron-right control-button-<?php echo $post_id;?> control-right control-active"></li><li id="control-left-<?php echo $post_id;?>"class="fa fa-chevron-left control-button-<?php echo $post_id;?> control-left"></li></ul>');
				$('.slide-feature-image-<?php echo $post_id;?>').append('<div class="count-slide count-slide-<?php echo $post_id;?>"></div>');
				$(".slide-feature-image-<?php echo $post_id;?> img:first-child").addClass("image-focus");
			    $(".count-slide-<?php echo $post_id;?>").html("<p>"+(eindex_<?php echo $post_id;?>+1)+"/"+count_<?php echo $post_id;?>+"</p>");
			    if (typeof setimagefocus == "undefined") { 
			    function setimagefocus(postID,eIndex,count) {
			        $(".slide-feature-image-"+postID+" img").stop().fadeOut(300).animate({
			            opacity: 0
			        });
			        $(".slide-feature-image-"+postID+" img:eq(" + eIndex + ")").stop().fadeIn(300).animate({
			            opacity: 1
			        });
			        $(".count-slide-"+postID).html("<p>"+(eIndex+1)+"/"+count+"</p>");
			        if(eIndex==(count-1)){
			         	$("#control-right-"+postID).removeClass("control-active");
			         	$("#control-left-"+postID).addClass("control-active");
			         }
			        else if(eIndex==0){
			         	$("#control-left-"+postID).removeClass("control-active");
			         	$("#control-right-"+postID).addClass("control-active");
			         }
			        else if(eIndex==(count-2)|eIndex==1){
			        	$("#control-left-"+postID+",#control-right-"+postID).addClass("control-active");
			        }
			        else{
			        	;
			        }
			    }
			    }
			    $("#control-left-<?php echo $post_id;?>").click(function () {
			        eindex_<?php echo $post_id;?>--;
			        if (eindex_<?php echo $post_id;?> == -1) eindex_<?php echo $post_id;?> = count_<?php echo $post_id;?> - 1;
			        setimagefocus(<?php echo $post_id;?>,eindex_<?php echo $post_id;?>,count_<?php echo $post_id;?>);
			    });
			    $("#control-right-<?php echo $post_id;?>").click(function () {
			        eindex_<?php echo $post_id;?>++;
			        if (eindex_<?php echo $post_id;?> == count_<?php echo $post_id;?>) eindex_<?php echo $post_id;?> = 0;
			        setimagefocus(<?php echo $post_id;?>,eindex_<?php echo $post_id;?>,count_<?php echo $post_id;?>);
			    });
			</script>		
			<?php 
			else:?>
			<!-- display video or feature image when not have slide image -->
				<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('large') ?></a>	
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
				<li class="hidden-md hidden-lg hidden-sm social-whatsapp"><a href="whatsapp://send?text=<?php the_permalink()?> " data-action="share/whatsapp/share" target='_blank'><span class="fa fa-whatsapp"></span></a></li>
				<li class="hidden-md hidden-lg hidden-sm social-telegram"><a href="tg://msg?text=<?php the_permalink()?>" data-action="share/whatsapp/share" target='_blank'><span class="fa fa-paper-plane"></span></a></li>
				<li class="social-email"><a href="mailto:?subject=<?php the_title() ?>&body=<?php the_permalink()?>" target='_blank'><span class="fa fa-envelope-o"></span><span class="hidden-xs"> email</span></a></li>
				<li class="social-link hidden-xs"><a class="social-link-button" onclick="toggleLinkContent(<?php echo get_the_ID();?>)"><span class="fa fa-link"></span><span class="hidden-xs"> link</span></a><div id="link-container-<?php echo get_the_ID();?>" class="link-container"><label>Share this link</label><input type="text" value="<?php the_permalink()?>"></div></li>		
			</ul>
			<div class="story-content">
				<?php the_content() ?>
			</div>
			<ul class="nav nav-align-right story-infor"><li><strong>Date: </strong><p><?php the_date() ?></p></li><li class="divider">/</li><li><strong>Author: </strong><p><a href="<?php the_author_link() ?>"><?php the_author() ?></a></p></li></ul>
			<ul class="nav nav-align-right story-infor"><li><strong>Category: </strong><p><?php the_category() ?></p></li><li class="divider">/</li><li><strong>tag: </strong><p><?php the_tags('','','')?></p></li><li class="divider">/</li><li><strong>views: </strong><p><?php echo getPostViews(get_the_ID()); ?></p></li></ul>
			<p id="story-comment-<?php echo $post_id;?>" class="story-comment" onclick="toggleCommentContent(<?php echo $post_id; ?>,'<?php echo $post_title;?>','<?php echo $post_permalink;?>')" ><a> <span class="disqus-comment-count"  data-role="mobile" data-disqus-url="<?php echo $post_permalink;?>"></span></a></p>
			<script type="text/javascript" src="https://stylelk.net/wp-content/plugins/disqus-comment-system/media/js/count.js"></script>
			<?php if ( comments_open()) :?>
				<div id="comments-content-<?php echo $post_id ;?>" class="comments-content">
					<?php;
					/*echo disqus_embed('stylelk',$post_title,$post_id,$post_pemarlink);*/
					/* comments_template();*/?>
				</div>
			<?php endif; ?>
			<script type="text/javascript">
			function toggleLinkContent(postID){
				$("#link-container-"+postID).slideToggle();
				$("#link-container-"+postID+" input").focus();
			}
			function toggleCommentContent(postID,postTitle,postPermalink){
				var js = document.createElement("script");
				js.type = "text/javascript";
				js.src = "http://stylelk.disqus.com/embed.js";
				$(".story-comment").slideDown();
				$("#story-comment-"+postID).slideUp();
				$(".comments-content").slideUp();
				$(".comments-content").html("");
				$("#comments-content-"+postID).slideToggle();
				$("#comments-content-"+postID).html('<div id="disqus_thread" mobile="yes"></div>');	
				$("#comments-content-"+postID).append(js);
				DISQUS.reset({
			      reload: true,
			      config: function () {  
			        this.page.identifier = "stylelk-"+postID;
			        this.page.url = postPermalink;
			        this.page.title = postTitle;
			      }
			    });
			    topPosition=("#comment-content-"+postID).position().top;
			     $('html,body').animate({"scrollTop":topPosition},'slow');
			/*	var disqus_shortname = "stylelk";
				var disqus_title = postTitle;
				var disqus_url = postPermalink;
				var disqus_identifier = "stylelk-"+postID;*/
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
							<div class="col-md-2 yma-like-image"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail("small") ?></a></div>
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



