<?php 
get_header();
/*
 Template Name: forgot password request
 */
 if(isset($_POST['user_mail']))
 {	
 	global $wpdb;
    $usermail = trim($_POST['user_mail']);
    $user_exists = false;
        if (username_exists($usermail))
        {
            $user_exists = true;
            $user = get_user_by('login', $usermail );
        } elseif (email_exists($usermail))
        {
            $user_exists = true;
            $user = get_user_by('email', $usermail );
        } else
        {
            $error=__('Username or Email was not found, <a href="'.HOME.'/forgot-password-request">try again</a>!');
        }
     if ($user_exists)
        {   $user_id=$user->ID;
            $user_login = $user->user_login;
            $user_email = $user->user_email;
            $key = substr(md5(uniqid(microtime())), 0, 8);
            /*die(var_dump($user));*/
            $user_id = wp_update_user( array( 'ID' => $user_id,'user_pass' => $key) );
            /*$wpdb->query("UPDATE $wpdb->users SET user_pass = '$key' WHERE user_login = '$user_login'");*/
            $message = __('Someone has asked to reset the password for the following site and username.') . "\r\n\r\n";
            $message .= get_option('siteurl') . "\r\n\r\n";
            $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
            $message .= __('New password: '.$key.' To reset your password visit the following address, otherwise just ignore this email and nothing will happen.') . "\r\n\r\n";
            $result=wp_mail($user_email, sprintf(__('[%s] Password Reset'), get_option('blogname')), $message);
            if (FALSE == $result)
            $error=__('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function...');
        }
 }
 ?>
<div class="container body-content">
			<div class="row">
				<div class="login-register-container">
				<?php if(!isset($_POST['user_mail'])): ?>
					<h1><?php _e('Forgot Password')?></h1>
					<p><?php _e('Please enter your username or email address. You will receive a link to create a new password via email.')?></p>
					<form class="form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
						<div class="form-group">
							<label for="username"><?php _e('Username or email address:')?></label>
							<input type="text" id="user_login" name="user_mail" class="form-control" required="required">
						</div>
						<div class="form-group">
            				<button type="submit" class="btn btn-primary"><?php _e('Get New Password')?></button>
        				</div>
					</form>	
				<?php else: if(isset( $error)&&$error!=""): ?>
                    <p><?php echo $error; ?></p>					
				<?php else: ?>
					<p><?php _e('The password for this user has already been requested within the last 24 hours.') ?></p>
				<?php endif; endif;?>
				</div>			
			</div>
		</div><!-- END CONTENT -->
<?php
 get_footer();
 ?>