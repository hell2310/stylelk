<div class="comment-content comment-content-<?php echo get_the_ID(); ?>">
<?php 
$comments = get_comments(array('post_id' => get_the_ID()));
$args=array('style' => 'ol');
if ( get_comments_number()>0  ) : ?>
		<ol class="comment-list">
			<?php
				wp_list_comments($args,$comments);
			?>
		</ol><!-- .comment-list -->
	<?php endif; // have_comments() ?>
<?php comment_form(); ?>
</div>