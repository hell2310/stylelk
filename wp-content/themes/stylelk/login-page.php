<?php 
get_header();
/*
 Template Name: Login Page
 */
 if(isset($_REQUEST['login']))
 {	
 	if(strpos($_REQUEST['login'],'empty') !== false) $message=__('Enter username and/or password');
 	if(strpos($_REQUEST['login'],'failed') !== false) $message=__('Incorrect username and/or password');
 }
 ?>
 <div class="container body-content">
			<div class="row">
				<div class="login-register-container">
					<h1><?php _e('Login to STYLELK')?></h1>
					<p><?php _e('Connect to STYLELK with your Facebook account')?></p>
					<p><a class="btn btn-primary btn-block facebook-connect" href="#" onclick="redirectFacebook()"><span class="fa fa-facebook"></span>  <?php _e('Login with facebook')?></a></p> 		
					<script type="text/javascript">
					function redirectFacebook(){
						var popup = window.open("https://www.facebook.com/dialog/oauth?client_id=1603443363261032&redirect_uri=<?php echo HOME;?>/login-facebook", "Popup", "chrome=yes");
        				popup.focus();
        				var timer = setInterval(function() {   
						    if(popup.closed) {  
						        clearInterval(timer);  
						        window.location="<?php echo HOME;?>";
						    }  
						}, 1000);
					}
					</script>
					<!-- <p><a class="btn btn-primary btn-block facebook-connect" target="_blank" href="<?php echo HOME; ?>/wp-login.php?loginFacebook=1&redirect=<?php echo HOME;?>" onclick="window.location = '<?php echo HOME;?>/wp-login.php?loginFacebook=1&redirect='+window.location.href; return false;" target="_blank"><span class="fa fa-facebook"></span>  <?php _e('Login with facebook')?></a></p> -->
					<hr>
					<p><?php _e('Sign in with your email address username.')?></p>
				<?php if(isset($message)) :?>
					<p class="message-login"><?php echo $message;?></p>
				<?php endif; ?>
				<?php if( !is_user_logged_in()): ?>
					<?php 
					$args=array(
						'label_username' => __( 'Email / Username' ),
						'remember'       => true
					);
					wp_login_form($args);?>
				<?php else : ?>
					<p><?php _e('You have been login')?></p>
				<?php endif;?>
					<p><a href="<?php echo HOME;?>/forgot-password-request"><?php _e('Lost Password ?')?></a></p>
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