<!-- DISPLAY POST IN HOME PAGE AND CATEGORIES, TAG, SEARCH PAGE -->
<?php $post_link=get_permalink(get_the_ID());?>
<div class="row story-wrapper">
	<div class="col-md-6 story-image" >
		<a href="<?php echo $post_link; ?>"><?php the_post_thumbnail('large') ?></a>	
	</div>
	<div class="col-md-6 story-content">
	    <ul class="nav nav-align-right nav-padding-none story-time"><li><?php the_category() ?></li><li class="divider">/</li><li><a href="<?php echo $post_link;?>"><?php echo human_time_diff(get_the_time('U'),current_time('timestamp')).' ago'; ?></a><li></ul>
	    <h2><a href="<?php echo $post_link;?>"><?php the_title()?></a></h2>
	    <ul class="nav nav-align-right nav-padding-none interative"><li><a href="<?php echo $post_link; ?>"><?php echo getTwitterShareCount($post_link)+getFacebookShareCount($post_link);?> <?php _E('Shares')?></a></li><li class="divider">/</li><li><a href="<?php echo get_permalink(get_the_ID());?>"><?php echo getPostViews(get_the_ID()); ?></a></li><li class="divider">/</li><li><a href="<?php echo $post_link;?>"><?php echo  get_comments_number();?> <?php _e('Comments') ?></a></li></ul>
	    <ul class="nav nav-align-right interative-social">
	        <li><a href="http://www.facebook.com/sharer.php?u=<?php echo $post_link;?>" target="_blank"><span class="fa fa-facebook"></span> <?php _e('Share') ?></a></li>
	        <li><a href="http://twitter.com/share?url=<?php echo $post_link;?>" target="_blank"><span class="fa fa-twitter"></span> <?php _e('Tweet') ?></a></li>
	    </ul> 
	</div>
</div>