<?php 
get_header();
/*
 Template Name: Register Success Page
 */
 ?>
<div class="container body-content">
			<div class="row">
				<div class="login-register-container register-success-container">
					<h1><?php _e('SIGN UP COMPLETE') ?></h1>
					<hr>
					<p><?php _e('You have successfully created your account!') ?></p>
					<p class="return"><a class="btn btn-primary" href="<?php echo HOME;?>"><?php _e('Return')?></a></p>
				</div>			
			</div>
</div><!-- END CONTENT -->
<?php get_footer();?>
