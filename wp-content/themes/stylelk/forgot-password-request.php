<?php 
get_header();
/*
 Template Name: forgot password request
 */
 if(isset($_POST['user_login']))
 {	
 	global $wpdb;
    $username = trim($_POST['user_login']);
    $user_exists = false;
        if (username_exists($username))
        {
            $user_exists = true;
            $user_data = get_userdatabylogin($username);
        } elseif (email_exists($username))
        {
            $user_exists = true;
            $user = get_user_by_email($username);
        } else
        {
            $error[] = '<p>' . __('Username or Email was not found, try again!') . '</p>';
        }
     if ($user_exists)
        {
            $user_login = $user->user_login;
            $user_email = $user->user_email;
            $key = substr(md5(uniqid(microtime())), 0, 8);
            $wpdb->query("UPDATE $wpdb->users SET user_activation_key = '$key' WHERE user_login = '$user_login'");
            $message = __('Someone has asked to reset the password for the following site and username.') . "\r\n\r\n";
            $message .= get_option('siteurl') . "\r\n\r\n";
            $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
            $message .= __('To reset your password visit the following address, otherwise just ignore this email and nothing will happen.') . "\r\n\r\n";
            if (FALSE == wp_mail($user_email, sprintf(__('[%s] Password Reset'), get_option('blogname')), $message))
            $error[] = '<p>' . __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function...') . '</p>';
        }
 }
 ?>
<div class="container body-content">
			<div class="row">
				<div class="login-register-container">
				<?php if(!isset($_POST['user_login'])): ?>
					<h1><?php _e('Forgot Password')?></h1>
					<p><?php _e('Please enter your username or email address. You will receive a link to create a new password via email.')?></p>
					<form class="form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
						<div class="form-group">
							<label for="username"><?php _e('Username or email address:')?></label>
							<input type="text" id="user_login" name="user_login" class="form-control" required="required">
						</div>
						<div class="form-group">
            				<button type="submit" class="btn btn-primary"><?php _e('Get New Password')?></button>
        				</div>
					</form>	
				<?php else: if(!isset( $error)): ?>
					<p><?php _e('The password for this user has already been requested within the last 24 hours.') ?></p>
				<?php else: ?>
					<p><?php foreach ($error as $error) {
						echo $error;
					} ?></p>
				<?php endif; endif;?>
				</div>			
			</div>
		</div><!-- END CONTENT -->
<?php
 get_footer();
 ?>