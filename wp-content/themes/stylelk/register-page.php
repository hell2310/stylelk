<?php get_header();
/*
 Template Name: Register Page
 */
$error = '';
$success = '';
global $wpdb, $PasswordHash, $current_user, $user_ID;
if(isset($_POST['email'])){
    $email = $wpdb->escape(trim($_POST['email']));
    $user_login=$email;
    $user_firstname=explode('@',$email);
    $user_firstname=$user_firstname[0];
    $password = $wpdb->escape(trim($_POST['password'])); 
    if( $email == '' || $password == "") {
        $error = __('Please don\'t leave the required fields.');
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = __('Invalid email address.');
    } else if(email_exists($email) ) {
        $error = __('Email already exist.');
    }      
    else {
        $user_id = wp_insert_user( array ('user_login' => apply_filters('pre_user_user_login', $user_login),'user_pass' => apply_filters('pre_user_user_pass', $password), 'user_email' => apply_filters('pre_user_user_email', $email),'first_name'=> $user_firstname, 'role' => 'subscriber' ) );
        if( is_wp_error($user_id) ) {
            $error = __('Error on user creation.');
        } else {
            do_action('user_register', $user_id);
            $user = get_user_by( 'id', $user_id );     
            $creds = array();
			$creds['user_login'] = $user_login;
			$creds['user_password'] = $password;
			$creds['remember'] = true;
    		$user = wp_signon( $creds, false );  
    		if ( is_wp_error($user) )
       		die(var_dump(is_wp_error($user)));
            redirect_to_page(HOME.'/resgiter-success');
            $success = __('You\'re successfully register');
        }
    }
}
 ?>
 <div class="container body-content">
			<div class="row">
				<div class="login-register-container">
					<h1><?php _e('Register to STYLELK')?></h1>
					<p><?php _e('Connect to STYLELK with your Facebook account')?></p>
					<p><a class="btn btn-primary btn-block facebook-connect" href="http://localhost/stylelk/wp-login.php?loginFacebook=1&redirect=http://localhost/stylelk" onclick="window.location = 'http://localhost/stylelk/wp-login.php?loginFacebook=1&redirect='+window.location.href; return false;"><span class="fa fa-facebook"></span> Connect with facebook</a></p>
					<hr>
					<?php if(!$success==''&&$error=='') : ?>
						<p class="message-login"> <?php echo $success; ?></p>
					<?php else : if(!$error==''):?>					
						<p class="message-login">  <?php echo $error;?></p>
					<?php endif;?>
					<form action="" method="POST">
						<div class="form-group">
							<label><?php _e('Email')?></label>
							<input name="email" id="email" type="text" class="form-control" placeholder="Email" required>
						</div>
						<div class="form-group">
							<label><?php _e('Password')?></label>
							<input name="password" id="password" type="password" class="form-control" placeholder="Password" required>
						</div>
						<p><?php _e('By signing up, you agree to our')?><a href="#"><?php _e('Terms of Use') ?></a> <?php _e('and')?> <a href="#"><?php _e('Privacy Policy')?></a>.</p>
						<input type="submit" class="btn btn-primary btn-block" value="Sign up">

						<p><?php _e('Have account?')?> <a href="<?php echo HOME.'/?page_id=9'; ?>"><?php _e('Login') ?></a></p>
					</form>
<?php endif;?>
				</div>			
			</div>
		</div><!-- END CONTENT -->
<?php
 get_footer();
 ?>