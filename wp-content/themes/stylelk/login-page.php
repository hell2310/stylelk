<?php get_header();
/*
 Template Name: Login Page
 */
 ?>
 <div class="container body-content">
			<div class="row">
				<div id="login-register-container" class="col-lg-6 col-md-6">
					<h1>Login to STYLELK</h1>
					<p>Connect to STYLELK with your Facebook account</p>
					<p><a class="btn btn-primary btn-block facebook-connect" href="http://localhost/stylelk/wp-login.php?loginFacebook=1&redirect=http://localhost/stylelk" onclick="window.location = 'http://localhost/stylelk/wp-login.php?loginFacebook=1&redirect='+window.location.href; return false;"><span class="fa fa-facebook"></span>  Login with facebook</a></p>
					<hr>
					<p>Sign in with your email address username.</p>

					<?php 
					$args=array(
						'label_username' => __( 'Email / Username' ),
						'remember'       => true
					);
					wp_login_form($args);?>
					<p><a href="#">Lost Password?</a></p>
				</div>			
			</div>
		</div><!-- END CONTENT -->
 

<?php
 get_footer();
 ?>