<?php get_header();
/*
 Template Name: Login Page
 */
 ?>
 <div class="container body-content">
			<div class="row">
				<div id="login-register-container">
					<h1>Login to STYLELK</h1>
					<p>Connect to STYLELK with your Facebook account</p>
					<p><a class="btn btn-primary btn-block facebook-connect" href="<?php echo HOME; ?>/wp-login.php?loginFacebook=1&redirect=<?php echo HOME;?>" onclick="window.location = '<?php echo HOME;?>/wp-login.php?loginFacebook=1&redirect='+window.location.href; return false;"><span class="fa fa-facebook"></span>  Login with facebook</a></p>
					<hr>
					<p>Sign in with your email address username.</p>

					<?php 
					$args=array(
						'label_username' => __( 'Email / Username' ),
						'remember'       => true
					);
					wp_login_form($args);?>
					<p><a href="<?php echo HOME;?>/wp-login.php?action=lostpassword">Lost Password?</a></p>
				</div>			
			</div>
		</div><!-- END CONTENT -->
 
		<script type="text/javascript">
			$("#user_login").attr('placeholder','Email');
			$("#user_pass").attr('placeholder','Password');
		</script>
<?php
 get_footer();
 ?>