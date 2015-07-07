<?php 
get_header();
/*
 Template Name: Success Subscription
 */
 ?>
<div class="container body-content">
			<div class="row">
				<div class="subscription-success">
					<h1><?php _e('Thank you') ?></h1>
					<hr>
					<p><?php _e('You subscription has been confirmed.') ?></p>
					<p><?php _e('You\'ve been added to our list and will hear from us soon.' ) ?></p>
					<p class="return"><a class="btn btn-primary" href="<?php echo HOME;?>"><?php _e('HOME PAGE')?></a></p>
				</div>			
			</div>
</div><!-- END CONTENT -->
<?php get_footer();?>
