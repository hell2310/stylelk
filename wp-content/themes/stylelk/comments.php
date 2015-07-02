<div class="comment-content comment-content-<?php echo get_the_ID(); ?>">
<?php 
$comments = get_comments(array('post_id' => get_the_ID()));
if ( get_comments_number()>0  ) : ?>
			<?php
			 wp_list_comments(array('style'=>'all','callback'=>'comment_list_theme'),$comments);
			?>
<?php endif; ?>
<?php 
$fields=array(
	'author'=>'<p class="comment-form-author"><label for="author">'.__('Name').'</label<span class="required">*</span></br><input name="author" class="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .'" required aria-required="true"></p>',
	'email'=>'<p class="comment-form-email"><label for="email">'.__('Email').'</label><span class="required">*</span></br><input name="email" class="email" type="email"  value="' . esc_attr( $commenter['comment_author_email'] ) .'" required aria-required="true"></p>'
	);
$comment_field='<p class="comment-form-comment"><label for="comment">' . __( 'Comment') . '</label></br><textarea class="comment-input" name="comment" cols="40" rows="8" aria-required="true"></textarea></p>';
$arg=array('fields'=>$fields,'label_submit'=>'Comment','title_reply'=>'','comment_notes_after'=>'','comment_field'=>$comment_field);
comment_form($arg); ?>
</div>
