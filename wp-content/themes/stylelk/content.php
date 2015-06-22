<!-- DISPLAY POST IN HOME PAGE AND CATEGORIES, TAG, SEARCH PAGE -->
<div class="row story-wrapper">
	<div class="col-md-6 story-image" ><a href="<?php the_permalink() ?>"><?php the_post_thumbnail() ?></a>	</div>
	<div class="col-md-6 story-content">
	    <ul class="nav nav-align-right nav-padding-none story-time"><li><?php the_category() ?></li>/<li><a href="<?php the_permalink()?>"><?php echo human_time_diff(get_the_time('U'),current_time('timestamp')).' ago'; ?></a><li></ul>
	    <h2><a href="<?php the_permalink()?>"><?php the_title()?></a></h2>
	    <ul class="nav nav-align-right nav-padding-none interative"><li><a href="<?php the_permalink() ?>"><?php echo getTwitterShareCount(get_the_ID())+getFacebookShareCount(get_the_ID());?> Shares</a></li>/<li><a href="<?php the_permalink()?>"><?php echo getPostViews(get_the_ID()); ?></a></li>/<li><a href="<?php the_permalink()?>"><?php echo  get_comments_number();?> Comments</li></a></ul>
	    <ul class="nav nav-align-right interative-social">
	        <li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink()?>" target="_blank"><span class="fa fa-facebook"></span> Share</a></li>
	        <li><a href="http://twitter.com/share?url=<?php the_permalink()?>" target="_blank"><span class="fa fa-twitter"></span> Tweet</a></li>
	    </ul> 
	</div>
</div>