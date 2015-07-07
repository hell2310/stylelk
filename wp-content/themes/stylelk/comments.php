<div class="comment-content comment-content-<?php echo get_the_ID(); ?>">
<?php $comments = get_comments(array('post_id' => get_the_ID()));
if ( get_comments_number()>0  ) : ?>
			<?php
			 wp_list_comments(array('style'=>'ol'),$comments);
			?>
<?php endif; ?>
<?php comment_form(); ?>
</div>
