<?php 
if(!is_user_logged_in()){
	redirect_to_page();
}
global $current_user;
get_header();
/*
 Template Name: Avatar Setting
 */
 ?>
 	<div class="container body-content">
		<div class="row">
				<hr>
				<div class="col-md-3  left-column">
					<ul class="nav nav-account-page">
						<li><a><?php _e('Account Setting')?></a></li>
						<li class="active"><a href="<?php echo HOME;?>/setting/profile" ><?php _e('Profile')?></a></li>
						<li><a href="<?php echo HOME;?>/setting/avatar" ><?php _e('Avatar')?></a></li>
						<li><a href="<?php echo HOME;?>/setting/newsletter" ><?php _e('Newsletter')?></a></li>
					</ul>
				</div>
				<div class="col-md-9 right-column">
					<div class="page-content tab-content">					
						<div id="edit-avatar-content">
							<h1><?php _e('Change Avatar') ?></h1>
							<hr>
							<?php echo do_shortcode('[basic-user-avatars]'); ?>
							<hr>
						</div>
					</div>
			</div>
		</div>
	</div><!-- END CONTENT -->
<?php get_footer(); ?>