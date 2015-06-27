<?php ini_set('display_errors', 0); ?>
<?php get_header();?>
<div class="container body-content">
			<div class="row">
				<div id="login-register-container">
					<h1><?php echo _e('SIGN UP COMPLETE'); ?></h1>
					<p><?php echo _e('You have successfully created your account!'); ?></p>
					<p class="return"><a type="btn btn-primary" href="<?php echo HOME;?>"><?php echo _e('Return');?></a></p>
				</div>			
			</div>
</div><!-- END CONTENT -->
<?php
 get_footer();
?>