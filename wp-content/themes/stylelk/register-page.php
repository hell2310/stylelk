<?php get_header();
/*
 Template Name: Register Page
 */
$error = '';
$success = '';
global $wpdb, $PasswordHash, $current_user, $user_ID;
if(isset($_POST['email'])){
    $email = $wpdb->escape(trim($_POST['email']));
    $password = $wpdb->escape(trim($_POST['password'])); 
    if( $email == '' || $password == "") {
        $error = 'Please don\'t leave the required fields.';
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email address.';
    } else if(email_exists($email) ) {
        $error = 'Email already exist.';
    }      
    else {
 
        $user_id = wp_insert_user( array ('user_login' => apply_filters('pre_user_user_login', $email),'user_pass' => apply_filters('pre_user_user_pass', $password), 'user_email' => apply_filters('pre_user_user_email', $email), 'role' => 'subscriber' ) );
        if( is_wp_error($user_id) ) {
            $error = 'Error on user creation.';
        } else {
            do_action('user_register', $user_id);
            
            $success = 'You\'re successfully register';
        }
    }
}
 ?>
 <div class="container body-content">
			<div class="row">
				<div id="login-register-container">
					<h1>Register to STYLELK</h1>
<?php if(!$success==''&&$error=='') : ?>
					<p> <?php echo $success; ?></p>
<?php else : if(!$error==''):?>					
					<p> <?php echo $error;?></p>
			<?php endif;?>
					<p>Connect to STYLELK with your Facebook account</p>
					<p><a class="btn btn-primary btn-block facebook-connect" href="http://localhost/stylelk/wp-login.php?loginFacebook=1&redirect=http://localhost/stylelk" onclick="window.location = 'http://localhost/stylelk/wp-login.php?loginFacebook=1&redirect='+window.location.href; return false;"><span class="fa fa-facebook"></span> Connect with facebook</a></p>
					<hr>
					<form action="" method="POST">
						<div class="form-group">
							<label>Email</label>
							<input name="email" id="email" type="text" class="form-control" placeholder="Email" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input name="password" id="password" type="password" class="form-control" placeholder="Password" required>
						</div>
						<p>By signing up, you agree to our <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</p>
						<input type="submit" class="btn btn-primary btn-block" value="Sign up">

						<p>Have account? <a href="<?php echo HOME.'/?page_id=9'; ?>">Login</a></p>
					</form>
<?php endif;?>
				</div>			
			</div>
		</div><!-- END CONTENT -->

<?php
 get_footer();
 ?>